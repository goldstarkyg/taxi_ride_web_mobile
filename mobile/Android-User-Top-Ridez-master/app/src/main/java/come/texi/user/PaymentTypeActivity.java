package come.texi.user;

import android.app.Activity;
import android.app.Dialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.afollestad.materialdialogs.DialogAction;
import com.afollestad.materialdialogs.GravityEnum;
import com.afollestad.materialdialogs.MaterialDialog;
import com.braintreepayments.api.BraintreeFragment;
import com.braintreepayments.api.Card;
import com.braintreepayments.api.dropin.DropInActivity;
import com.braintreepayments.api.dropin.DropInRequest;
import com.braintreepayments.api.dropin.DropInResult;
import com.braintreepayments.api.dropin.utils.PaymentMethodType;
import com.braintreepayments.api.exceptions.InvalidArgumentException;
import com.braintreepayments.api.interfaces.PaymentMethodNonceCreatedListener;
import com.braintreepayments.api.models.CardBuilder;
import com.braintreepayments.api.models.PaymentMethodNonce;
import com.google.android.gms.wallet.Cart;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.paypal.android.sdk.payments.PayPalConfiguration;
import com.paypal.android.sdk.payments.PayPalPayment;
import com.paypal.android.sdk.payments.PayPalService;
import com.paypal.android.sdk.payments.PaymentActivity;
import com.paypal.android.sdk.payments.PaymentConfirmation;
import com.squareup.picasso.Picasso;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONException;
import org.json.JSONObject;

import java.math.BigDecimal;
import java.net.URLEncoder;

import come.texi.user.utils.AllTripFeed;
import come.texi.user.utils.CircleTransform;
import come.texi.user.utils.Common;
import come.texi.user.utils.SimpleRatingBar;
import come.texi.user.utils.TwitterApplication;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

public class PaymentTypeActivity extends AppCompatActivity {

    RelativeLayout layout_brain_tree,layout_cash_cancel,layout_cash;

    /* Paypall Payment Variable*/
    private static final String CONFIG_ENVIRONMENT = PayPalConfiguration.ENVIRONMENT_PRODUCTION;

    // note that these credentials will differ between live & sandbox environments.
    private static final String CONFIG_CLIENT_ID = "Ab46Qf29uNeQc0RFeRBBJETiRxHVIP3zG6Nyipyj7TwevZZqCUlEKvSpkxJANtUBSx_nbh4-ronG4F_G";

    private static final int REQUEST_CODE_PAYMENT = 1;

    private static PayPalConfiguration config = new PayPalConfiguration()
            .environment(CONFIG_ENVIRONMENT)
            .clientId(CONFIG_CLIENT_ID)
            // The following are only used in PayPalFuturePaymentActivity.
            .merchantName("Example Merchant")
            .merchantPrivacyPolicyUri(Uri.parse("https://www.example.com/privacy"))
            .merchantUserAgreementUri(Uri.parse("https://www.example.com/legal"));

    private static final String TAG = "paymentExample";

     String BookingId;
    String TotalPrice;
    String TransactionId = "    ";
    int Position;
    String PaymentType = "";

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;
    SharedPreferences userPref;

    AllTripFeed allTripFeed;
    String paymentStatus;

    TextView tv_price_message;
    String uploadDriverId;

