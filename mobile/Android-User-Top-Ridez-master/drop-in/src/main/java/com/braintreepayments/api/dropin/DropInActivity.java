package com.braintreepayments.api.dropin;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.VisibleForTesting;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.LinearSnapHelper;
import android.support.v7.widget.RecyclerView;
import android.text.TextUtils;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.Animation.AnimationListener;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.ViewSwitcher;

import com.braintreepayments.api.AndroidPay;
import com.braintreepayments.api.BraintreeFragment;
import com.braintreepayments.api.DataCollector;
import com.braintreepayments.api.PayPal;
import com.braintreepayments.api.PaymentMethod;
import com.braintreepayments.api.Venmo;
import com.braintreepayments.api.dropin.adapters.SupportedPaymentMethodsAdapter;
import com.braintreepayments.api.dropin.adapters.SupportedPaymentMethodsAdapter.PaymentMethodSelectedListener;
import com.braintreepayments.api.dropin.adapters.VaultedPaymentMethodsAdapter;
import com.braintreepayments.api.dropin.interfaces.AnimationFinishedListener;
import com.braintreepayments.api.dropin.utils.PaymentMethodType;
import com.braintreepayments.api.exceptions.AuthenticationException;
import com.braintreepayments.api.exceptions.AuthorizationException;
import com.braintreepayments.api.exceptions.ConfigurationException;
import com.braintreepayments.api.exceptions.DownForMaintenanceException;
import com.braintreepayments.api.exceptions.InvalidArgumentException;
import com.braintreepayments.api.exceptions.ServerException;
import com.braintreepayments.api.exceptions.UnexpectedException;
import com.braintreepayments.api.exceptions.UpgradeRequiredException;
import com.braintreepayments.api.interfaces.BraintreeCancelListener;
import com.braintreepayments.api.interfaces.BraintreeErrorListener;
import com.braintreepayments.api.interfaces.BraintreeResponseListener;
import com.braintreepayments.api.interfaces.ConfigurationListener;
import com.braintreepayments.api.interfaces.PaymentMethodNonceCreatedListener;
import com.braintreepayments.api.interfaces.PaymentMethodNoncesUpdatedListener;
import com.braintreepayments.api.models.Authorization;
import com.braintreepayments.api.models.ClientToken;
import com.braintreepayments.api.models.Configuration;
import com.braintreepayments.api.models.PaymentMethodNonce;

import java.util.List;

import static android.view.animation.AnimationUtils.loadAnimation;

