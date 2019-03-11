package come.texi.user;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.afollestad.materialdialogs.DialogAction;
import com.afollestad.materialdialogs.GravityEnum;
import com.afollestad.materialdialogs.MaterialDialog;
import com.braintreepayments.api.BraintreeFragment;
import com.braintreepayments.api.Card;
import com.braintreepayments.api.dropin.DropInResult;
import com.braintreepayments.api.dropin.utils.PaymentMethodType;
import com.braintreepayments.api.interfaces.BraintreeErrorListener;
import com.braintreepayments.api.interfaces.PaymentMethodNonceCreatedListener;
import com.braintreepayments.api.models.CardBuilder;
import com.braintreepayments.api.models.CardConfiguration;
import com.braintreepayments.api.models.CardNonce;
import com.braintreepayments.api.models.PaymentMethodNonce;
import com.braintreepayments.cardform.OnCardFormFieldFocusedListener;
import com.braintreepayments.cardform.OnCardFormSubmitListener;
import com.braintreepayments.cardform.utils.CardType;
import com.braintreepayments.cardform.view.CardEditText;
import com.braintreepayments.cardform.view.CardForm;
import com.google.gson.JsonObject;
import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import come.texi.user.adapter.CardsAdapter;
import come.texi.user.utils.Common;
import come.texi.user.utils.TwitterApplication;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

public class AddPaymentCardActivity extends AppCompatActivity implements BraintreeErrorListener,OnCardFormSubmitListener,OnCardFormFieldFocusedListener,PaymentMethodNonceCreatedListener,CardsAdapter.OnCardTypeClickListener {

    RelativeLayout layout_slidemenu;
    TextView txt_rate_card;
    SlidingMenu slidingMenu;
    Typeface OpenSans_Bold,OpenSans_Regular,Robot_Regular,Roboto_medium;
    private CardForm mCardForm;
    protected BraintreeFragment mBraintreeFragment;
    protected String mAuthorization;

    private CardType mCardType;

    private RecyclerView rv_cards;
    private CardsAdapter cardsAdapter;
    SharedPreferences userPref;