    boolean isSelectPayment;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_payment_type);

        try{
            userPref = PreferenceManager.getDefaultSharedPreferences(PaymentTypeActivity.this);
            allTripFeed = Common.allTripFeeds;
            if(allTripFeed.getDriverDetail()!=null && !allTripFeed.getDriverDetail().equals("null")){
                JSONObject driverObj = new JSONObject(allTripFeed.getDriverDetail());
                uploadDriverId=driverObj.getString("id");
                System.out.println("User App - Driver Details >>"+uploadDriverId);
            }

        }catch (Exception e){
            e.printStackTrace();
        }

        System.out.println("All Trip Feed Data >>>"+allTripFeed);

        ProgressDialog = new Dialog(PaymentTypeActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        BookingId = getIntent().getStringExtra("BookingId");
        TotalPrice = getIntent().getStringExtra("TotalPrice");
        Position = getIntent().getIntExtra("Position",0);
        Log.d("Position","Position = "+Position);

        tv_price_message = (TextView)findViewById(R.id.tv_price_message);
        tv_price_message.setText(getString(R.string.your_payable_amount)+" "+Common.Currency+" "+TotalPrice);


        layout_brain_tree = (RelativeLayout)findViewById(R.id.layout_brain_tree);
        layout_brain_tree.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                Intent mi = new Intent(PaymentTypeActivity.this, AddPaymentCardActivity.class);
                mi.putExtra("which_screen","3");
                mi.putExtra("amount",Common.Currency+" "+TotalPrice);
                startActivityForResult(mi,101);

            }
        });

        layout_cash_cancel = (RelativeLayout)findViewById(R.id.layout_cash_cancel);
        layout_cash_cancel.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        layout_cash = (RelativeLayout)findViewById(R.id.layout_cash);