public class DropInActivity extends Activity implements ConfigurationListener, BraintreeCancelListener,
        BraintreeErrorListener, PaymentMethodSelectedListener, PaymentMethodNoncesUpdatedListener,
        PaymentMethodNonceCreatedListener {

    /**
     * Errors are returned as the serializable value of this key in the data intent in
     * {@link android.app.Activity#onActivityResult(int, int, android.content.Intent)} if
     * responseCode is not {@link android.app.Activity#RESULT_OK} or
     * {@link android.app.Activity#RESULT_CANCELED}.
     */
    public static final String EXTRA_ERROR = "com.braintreepayments.api.dropin.EXTRA_ERROR";

    private static final int ADD_CARD_REQUEST_CODE = 1;
    private static final String EXTRA_SHEET_SLIDE_UP_PERFORMED = "com.braintreepayments.api.EXTRA_SHEET_SLIDE_UP_PERFORMED";
    private static final String EXTRA_DEVICE_DATA = "com.braintreepayments.api.EXTRA_DEVICE_DATA";

    @VisibleForTesting
    protected DropInRequest mDropInRequest;

    private BraintreeFragment mBraintreeFragment;
    private boolean mClientTokenPresent;
    private String mDeviceData;

    private View mBottomSheet;
    private ViewSwitcher mLoadingViewSwitcher;
    private TextView mSupportedPaymentMethodsHeader;
    private ListView mSupportedPaymentMethodListView;
    private View mVaultedPaymentMethodsContainer;
    private RecyclerView mVaultedPaymentMethodsView;

    private boolean mSheetSlideUpPerformed;
    private boolean mSheetSlideDownPerformed;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.bt_drop_in_activity);

        mDropInRequest = getIntent().getParcelableExtra(DropInRequest.EXTRA_CHECKOUT_REQUEST);
        mBottomSheet = findViewById(R.id.bt_dropin_bottom_sheet);
        mLoadingViewSwitcher = (ViewSwitcher) findViewById(R.id.bt_loading_view_switcher);
        mSupportedPaymentMethodsHeader = (TextView) findViewById(R.id.bt_supported_payment_methods_header);
        mSupportedPaymentMethodListView = (ListView) findViewById(R.id.bt_supported_payment_methods);
        mVaultedPaymentMethodsContainer = findViewById(R.id.bt_vaulted_payment_methods_wrapper);
        mVaultedPaymentMethodsView = (RecyclerView) findViewById(R.id.bt_vaulted_payment_methods);
        mVaultedPaymentMethodsView.setLayoutManager(new LinearLayoutManager(this,
                LinearLayoutManager.HORIZONTAL, false));
        new LinearSnapHelper().attachToRecyclerView(mVaultedPaymentMethodsView);

        try {
            mBraintreeFragment = getBraintreeFragment();
        } catch (InvalidArgumentException e) {
            Intent intent = new Intent()
                    .putExtra(EXTRA_ERROR, e.getMessage());
            setResult(RESULT_FIRST_USER, intent);
            finish();
            return;
        }

        if (savedInstanceState != null) {
            mSheetSlideUpPerformed = savedInstanceState.getBoolean(EXTRA_SHEET_SLIDE_UP_PERFORMED,
                    false);
            mDeviceData = savedInstanceState.getString(EXTRA_DEVICE_DATA);
        }

        slideUp();
    }

    @VisibleForTesting
    protected BraintreeFragment getBraintreeFragment() throws InvalidArgumentException {
        if (TextUtils.isEmpty(mDropInRequest.getAuthorization())) {
            throw new InvalidArgumentException("A client token or client key must be specified " +
                    "in the " + DropInRequest.class.getSimpleName());
        }

        try {
            mClientTokenPresent =
                    Authorization.fromString(mDropInRequest.getAuthorization()) instanceof ClientToken;
        } catch (InvalidArgumentException e) {
            mClientTokenPresent = false;
        }

        return BraintreeFragment.newInstance(this, mDropInRequest.getAuthorization());
    }

    @Override
    public void onConfigurationFetched(final Configuration configuration) {
        if (mDropInRequest.shouldCollectDeviceData() && TextUtils.isEmpty(mDeviceData)) {
            DataCollector.collectDeviceData(mBraintreeFragment, new BraintreeResponseListener<String>() {
                @Override
                public void onResponse(String deviceData) {
                    mDeviceData = deviceData;
                }
            });
        }

        if (mDropInRequest.isAndroidPayEnabled()) {
            AndroidPay.isReadyToPay(mBraintreeFragment, new BraintreeResponseListener<Boolean>() {
                @Override
                public void onResponse(Boolean isReadyToPay) {
                    createAndSetPaymentMethodsAdapter(configuration, isReadyToPay);
                }
            });
        } else {
            createAndSetPaymentMethodsAdapter(configuration, false);
        }
    }

    private void createAndSetPaymentMethodsAdapter(final Configuration configuration, final boolean withAndroidPay) {

        mSupportedPaymentMethodListView.setAdapter(new SupportedPaymentMethodsAdapter(
                DropInActivity.this, configuration, withAndroidPay, mClientTokenPresent,
                DropInActivity.this));
        mLoadingViewSwitcher.setDisplayedChild(1);
        fetchPaymentMethodNonces();
    }

    @Override
    public void onCancel(int requestCode) {
        mLoadingViewSwitcher.setDisplayedChild(1);
    }

    @Override
    public void onError(final Exception error) {
        slideDown(new AnimationFinishedListener() {
            @Override
            public void onAnimationFinished() {
                if (error instanceof AuthenticationException || error instanceof AuthorizationException ||
                        error instanceof UpgradeRequiredException) {
                    mBraintreeFragment.sendAnalyticsEvent("sdk.exit.developer-error");
                } else if (error instanceof ConfigurationException) {
                    mBraintreeFragment.sendAnalyticsEvent("sdk.exit.configuration-exception");
                } else if (error instanceof ServerException || error instanceof UnexpectedException) {
                    mBraintreeFragment.sendAnalyticsEvent("sdk.exit.server-error");
                } else if (error instanceof DownForMaintenanceException) {
                    mBraintreeFragment.sendAnalyticsEvent("sdk.exit.server-unavailable");
                } else {
                    mBraintreeFragment.sendAnalyticsEvent("sdk.exit.sdk-error");
                }

                setResult(RESULT_FIRST_USER, new Intent().putExtra(EXTRA_ERROR, error));
                finish();
            }
        });
    }

    @Override
    public void onPaymentMethodNonceCreated(final PaymentMethodNonce paymentMethodNonce) {
        slideDown(new AnimationFinishedListener() {
            @Override
            public void onAnimationFinished() {
                mBraintreeFragment.sendAnalyticsEvent("sdk.exit.success");

                DropInResult.setLastUsedPaymentMethodType(DropInActivity.this, paymentMethodNonce);

                DropInResult result = new DropInResult()
                        .paymentMethodNonce(paymentMethodNonce)
                        .deviceData(mDeviceData);
                Intent intent = new Intent().putExtra(DropInResult.EXTRA_DROP_IN_RESULT, result);

                setResult(RESULT_OK, intent);
                finish();
            }
        });
    }

    @Override
    public void onPaymentMethodSelected(PaymentMethodType type) {
        mLoadingViewSwitcher.setDisplayedChild(0);

        switch (type) {
            case PAYPAL:
                PayPal.authorizeAccount(mBraintreeFragment);
                break;
            case ANDROID_PAY:
                AndroidPay.requestAndroidPay(mBraintreeFragment, mDropInRequest.getAndroidPayCart(),
                        mDropInRequest.isAndroidPayShippingAddressRequired(),
                        mDropInRequest.isAndroidPayPhoneNumberRequired(),
                        mDropInRequest.getAndroidPayAllowedCountriesForShipping());
                break;
            case PAY_WITH_VENMO:
                Venmo.authorizeAccount(mBraintreeFragment);
                break;
            case UNKNOWN:
                Intent intent = new Intent(this, AddCardActivity.class)
                        .putExtra(DropInRequest.EXTRA_CHECKOUT_REQUEST, mDropInRequest);
                startActivityForResult(intent, ADD_CARD_REQUEST_CODE);
                break;
        }
    }

    private void fetchPaymentMethodNonces() {
        try {
            if (Authorization.fromString(mDropInRequest.getAuthorization()) instanceof ClientToken) {
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        if (!DropInActivity.this.isFinishing()) {
                            if (mBraintreeFragment.hasFetchedPaymentMethodNonces()) {
                                onPaymentMethodNoncesUpdated(mBraintreeFragment.getCachedPaymentMethodNonces());
                            } else {
                                PaymentMethod.getPaymentMethodNonces(mBraintreeFragment, true);
                            }
                        }
                    }
                }, getResources().getInteger(android.R.integer.config_shortAnimTime));
            }
        } catch (InvalidArgumentException ignored) {}
    }

    @Override
    public void onPaymentMethodNoncesUpdated(final List<PaymentMethodNonce> paymentMethodNonces) {
        if (paymentMethodNonces.size() > 0) {
            mSupportedPaymentMethodsHeader.setText(R.string.bt_other);
            mVaultedPaymentMethodsContainer.setVisibility(View.VISIBLE);
            mVaultedPaymentMethodsView.setAdapter(new VaultedPaymentMethodsAdapter(this, paymentMethodNonces));
        } else {
            mSupportedPaymentMethodsHeader.setText(R.string.bt_select_payment_method);
        }
    }

    @Override
    protected void onSaveInstanceState(Bundle outState) {
        super.onSaveInstanceState(outState);
        outState.putBoolean(EXTRA_SHEET_SLIDE_UP_PERFORMED, mSheetSlideUpPerformed);
        outState.putString(EXTRA_DEVICE_DATA, mDeviceData);
    }

    @Override
    protected void onActivityResult(int requestCode, final int resultCode, Intent data) {
        mLoadingViewSwitcher.setDisplayedChild(0);

        if (resultCode == Activity.RESULT_CANCELED) {
            mLoadingViewSwitcher.setDisplayedChild(1);
        } else if (requestCode == ADD_CARD_REQUEST_CODE) {
            final Intent response;
            if (resultCode == Activity.RESULT_OK) {
                DropInResult result = data.getParcelableExtra(DropInResult.EXTRA_DROP_IN_RESULT);
                DropInResult.setLastUsedPaymentMethodType(this, result.getPaymentMethodNonce());

                result.deviceData(mDeviceData);
                response = new Intent()
                        .putExtra(DropInResult.EXTRA_DROP_IN_RESULT, result);
            } else {
                response = data;
            }

            slideDown(new AnimationFinishedListener() {
                @Override
                public void onAnimationFinished() {
                    setResult(resultCode, response);
                    finish();
                }
            });
        }
    }

    public void onBackgroundClicked(View v) {
        onBackPressed();
    }

    @Override
    public void onBackPressed() {
        if (!mSheetSlideDownPerformed) {
            mSheetSlideDownPerformed = true;
            mBraintreeFragment.sendAnalyticsEvent("sdk.exit.canceled");

            slideDown(new AnimationFinishedListener() {
                @Override
                public void onAnimationFinished() {
                    finish();
                }
            });
        }
    }

    private void slideUp() {
        if (!mSheetSlideUpPerformed) {
            mBraintreeFragment.sendAnalyticsEvent("appeared");

            mSheetSlideUpPerformed = true;
            mBottomSheet.startAnimation(loadAnimation(this, R.anim.bt_slide_in_up));
        }
    }

    private void slideDown(final AnimationFinishedListener listener) {
        Animation slideOutAnimation = loadAnimation(this, R.anim.bt_slide_out_down);
        slideOutAnimation.setFillAfter(true);
        if (listener != null) {
            slideOutAnimation.setAnimationListener(new AnimationListener() {
                @Override
                public void onAnimationStart(Animation animation) {}

                @Override
                public void onAnimationEnd(Animation animation) {
                    listener.onAnimationFinished();
                }

                @Override
                public void onAnimationRepeat(Animation animation) {

                }
            });
        }
        mBottomSheet.startAnimation(slideOutAnimation);
    }

    @Override
    public void finish() {
        super.finish();
        overridePendingTransition(android.R.anim.fade_in, android.R.anim.fade_out);
    }
}