    //Loader
    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    boolean isCardAdded=false;
    String whichScreen;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_card_view);

        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Regular_0.ttf");
        Robot_Regular = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");
        Roboto_medium = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Medium.ttf");

        userPref = PreferenceManager.getDefaultSharedPreferences(AddPaymentCardActivity.this);

        rv_cards=(RecyclerView)findViewById(R.id.rv_cards);

        LinearLayoutManager llManager = new LinearLayoutManager(this,LinearLayoutManager.HORIZONTAL,false);
        rv_cards.setLayoutManager(llManager);



        layout_slidemenu = (RelativeLayout)findViewById(R.id.layout_slidemenu);
        txt_rate_card = (TextView) findViewById(R.id.txt_rate_card);

        try {
            whichScreen=getIntent().getStringExtra("which_screen");
            if(whichScreen!=null && (whichScreen.equals("2") || whichScreen.equals("3"))){
                layout_slidemenu.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent resultIntent = new Intent();
                        resultIntent.putExtra("selected", false);
                        setResult(101, resultIntent);
                        finish();
                    }
                });
            }else{
               /*Slide Menu Start*/
                slidingMenu = new SlidingMenu(this);
                slidingMenu.setMode(SlidingMenu.LEFT);
                slidingMenu.setTouchModeAbove(SlidingMenu.TOUCHMODE_FULLSCREEN);
                slidingMenu.setBehindOffsetRes(R.dimen.slide_menu_width);
                slidingMenu.setFadeDegree(0.20f);
                slidingMenu.attachToActivity(this, SlidingMenu.SLIDING_CONTENT);
                slidingMenu.setMenu(R.layout.left_menu);
                layout_slidemenu.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        slidingMenu.toggle();
                    }
                });
                Common.SlideMenuDesign(slidingMenu, AddPaymentCardActivity.this, "addcard");
            }



            ProgressDialog = new Dialog(AddPaymentCardActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
            ProgressDialog.setContentView(R.layout.custom_progress_dialog);
            ProgressDialog.setCancelable(false);
            cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);


            mAuthorization = TwitterApplication.getBrainTreeClientToken(AddPaymentCardActivity.this);
            if(mAuthorization != null) {
                mBraintreeFragment = BraintreeFragment.newInstance(AddPaymentCardActivity.this, mAuthorization);
                showLastTranscation();
            }else{
                String braintreeClient;
                if(userPref.getString("braintree_id","").equals("")){
                    braintreeClient=Url.BrainTree_ClientToken;
                }else{
                    braintreeClient=Url.BrainTree_ClientToken+"?customerId="+userPref.getString("braintree_id","");
                }
                Log.e("Okayswiss","client token url :"+Url.BrainTree_ClientToken+"?customerId="+userPref.getString("braintree_id",""));
                Ion.with(AddPaymentCardActivity.this)
                    .load(braintreeClient)
                    .setTimeout(60 * 60 * 1000)
                    .asString()
                    .setCallback(new FutureCallback<String>() {
                        @Override
                        public void onCompleted(Exception error, String result) {
                            // do stuff with the result or error
                            Log.e("Okayswiss", "ClientToken result = " + result + "==" + error);
                            if (error == null) {
                                try {
                                    mAuthorization = result.toString();
                                    TwitterApplication.setBrainTreeClientToken(AddPaymentCardActivity.this, mAuthorization);
                                    mBraintreeFragment = BraintreeFragment.newInstance(AddPaymentCardActivity.this, mAuthorization);
                                    showLastTranscation();
                                } catch (Exception e) {
                                    e.printStackTrace();
                                }
                            }
                        }
                    });
            }

        } catch (Exception e) {
            Log.e("Okayswiss","Error :"+e);
        }

        mCardForm = (CardForm) findViewById(R.id.card_form);
        mCardForm.setOnFormFieldFocusedListener(this);
        mCardForm.setOnCardFormSubmitListener(this);
        mCardForm.cardRequired(true)
                .expirationRequired(true)
                .cvvRequired(true)
                .postalCodeRequired(true)
                .mobileNumberRequired(false)
                .actionLabel(getString(R.string.add_a_card))
                .setup(this);

        //RecyclerView
        try {

            JSONArray tmpCardsArray =new JSONArray(userPref.getString("cards", "[]"));
            if(tmpCardsArray!=null && tmpCardsArray.length()>0){
                Common.cardsArrays=tmpCardsArray;
            }
            else
            {
                Common.cardsArrays = new JSONArray();
            }
            Log.e("My Cards :", Common.cardsArrays.toString());
            cardsAdapter = new CardsAdapter(AddPaymentCardActivity.this, Common.cardsArrays);
            rv_cards.setAdapter(cardsAdapter);
            cardsAdapter.setOnCardTypeItemClickListener(AddPaymentCardActivity.this);

        } catch (Exception e) {
            e.printStackTrace();
        }
        //RecyclerView

    }

    @Override
    public void onResume() {
        super.onResume();
    }

    public void showLastTranscation(){
        DropInResult.fetchDropInResult(this, mAuthorization, new DropInResult.DropInResultListener() {
            @Override
            public void onError(Exception exception) {
                // an error occurred
                Log.e("Okayswiss","fetch exception:"+exception);
            }
            @Override
            public void onResult(DropInResult result) {
                if (result.getPaymentMethodType() != null) {
                    try {
                        PaymentMethodNonce paymentMethodNonce = result.getPaymentMethodNonce();
//                      submitNonceToServer(paymentMethod.getNonce(),paymentMethod,true);
                        if (Common.cardsArrays == null) {
                            Common.cardsArrays = new JSONArray();
                            JSONObject jsonObject = new JSONObject();
                            jsonObject.put("name", ((CardNonce) paymentMethodNonce).getCardType().toUpperCase());
                            jsonObject.put("card_no", "ending in " + ((CardNonce) paymentMethodNonce).getLastTwo());
                            jsonObject.put("full_card_no","");
                            jsonObject.put("cvv","");
                            jsonObject.put("expiry_date","");
                            jsonObject.put("postalcode","");
                            jsonObject.put("image", PaymentMethodType.forType(paymentMethodNonce).getDrawable());
                            jsonObject.put("nonce", paymentMethodNonce.getNonce());
                            jsonObject.put("cardtype", ((CardNonce) paymentMethodNonce).getCardType().toUpperCase());
                            jsonObject.put("cardimage", PaymentMethodType.forType(paymentMethodNonce).getDrawable());
                            jsonObject.put("lastdigits", ((CardNonce) paymentMethodNonce).getLastTwo());
                            jsonObject.put("month",mCardForm.getExpirationMonth());
                            jsonObject.put("year",mCardForm.getExpirationYear());
                            jsonObject.put("is_selected", true);
                            Common.cardsArrays.put(jsonObject);

                            cardsAdapter = new CardsAdapter(AddPaymentCardActivity.this, Common.cardsArrays);
                            rv_cards.setAdapter(cardsAdapter);
                            cardsAdapter.setOnCardTypeItemClickListener(AddPaymentCardActivity.this);

                        } else if (Common.cardsArrays != null && Common.cardsArrays.length() > 0) {
                            for (int i = 0; i < Common.cardsArrays.length(); i++) {
                                JSONObject jsonObject = Common.cardsArrays.getJSONObject(i);
                                if (jsonObject.has("full_card_no") && jsonObject.getString("full_card_no").equals("") && jsonObject.has("lastdigits") && jsonObject.getString("lastdigits").equals(((CardNonce) paymentMethodNonce).getLastTwo())) {
                                    jsonObject.put("nonce", paymentMethodNonce.getNonce());
                                    Log.e("Okayswiss", "last 2 digit :" + jsonObject.getString("lastdigits"));
                                    Log.e("Okayswiss", "last 2 digit :" + ((CardNonce) paymentMethodNonce).getLastTwo());
                                    break;
                                }
                            }
                            cardsAdapter.updateItems();

                        }
                        Log.e("OkaySwiss","onSaveCard fromRecent"+Common.cardsArrays.toString());

                    }catch(Exception e){
                        e.printStackTrace();
                    }
                } else {
                    // there was no existing payment method
                }
            }
        });
    }

    @Override
    public void onCardFormFieldFocused(View field) {
        if (!(field instanceof CardEditText) && !TextUtils.isEmpty(mCardForm.getCardNumber())) {
            CardType cardType = CardType.forCardNumber(mCardForm.getCardNumber());
            if(mCardType != cardType) {
                mCardType  = cardType;
            }
        }
    }

    @Override
    public void onCardFormSubmit() {
        Log.e("OkaySwiss","onCardFormSubmit");
        onSaveCard(null);
    }

    public void onSaveCard(View v) {
        isCardAdded=true;
        CardBuilder cardBuilder = new CardBuilder()
                .cardNumber(mCardForm.getCardNumber())
                .expirationMonth(mCardForm.getExpirationMonth())
                .expirationYear(mCardForm.getExpirationYear())
                .cvv(mCardForm.getCvv())
                .validate(true)
                .postalCode(mCardForm.getPostalCode());
        Card.tokenize(mBraintreeFragment, cardBuilder);

    }

    @Override
    public void onPaymentMethodNonceCreated(PaymentMethodNonce paymentMethodNonce) {
        if(isCardAdded){
            submitNonceToServer(paymentMethodNonce.getNonce(),paymentMethodNonce,false);
            isCardAdded=false;
        }else{

            final String nonceStr=paymentMethodNonce.getNonce();
            String cardnoStr="***"+((CardNonce) paymentMethodNonce).getLastTwo();
            String content=getString(R.string.you_have_selected)+cardnoStr+getString(R.string.as_your_default)+"\n"+getString(R.string.are_you_sure_want_to_proceed);
            if(whichScreen.equals("3")){
                content=getString(R.string.you_have_selected)+cardnoStr+getString(R.string.booking_amount_of)+getIntent().getStringExtra("amount")+getString(R.string.will_be_deducted)+"\n"+getString(R.string.are_you_sure_want_to_proceed);
            }
            MaterialDialog.Builder builder = new MaterialDialog.Builder(AddPaymentCardActivity.this)
                    .title(content)
                    .titleGravity(GravityEnum.START)
                    .cancelable(false)
                    .canceledOnTouchOutside(true)
                    .autoDismiss(false)
                    .negativeText(R.string.no)
                    .positiveText(R.string.yes);
            MaterialDialog dialog = builder.build();
            dialog.getBuilder().onNegative(new MaterialDialog.SingleButtonCallback() {
                @Override
                public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                    dialog.cancel();

                }
            });
            dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
                @Override
                public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                    dialog.cancel();
                    uploadToServerNonce(nonceStr);
                }
            });
            dialog.show();
        }
    }

    public void submitNonceToServer(String nonce,PaymentMethodNonce paymentMethodNonce,boolean fromRecent){

        try {
                if(Common.cardsArrays==null || Common.cardsArrays.length()==0){
                    Common.cardsArrays=new JSONArray();
                    cardsAdapter = new CardsAdapter(AddPaymentCardActivity.this, Common.cardsArrays);
                    rv_cards.setAdapter(cardsAdapter);
                    cardsAdapter.setOnCardTypeItemClickListener(AddPaymentCardActivity.this);
                }
                for(int i=0;i<Common.cardsArrays.length();i++){
                    JSONObject jsonObject1=Common.cardsArrays.getJSONObject(i);
                    if(jsonObject1.has("is_selected") && jsonObject1.getBoolean("is_selected")){
                        jsonObject1.put("is_selected",false);
                        break;
                    }
                }
                Log.e("OkaySwiss","onSaveCard current"+Common.cardsArrays.toString());
                CardType cardType = CardType.forCardNumber(mCardForm.getCardNumber());
                JSONObject jsonObject = new JSONObject();
                jsonObject.put("name",cardType);
                jsonObject.put("card_no","ending in "+((CardNonce) paymentMethodNonce).getLastTwo());
                jsonObject.put("full_card_no",mCardForm.getCardNumber());
                jsonObject.put("cvv",mCardForm.getCvv());
                jsonObject.put("expiry_date",mCardForm.getExpirationMonth()+"/"+mCardForm.getExpirationYear());
                jsonObject.put("postalcode",mCardForm.getPostalCode());
                jsonObject.put("image",PaymentMethodType.forType(paymentMethodNonce).getDrawable());
                jsonObject.put("nonce",nonce);
                jsonObject.put("cardtype",((CardNonce) paymentMethodNonce).getCardType().toUpperCase());
                jsonObject.put("cardimage",PaymentMethodType.forType(paymentMethodNonce).getDrawable());
                jsonObject.put("lastdigits",((CardNonce) paymentMethodNonce).getLastTwo());
                jsonObject.put("month",mCardForm.getExpirationMonth());
                jsonObject.put("year",mCardForm.getExpirationYear());
                jsonObject.put("is_selected",true);
                Common.cardsArrays.put(jsonObject);
                cardsAdapter.updateItems();
                rv_cards.scrollToPosition(cardsAdapter.getItemCount() - 1);

                clearAndUpdateCardsArray();

            //Now open to transcation
            final String nonceStr=paymentMethodNonce.getNonce();
            String cardnoStr="***"+((CardNonce) paymentMethodNonce).getLastTwo();
            String content=getString(R.string.you_have_selected)+cardnoStr+getString(R.string.as_your_default)+"\n"+getString(R.string.are_you_sure_want_to_proceed);
            if(whichScreen.equals("3")){
                content=getString(R.string.you_have_selected)+cardnoStr+getString(R.string.booking_amount_of)+getIntent().getStringExtra("amount")+getString(R.string.will_be_deducted)+"\n"+getString(R.string.are_you_sure_want_to_proceed);
            }
            MaterialDialog.Builder builder = new MaterialDialog.Builder(AddPaymentCardActivity.this)
                    .title(content)
                    .titleGravity(GravityEnum.START)
                    .cancelable(false)
                    .canceledOnTouchOutside(true)
                    .autoDismiss(false)
                    .negativeText(R.string.no)
                    .positiveText(R.string.yes);
            MaterialDialog dialog = builder.build();
            dialog.getBuilder().onNegative(new MaterialDialog.SingleButtonCallback() {
                @Override
                public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                    dialog.cancel();

                }
            });
            dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
                @Override
                public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                    dialog.cancel();
                    uploadToServerNonce(nonceStr);
                }
            });
            dialog.show();




            } catch (JSONException e) {
                e.printStackTrace();
            }



    }

    private void clearAndUpdateCardsArray() {

        SharedPreferences.Editor editor1 = userPref.edit();
        editor1.putString("cards", "");
        editor1.commit();

        if(Common.cardsArrays!=null && Common.cardsArrays.length()>0) {
            SharedPreferences.Editor editor = userPref.edit();
            editor.putString("cards", Common.cardsArrays.toString());
            editor.commit();
        }

        mCardForm.getCardEditText().setText("");
        mCardForm.getCvvEditText().setText("");
        mCardForm.getExpirationDateEditText().setText("");
        mCardForm.getPostalCodeEditText().setText("");
        mCardForm.getPostalCodeEditText().clearFocus();

    }

    private void uploadToServerNonce(final String nonce){
        ProgressDialog.show();
        cusRotateLoading.start();
        Log.e("Okayswiss", "submit_to_server nonce :" + Url.BrainTree_SubmitNonce + "?user_id=" + userPref.getString("id", "") + "&payment_nonce=" + nonce);
        Ion.with(AddPaymentCardActivity.this)
                .load(Url.BrainTree_SubmitNonce + "?user_id=" + userPref.getString("id", "") + "&payment_nonce=" + nonce)
                .setTimeout(60 * 60 * 1000)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        ProgressDialog.cancel();
                        cusRotateLoading.stop();
                        // do stuff with the result or error
                        if (e != null) {
                            Log.e("Okayswiss", "error :" + e.getMessage());
                            Common.showMkError(AddPaymentCardActivity.this, e.getMessage());
                            return;
                        }
                        try {
                            JSONObject jsonObject = new JSONObject(result.toString());
                            Log.e("Okayswiss", "submit nonce response = " + jsonObject);
                            if (jsonObject.has("status") && jsonObject.getString("status").equals("success")) {
                                Intent resultIntent = new Intent();
                                resultIntent.putExtra("selected", true);
                                if(whichScreen!=null && whichScreen.equals("3")){
                                    resultIntent.putExtra("nonce",nonce);
                                }
                                setResult(101, resultIntent);
                                finish();
                            }
                        } catch (Exception e1) {
                            ProgressDialog.cancel();
                            cusRotateLoading.stop();
                            e1.printStackTrace();
                        }
                    }
                });
    }


    @Override
    public void onError(Exception error) {
        showDialog(error.getMessage());
    }

    protected void showDialog(String message) {
        new AlertDialog.Builder(this)
        .setMessage(message)
        .setPositiveButton(android.R.string.ok, new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        })
        .show();
    }

    @Override
    public void onBackPressed() {
        Intent resultIntent = new Intent();
        resultIntent.putExtra("selected", false);
        setResult(101, resultIntent);
        finish();
        super.onBackPressed();
    }

    @Override
    public void SelectCardType(int position) {
        try{
            if(Common.cardsArrays!=null && Common.cardsArrays.length() > 0) {
                JSONObject jsonObject = Common.cardsArrays.getJSONObject(position);
                Log.e("Okayswiss","selected items before:-"+jsonObject);
                for(int i=0;i<Common.cardsArrays.length();i++){
                    JSONObject jsonObject1=Common.cardsArrays.getJSONObject(i);
                    if(jsonObject1.has("is_selected") && jsonObject1.getBoolean("is_selected")){
                        jsonObject1.put("is_selected",false);
                        break;
                    }
                }
                Log.e("Okayswiss","selected items after:-"+jsonObject);
                jsonObject.put("is_selected",true);
                cardsAdapter.notifyDataSetChanged();
                isCardAdded=false;

                Log.e("Okayswiss","All card details before:"+jsonObject.getString("full_card_no")+"\n"+jsonObject.getString("month")+"\n"+jsonObject.getString("year")+"\n"+jsonObject.getString("cvv")+"\n"+jsonObject.getString("postalcode"));
                if(jsonObject.has("full_card_no") && !jsonObject.getString("full_card_no").equals("") && jsonObject.has("cvv") && !jsonObject.getString("cvv").equals("")){
                    CardBuilder cardBuilder = new CardBuilder()
                            .cardNumber(jsonObject.getString("full_card_no"))
                            .expirationMonth(jsonObject.getString("month"))
                            .expirationYear(jsonObject.getString("year"))
                            .cvv(jsonObject.getString("cvv"))
                            .postalCode(jsonObject.getString("postalcode"));
                    Card.tokenize(mBraintreeFragment, cardBuilder);
                    Log.e("Okayswiss","All card details after:"+jsonObject.getString("full_card_no")+"\n"+jsonObject.getString("month")+"\n"+jsonObject.getString("year")+"\n"+jsonObject.getString("cvv")+"\n"+jsonObject.getString("postalcode"));
                }
                else
                {
                    final String nonceToServer = jsonObject.getString("nonce");
                    String cardnoStr="***"+jsonObject.getString("lastdigits");
                    String content=getString(R.string.you_have_selected)+cardnoStr+getString(R.string.as_your_default)+"\n"+getString(R.string.are_you_sure_want_to_proceed);
                    if(whichScreen.equals("3")){
                        content=getString(R.string.you_have_selected)+cardnoStr+getString(R.string.booking_amount_of)+getIntent().getStringExtra("amount")+getString(R.string.will_be_deducted)+"\n"+getString(R.string.are_you_sure_want_to_proceed);
                    }
                    MaterialDialog.Builder builder = new MaterialDialog.Builder(AddPaymentCardActivity.this)
                            .title(content)
                            .titleGravity(GravityEnum.START)
                            .cancelable(false)
                            .canceledOnTouchOutside(true)
                            .autoDismiss(false)
                            .negativeText(R.string.no)
                            .positiveText(R.string.yes);
                    MaterialDialog dialog = builder.build();
                    dialog.getBuilder().onNegative(new MaterialDialog.SingleButtonCallback() {
                        @Override
                        public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                            dialog.cancel();

                        }
                    });
                    dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
                        @Override
                        public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                            dialog.cancel();
                            uploadToServerNonce(nonceToServer);
                        }
                    });
                    dialog.show();

                }
                clearAndUpdateCardsArray();

            }

        }catch (Exception e){
            e.printStackTrace();
        }
    }

    @Override
    public void deleteCard(final int position,String cardNo) {
            String contentStr=getString(R.string.you_have_selected)+cardNo+"\n"+getString(R.string.are_you_sure_want_to_delete);
            MaterialDialog.Builder builder = new MaterialDialog.Builder(AddPaymentCardActivity.this)
                    .title(contentStr)
                    .titleGravity(GravityEnum.START)
                    .cancelable(false)
                    .canceledOnTouchOutside(true)
                    .autoDismiss(false)
                    .negativeText(R.string.no)
                    .positiveText(R.string.yes);
            MaterialDialog dialog = builder.build();
            dialog.getBuilder().onNegative(new MaterialDialog.SingleButtonCallback() {
                @Override
                public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                    dialog.cancel();
                }
            });
            dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
                @Override
                public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                    dialog.cancel();
                    try{
                        if(Common.cardsArrays!=null && Common.cardsArrays.length() > 0) {
                            Log.e("Okayswiss","before size :"+Common.cardsArrays.length());
                            JSONArray jsonArray = new JSONArray();
                            for(int i=0;i<Common.cardsArrays.length();i++){
                                if(position!=i){
                                    jsonArray.put(Common.cardsArrays.get(i));
                                }
                            }
                            Common.cardsArrays=jsonArray;
                            Log.e("Okayswiss","after position :"+position);
                            Log.e("Okayswiss","after size :"+Common.cardsArrays.length());
                            cardsAdapter.removeItemsCard(position,Common.cardsArrays);
                            clearAndUpdateCardsArray();
                        }
                    }catch (Exception e){
                        e.printStackTrace();
                    }
                }
            });
            dialog.show();
    }

}