//        layout_cash.setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                PaymentType = "cash";
//                paymentStatus="2";
//                ConfirmBookin();
//            }
//        });

    }


    public void onBuyPressed(View pressed) {
        /*
         * PAYMENT_INTENT_SALE will cause the payment to complete immediately.
         * Change PAYMENT_INTENT_SALE to
         *   - PAYMENT_INTENT_AUTHORIZE to only authorize payment and capture funds later.
         *   - PAYMENT_INTENT_ORDER to create a payment for authorization and capture
         *     later via calls from your server.
         *
         * Also, to include additional payment details and an item list, see getStuffToBuy() below.
         */
        PayPalPayment thingToBuy = getThingToBuy(PayPalPayment.PAYMENT_INTENT_SALE);

        /*
         * See getStuffToBuy(..) for examples of some available payment options.
         */

        Intent intent = new Intent(PaymentTypeActivity.this, PaymentActivity.class);
        // send the same configuration for restart resiliency
        intent.putExtra(PayPalService.EXTRA_PAYPAL_CONFIGURATION, config);
        intent.putExtra(PaymentActivity.EXTRA_PAYMENT, thingToBuy);
        startActivityForResult(intent, REQUEST_CODE_PAYMENT);
    }

    private PayPalPayment getThingToBuy(String paymentIntent) {
        return new PayPalPayment(new BigDecimal(TotalPrice), "USD", "Booking Price",
                paymentIntent);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if (requestCode == REQUEST_CODE_PAYMENT) {
            if (resultCode == Activity.RESULT_OK) {
                PaymentConfirmation confirm =
                        data.getParcelableExtra(PaymentActivity.EXTRA_RESULT_CONFIRMATION);
                if (confirm != null) {
                    try {
                        Log.i(TAG, confirm.toJSONObject().toString(4));
                        Log.i(TAG, confirm.getPayment().toJSONObject().toString(4));

                        JSONObject payPallObj = new JSONObject(confirm.toJSONObject().toString(4));
                        JSONObject payPalRes = new JSONObject(payPallObj.getString("response"));
                        TransactionId = payPalRes.getString("id");

                        ProgressDialog.show();
                        cusRotateLoading.start();
                        PaymentType = "PayPal";
                        paymentStatus="2";
                        ConfirmBookin();


                    } catch (JSONException e) {
                        Log.e(TAG, "an extremely unlikely failure occurred: ", e);
                    }
                }
            } else if (resultCode == Activity.RESULT_CANCELED) {
                Log.i(TAG, "The user canceled.");
                ProgressDialog.show();
                cusRotateLoading.start();
                PaymentType = "Paypal";
                paymentStatus="1";
                ConfirmBookin();

            } else if (resultCode == PaymentActivity.RESULT_EXTRAS_INVALID) {

                ProgressDialog.show();
                cusRotateLoading.start();
                PaymentType = "Paypal";
                paymentStatus="1";
                ConfirmBookin();

                Log.i(TAG,"An invalid Payment or PayPalConfiguration was submitted. Please see the docs.");
            }

        }else if (requestCode == 101) {
            if(data!= null){
                isSelectPayment=data.getBooleanExtra("selected",false);
                String nonceStr=data.getStringExtra("nonce");
                Log.e("Okayswiss","PaymentTypeActivity -> isSelectPayment ="+isSelectPayment+"--"+nonceStr);
                if(isSelectPayment){
                    displayResult(nonceStr,TotalPrice);
                }
                isSelectPayment=false;
            }
        }

    }


    public void ConfirmBookin(){

        String PaymentUrl = Url.PaymentComUrl+"?booking_id="+BookingId+"&payment_type="+PaymentType
                +"&transaction_id="+TransactionId.toString().trim()
                +"&user_id="+userPref.getString("id", "")
                +"&driver_id="+uploadDriverId+"&final_amount="+TotalPrice+"&payment_status="+paymentStatus;
        Log.d("PaymentUrl","PaymentUrl = "+PaymentUrl);


        Ion.with(PaymentTypeActivity.this)
                .load(PaymentUrl)
                .setTimeout(60*60*1000)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ProgressDialog.cancel();
                        cusRotateLoading.stop();

                        // do stuff with the result or error
                        if (e != null) {
                            //Toast.makeText(FinishTripActivity.this, "Login Error" + e, Toast.LENGTH_LONG).show();
                            Common.showMkError(PaymentTypeActivity.this,e.getMessage());
                            return;
                        }

                        try {
                            JSONObject jsonObject = new JSONObject(result.toString());
                            Log.d("jsonObject","jsonObject = "+jsonObject);
                            if (jsonObject.has("status") && jsonObject.getString("status").equals("success")) {
                                if(paymentStatus.equals("2"))
                                openReviewDialog();
                            }
                        } catch (Exception e1) {
                            e1.printStackTrace();
                        }


                    }
                });

    }

    private void displayResult(String paymentMethodNonce, String totalPrice) {

        Ion.with(PaymentTypeActivity.this)
                .load(Url.BrainTree_Checkout)
                .setTimeout(60*60*1000)
                .setBodyParameter("amount", totalPrice)
                .setBodyParameter("payment_method_nonce",paymentMethodNonce)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception error, JsonObject result) {
                        // do stuff with the result or error
                        Log.e("Braintree", "Checkout result = " + result + "==" + error);
                        if (error == null) {

                            try {
                                JSONObject tranctResponse = new JSONObject(result.toString());
                                if(tranctResponse.getBoolean("success")){

                                    JSONObject jsonObject = tranctResponse.getJSONObject("data");

                                    if(jsonObject.getBoolean("success")){

                                        JSONObject trResponse =jsonObject.getJSONObject("transaction");

                                        System.out.println("Transaction Success details >>> id:"+trResponse.getString("id")+"\n Amount"+trResponse.getString("amount"));

//                                        if(trResponse.getString("status").equals("authorized")){
//                                            Toast.makeText(PaymentTypeActivity.this,trResponse.getString("status"),Toast.LENGTH_LONG).show();
//                                            TransactionId = trResponse.getString("id");
//                                            ProgressDialog.show();
//                                            cusRotateLoading.start();
//                                            PaymentType = "braintree";
//                                            paymentStatus="2";
//                                            ConfirmBookin();
//
//                                        }
//                                        else
                                        if(trResponse.getString("status").equals("submitted_for_settlement")){
                                            Toast.makeText(PaymentTypeActivity.this,trResponse.getString("status"),Toast.LENGTH_LONG).show();
                                            TransactionId = trResponse.getString("id");
                                            ProgressDialog.show();
                                            cusRotateLoading.start();
                                            PaymentType = "braintree";
                                            paymentStatus="2";
                                            ConfirmBookin();
                                        }
                                        else if(trResponse.getString("status").equals("failed")){
                                            Toast.makeText(PaymentTypeActivity.this,jsonObject.getString("status"),Toast.LENGTH_LONG);
                                            ProgressDialog.show();
                                            cusRotateLoading.start();
                                            PaymentType = "braintree";
                                            paymentStatus="1";
                                            ConfirmBookin();

                                        }else{
                                            ProgressDialog.show();
                                            cusRotateLoading.start();
                                            PaymentType = "braintree";
                                            paymentStatus="1";
                                            ConfirmBookin();
                                        }


                                    }else{

                                        if(jsonObject.has("message"))
                                        Toast.makeText(PaymentTypeActivity.this,jsonObject.getString("message"),Toast.LENGTH_LONG);


                                        ProgressDialog.show();
                                        cusRotateLoading.start();
                                        PaymentType = "braintree";
                                        paymentStatus="1";
                                        ConfirmBookin();

                                    }

                                }else{

                                    if(tranctResponse.has("errDetails")){
                                        JSONObject jsonObject = tranctResponse.getJSONObject("errDetails");
                                        Toast.makeText(PaymentTypeActivity.this,jsonObject.getString("name"),Toast.LENGTH_LONG);
                                    }

                                    ProgressDialog.show();
                                    cusRotateLoading.start();
                                    PaymentType = "braintree";
                                    paymentStatus="1";
                                    ConfirmBookin();

                                    System.out.println("Transaction Failure >>");
//
//                                    {"errDetails":{"name":"authorizationError","type":"authorizationError"},"success":false}
                                }

                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        } else {
                            Toast.makeText(PaymentTypeActivity.this,"Unable to create a transaction.",Toast.LENGTH_LONG);
                        }
                    }
                });

    }

    public void openReviewDialog(){
        MaterialDialog.Builder builder = new MaterialDialog.Builder(PaymentTypeActivity.this)
                .title(R.string.dialog_review_title)
                .titleGravity(GravityEnum.CENTER)
                .customView(R.layout.reviewupload,true)
                .cancelable(false)
                .canceledOnTouchOutside(true)
                .autoDismiss(false)
                .negativeText(R.string.cancel)
                .positiveText(R.string.submit);
        MaterialDialog dialog = builder.build();
        final ImageView iv_user_photo=(ImageView)dialog.getCustomView().findViewById(R.id.iv_user_photo);

        if(allTripFeed.getDriverDetail() != null && !allTripFeed.getDriverDetail().equals("")) {
            try {

                JSONObject userObj = new JSONObject(allTripFeed.getDriverDetail());
                uploadDriverId=userObj.getString("id");
                if (userObj.has("facebook_id") && !userObj.getString("facebook_id").equals("")) {
                    String facebookImage = Url.FacebookImgUrl + userObj.getString("facebook_id").toString()+"/picture?type=large";
                    Picasso.with(PaymentTypeActivity.this)
                            .load(facebookImage)
                            .placeholder(R.drawable.mail_defoult)
                            .resize(200, 200)
                            .transform(new CircleTransform())
                            .into(iv_user_photo);

                } else if (userObj.has("image")) {

                    Picasso.with(PaymentTypeActivity.this)
                            .load(Uri.parse(Url.DriverImageUrl+userObj.getString("image")))
                            .placeholder(R.drawable.mail_defoult)
                            .transform(new CircleTransform())
                            .into(iv_user_photo);
                }

            }catch (Exception e){
                e.printStackTrace();}
        }
        final SimpleRatingBar review_rating = (SimpleRatingBar) dialog.getCustomView().findViewById(R.id.review_rating);
        final EditText edt_reviews = (EditText) dialog.getCustomView().findViewById(R.id.edt_reviews);
        dialog.getBuilder().onNegative(new MaterialDialog.SingleButtonCallback() {
            @Override
            public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                dialog.cancel();
                allTripFeed.setIsUploadReview("0");
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        Intent resultIntent = new Intent();
                        resultIntent.putExtra("positon", Position);
                        resultIntent.putExtra("payment_type", PaymentType);
                        resultIntent.putExtra("payment_status", paymentStatus);
                        resultIntent.putExtra("reviews", "0");
                        setResult(1, resultIntent);
                        finish();
                    }
                }, 100);
            }
        });
        dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
            @Override
            public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                if(review_rating.getRating()==0){
                    Log.e("Okayswiss","Please give rating"+review_rating.getRating());
                    Toast.makeText(PaymentTypeActivity.this,"Please give rating.", Toast.LENGTH_LONG).show();
                }else if(edt_reviews.getText().toString().equals("")){
                    Log.e("Okayswiss","Please enter views");
                    Toast.makeText(PaymentTypeActivity.this,"Please enter your feed back.", Toast.LENGTH_LONG).show();
                }else{
                    dialog.cancel();
                    uploadReviews(review_rating.getRating()+"",edt_reviews.getText().toString());
                    new Handler().postDelayed(new Runnable() {
                        @Override
                        public void run() {
                            Intent resultIntent = new Intent();
                            resultIntent.putExtra("positon", Position);
                            resultIntent.putExtra("payment_type", PaymentType);
                            resultIntent.putExtra("payment_status", paymentStatus);
                            resultIntent.putExtra("reviews", "1");
                            setResult(1, resultIntent);
                            finish();
                        }
                    }, 100);
                }

                Log.e("Okayswiss","rating :"+review_rating.getRating());
                Log.e("Okayswiss","rating :"+edt_reviews.getText().toString());

            }
        });
        dialog.show();

    }
    public void uploadReviews(String rating,String feedback){

        try {
//        http://139.59.154.174/web_service/driver_rate?driver_id=114&user_id=142&user_comment=test&driver_rate=3
            Log.e("Upload Rating", Url.UploadReviewUrl + "?driver_id=" + uploadDriverId + "&user_id=" + userPref.getString("id", "") + "&user_comment=" + URLEncoder.encode(feedback,"UTF-8") + "&driver_rate=" + rating + "&book_id=" + allTripFeed.getBookingId());
            Ion.with(PaymentTypeActivity.this)
                    .load(Url.UploadReviewUrl + "?driver_id=" + uploadDriverId + "&user_id=" + userPref.getString("id", "") + "&user_comment=" + URLEncoder.encode(feedback,"UTF-8") + "&driver_rate=" + rating + "&book_id=" + allTripFeed.getBookingId())
//                .setTimeout(60*60*1000)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception error, JsonObject result) {
                            // do stuff with the result or error
                            Log.e("Okayswiss", "reviews result = " + result + "==" + error);
                            if (error == null) {
                                try {
                                    JSONObject resObj = new JSONObject(result.toString());
                                    if (resObj.getString("status").equals("success")) {
                                        allTripFeed.setIsUploadReview("1");
                                    } else if (resObj.getString("status").equals("false")) {
                                        Common.user_InActive = 1;
                                        Common.InActive_msg = resObj.getString("message");

                                        SharedPreferences.Editor editor = userPref.edit();
                                        editor.clear();
                                        editor.commit();

                                        Intent logInt = new Intent(PaymentTypeActivity.this, LoginOptionActivity.class);
                                        logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                                        logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                        logInt.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                        startActivity(logInt);

                                    }
                                } catch (JSONException e) {
                                    e.printStackTrace();
                                }

                            } else {
                                Common.ShowHttpErrorMessage(PaymentTypeActivity.this, error.getMessage());
                            }
                        }
                    });
        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    protected void onStart() {
        // Store our shared preference
        SharedPreferences.Editor ed = userPref.edit();
        ed.putBoolean("active", true);
        ed.commit();
        super.onStart();
    }

    @Override
    protected void onStop() {
        SharedPreferences.Editor ed = userPref.edit();
        ed.putBoolean("active", false);
        ed.commit();
        super.onStop();
    }

    @Override
    public void onDestroy() {

        SharedPreferences.Editor ed = userPref.edit();
        ed.putBoolean("active", false);
        ed.commit();
        // Stop service when done
        stopService(new Intent(this, PayPalService.class));
        super.onDestroy();
    }

    @Override
    public void onBackPressed() {
        // super.onBackPressed();
        return;
    }
}
