package come.texi.user;

import android.app.Activity;
import android.app.Dialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.io.IOException;
import java.util.TimeZone;

import come.texi.user.utils.Common;
import come.texi.user.utils.Url;
import cz.msebera.android.httpclient.HttpEntity;
import cz.msebera.android.httpclient.HttpResponse;
import cz.msebera.android.httpclient.client.ClientProtocolException;
import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.client.ResponseHandler;
import cz.msebera.android.httpclient.client.methods.HttpGet;
import cz.msebera.android.httpclient.client.methods.HttpPost;
import cz.msebera.android.httpclient.entity.mime.HttpMultipartMode;
import cz.msebera.android.httpclient.entity.mime.MultipartEntityBuilder;
import cz.msebera.android.httpclient.entity.mime.content.FileBody;
import cz.msebera.android.httpclient.impl.client.DefaultHttpClient;
import cz.msebera.android.httpclient.params.HttpConnectionParams;
import cz.msebera.android.httpclient.params.HttpParams;
import cz.msebera.android.httpclient.util.EntityUtils;
import com.ocriders.appu.R;

import static come.texi.user.utils.Common.showMKPanelError;

public class OneTimePasswordActivity extends AppCompatActivity {


    RelativeLayout layout_back_arrow,layout_submin_button;
    EditText edit_one_time_pass;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;
    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;
    Typeface regularRoboto;

    String ActivityName = "";

    private static OneTimePasswordActivity inst;

    public static OneTimePasswordActivity instance() {
        return inst;
    }

    @Override
    public void onStart() {
        super.onStart();
        inst = this;
    }

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_one_time_password);

        ActivityName = getIntent().getStringExtra("ActivityName");

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        regularRoboto = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");

        ProgressDialog = new Dialog(OneTimePasswordActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(true);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);


        if(Common.checkAndRequestPermissions(OneTimePasswordActivity.this)){
            if(Common.isNetworkAvailable(OneTimePasswordActivity.this)) {
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        new SendSmsByTwiliyo().execute();
                    }
                }, 100);

            }else {
                Common.showInternetInfo(OneTimePasswordActivity.this, "");
            }
        }


        layout_back_arrow = (RelativeLayout)findViewById(R.id.layout_back_arrow);
        layout_back_arrow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                finish();
            }
        });

        edit_one_time_pass = (EditText)findViewById(R.id.edit_one_time_pass);

        layout_submin_button = (RelativeLayout)findViewById(R.id.layout_submin_button);
        layout_submin_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if(edit_one_time_pass.getText().toString().trim().length() == 0){
                    Common.showMkError(OneTimePasswordActivity.this, getResources().getString(R.string.one_time_pass_val));
                    return;
                }

                new CheckSmsTwilio(edit_one_time_pass.getText().toString(),OneTimePasswordActivity.this).execute();
            }
        });

    }

    public class SendSmsByTwiliyo extends AsyncTask<String, Integer, String> {

        private String content;
        HttpEntity entity;

        public SendSmsByTwiliyo(){

            Log.d("Mobile","Mobile = "+Common.CountryCode+"=="+Common.Mobile);
            MultipartEntityBuilder entityBuilder = MultipartEntityBuilder.create();
            entityBuilder.setMode(HttpMultipartMode.BROWSER_COMPATIBLE);
            entityBuilder.addTextBody("via", "sms");
            entityBuilder.addTextBody("country_code", "+"+Common.CountryCode);
            entityBuilder.addTextBody("phone_number", Common.Mobile);
            entityBuilder.addTextBody("locale", "en");

            entity = entityBuilder.build();

        }

        @Override
        protected void onPreExecute() {
            Log.d("Start", "start");
            if(ProgressDialog != null) {
                ProgressDialog.show();
                cusRotateLoading.start();
            }
        }

        @Override
        protected String doInBackground(String... strings) {
            HttpClient client = new DefaultHttpClient();

            HttpParams HttpParams = client.getParams();
            HttpConnectionParams.setConnectionTimeout(HttpParams, 60 * 60 * 1000);
            HttpConnectionParams.setSoTimeout(HttpParams, 60 * 60 * 1000);

            Log.d("LoginUrl", "LoginUrl = " + Url.VarificatinStart);

            HttpPost post = new HttpPost(Url.VarificatinStart);
            post.addHeader("X-Authy-API-Key",getResources().getString(R.string.twilio_api_key));
            post.setEntity(entity);

            try {
                client.execute(post, new ResponseHandler<String>() {
                    @Override
                    public String handleResponse(HttpResponse httpResponse) throws ClientProtocolException, IOException {

                        HttpEntity httpEntity = httpResponse.getEntity();
                        content = EntityUtils.toString(httpEntity);
                        Log.d("Result >>>","Result One"+ content);

                        return content;
                    }
                });
            } catch (IOException e) {
                e.printStackTrace();
            }
            return content;
        }

        @Override
        protected void onPostExecute(String result) {
            if (ProgressDialog != null) {
                cusRotateLoading.stop();
                ProgressDialog.cancel();
            }
            boolean isStatus = Common.ShowHttpErrorMessage(OneTimePasswordActivity.this,result);
            if(isStatus) {
                try {
                    JSONObject resObj = new JSONObject(new String(result));
                    if (resObj.getString("success").equals("true")) {
                        if (resObj.getString("is_cellphone").equals("true")) {
                            //CheckSmsTwilio();
                        }
                    }else if(resObj.getString("success").equals("false")){
                        showMKPanelError(OneTimePasswordActivity.this, resObj.getString("message").toString(),rlMainView,tvTitle,regularRoboto);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }

    public void updateList(final String smsMessage, final Activity inst) {

        if(!smsMessage.equals("")) {
            edit_one_time_pass.setText(smsMessage);
            if(Common.isNetworkAvailable(OneTimePasswordActivity.this)){


                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        new CheckSmsTwilio(smsMessage,inst).execute();
                    }
                }, 100);
            }else {
                Common.showInternetInfo(OneTimePasswordActivity.this, "");

            }

        }
    }

    public class CheckSmsTwilio extends AsyncTask<String, Integer, String> {

        private String content;
        String TwilioCheckUrl = "";
        Activity activity;

        Dialog ProgressDialogTwi;
        RotateLoading cusRotateLoadingTwi;

        public CheckSmsTwilio(String CheckString,Activity inst){

            activity = inst;

            TwilioCheckUrl = Url.CheckTwilioSms+"?verification_code="+CheckString+"&country_code="
                    +"+"+Common.CountryCode+"&phone_number="+Common.Mobile;

            ProgressDialogTwi = new Dialog(inst, android.R.style.Theme_Translucent_NoTitleBar);
            ProgressDialogTwi.setContentView(R.layout.custom_progress_dialog);
            ProgressDialogTwi.setCancelable(false);
            cusRotateLoadingTwi = (RotateLoading)ProgressDialogTwi.findViewById(R.id.rotateloading_register);


        }

        @Override
        protected void onPreExecute() {
            ProgressDialogTwi.show();
            cusRotateLoadingTwi.start();
        }

        @Override
        protected String doInBackground(String... strings) {
            HttpClient client = new DefaultHttpClient();

            HttpParams HttpParams = client.getParams();
            HttpConnectionParams.setConnectionTimeout(HttpParams, 60 * 60 * 1000);
            HttpConnectionParams.setSoTimeout(HttpParams, 60 * 60 * 1000);

            Log.d("CheckTwilioSms", "CheckTwilioSms = " + TwilioCheckUrl);

            HttpGet ChekTwi = new HttpGet(TwilioCheckUrl);
            ChekTwi.addHeader("X-Authy-API-Key",getResources().getString(R.string.twilio_api_key));

            try {
                client.execute(ChekTwi, new ResponseHandler<String>() {
                    @Override
                    public String handleResponse(HttpResponse httpResponse) throws ClientProtocolException, IOException {
                        HttpEntity httpEntity = httpResponse.getEntity();
                        content = EntityUtils.toString(httpEntity);
                        Log.d("Result >>>","Result One"+ content);
                        return content;
                    }
                });
            } catch (IOException e) {
                e.printStackTrace();
            }
            return content;
        }

        @Override
        protected void onPostExecute(String result) {
            boolean isStatus = Common.ShowHttpErrorMessage(OneTimePasswordActivity.this,result);
            if(isStatus) {
                Log.d("result","result check= "+result);
                try {
                    JSONObject resObj = new JSONObject(result);
                    if(resObj.getString("success").equals("true")){
                        if(Common.isNetworkAvailable(OneTimePasswordActivity.this)){

                            new Handler().postDelayed(new Runnable() {
                                @Override
                                public void run() {
                                    if(ActivityName.equals("SighnUp")) {
                                        new SighUpUserHttp(activity, ProgressDialogTwi, cusRotateLoadingTwi).execute();
                                    }else if(ActivityName.equals("ChangeMobile")){
                                        new UpdateMobileNumberHttp(activity, ProgressDialogTwi, cusRotateLoadingTwi).execute();
                                    }
                                }
                            }, 50);
                        }else {
                            ProgressDialogTwi.cancel();
                            cusRotateLoadingTwi.stop();
                            Common.showInternetInfo(OneTimePasswordActivity.this, "");
                        }
                    }else if(resObj.getString("success").equals("false")){
                        ProgressDialogTwi.cancel();
                        cusRotateLoadingTwi.stop();

                        if(ActivityName.equals("ChangeMobile")) {
                            Common.showDialogFragments(OneTimePasswordActivity.this, getResources().getString(R.string.otp_error));
                        }else{
                            Common.showDialogFragments(OneTimePasswordActivity.this, resObj.getString("message").toString());
                        }
//                       Toast.makeText(OneTimePasswordActivity.this,resObj.getString("message").toString(),Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }else{
                ProgressDialogTwi.cancel();
                cusRotateLoadingTwi.stop();
            }
        }
    }

    public class SighUpUserHttp extends AsyncTask<String, Integer, String>{

        private String content =  null;
        HttpEntity entity;
        Activity activity;
        SharedPreferences userPref;
        Dialog ProgressDialogTwi;
        RotateLoading cusRotateLoadingTwi;

        protected void onPreExecute() {

        }

        public SighUpUserHttp(Activity activity,Dialog ProgressDialogTwi,RotateLoading cusRotateLoadingTwi){

            MultipartEntityBuilder entityBuilder = MultipartEntityBuilder.create();
            entityBuilder.setMode(HttpMultipartMode.BROWSER_COMPATIBLE);

            entityBuilder.addTextBody("name", Common.Name);
            entityBuilder.addTextBody("email", Common.Email);
            entityBuilder.addTextBody("username", Common.UserName);
            entityBuilder.addTextBody("mobile", Common.CountryCode +" "+ Common.Mobile);
            entityBuilder.addTextBody("password", Common.Password);
            entityBuilder.addTextBody("isdevice", "1");
            if(Common.FacebookId != null && !Common.FacebookId.equals(""))
                entityBuilder.addTextBody("facebook_id", Common.FacebookId);
            else
                entityBuilder.addTextBody("facebook_id", "");
            if(Common.TwitterId != null && !Common.TwitterId.equals(""))
                entityBuilder.addTextBody("twitter_id", Common.TwitterId);
            else
                entityBuilder.addTextBody("twitter_id", "");
            entityBuilder.addTextBody("dob", Common.DateOfBirth);
            entityBuilder.addTextBody("gender", Common.Gender);
            if(Common.UserImage != null && !Common.UserImage.equals("")){
                File userFile = new File(Common.UserImage);
                entityBuilder.addPart("image", new FileBody(userFile));
            }else{
                entityBuilder.addTextBody("image", "");
            }
            entity = entityBuilder.build();

            userPref = PreferenceManager.getDefaultSharedPreferences(activity);

            this.activity = activity;
            this.ProgressDialogTwi = ProgressDialogTwi;
            this.cusRotateLoadingTwi = cusRotateLoadingTwi;

        }

        @Override
        protected String doInBackground(String... params) {

            try
            {
                HttpClient client = new DefaultHttpClient();
                HttpParams HttpParams = client.getParams();
                HttpConnectionParams.setConnectionTimeout(HttpParams, 60 * 60 * 1000);
                HttpConnectionParams.setSoTimeout(HttpParams, 60 * 60 * 1000);

                HttpPost post = new HttpPost(Url.signupUrl);
                post.setEntity(entity);
                client.execute(post, new ResponseHandler<String>() {
                    @Override
                    public String handleResponse(HttpResponse httpResponse) throws ClientProtocolException, IOException {

                        HttpEntity httpEntity = httpResponse.getEntity();
                        content = EntityUtils.toString(httpEntity);
                        Log.d("Result >>>","Result One"+ content);

                        return null;
                    }
                });

            } catch(Exception e)
            {
                e.printStackTrace();
                return e.getMessage();
            }
            return content;
        }

        @Override
        protected void onPostExecute(String result) {
            ProgressDialogTwi.cancel();
            cusRotateLoadingTwi.stop();
            Log.d("signupUrl", "signupUrl result= " + result);
            boolean isStatus = Common.ShowHttpErrorMessage(activity,result);
            if(isStatus) {
                try {
                    JSONObject resObj = new JSONObject(new String(result));
                    Log.d("signupUrl", "signupUrl two= " + resObj);
                    if (resObj.getString("status").equals("success")) {

                        JSONArray CabDetAry = new JSONArray(resObj.getString("cabDetails"));
                        Common.CabDetail = CabDetAry;

                        /*set Start Currency*/

                        JSONArray currencyArray = new JSONArray(resObj.getString("country_detail"));
                        for (int ci = 0; ci < currencyArray.length(); ci++) {
                            JSONObject startEndTimeObj = currencyArray.getJSONObject(ci);
                            Common.Currency = startEndTimeObj.getString("currency");
                            Common.Country = startEndTimeObj.getString("country");
                        }


                        /*set Start And End Time*/
                        JSONArray startEndTimeArray = new JSONArray(resObj.getString("time_detail"));
                        for (int si = 0; si < startEndTimeArray.length(); si++) {
                            JSONObject startEndTimeObj = startEndTimeArray.getJSONObject(si);
                            Common.StartDayTime = startEndTimeObj.getString("day_start_time");
                            Common.EndDayTime = startEndTimeObj.getString("day_end_time");
                        }

                        /*User Detail*/
                        JSONArray userDetilArray = new JSONArray(resObj.getString("user_Detail"));
                        JSONObject userDetilObj = userDetilArray.getJSONObject(0);

                        SharedPreferences.Editor id = userPref.edit();
                        id.putString("id", userDetilObj.getString("id").toString());
                        id.commit();

                        SharedPreferences.Editor name = userPref.edit();
                        name.putString("name", userDetilObj.getString("name").toString());
                        name.commit();

                        SharedPreferences.Editor passwordPre = userPref.edit();
                        passwordPre.putString("password", Common.Password);
                        passwordPre.commit();

                        SharedPreferences.Editor username = userPref.edit();
                        username.putString("username", userDetilObj.getString("username").toString());
                        username.commit();

                        SharedPreferences.Editor mobile = userPref.edit();
                        mobile.putString("mobile", userDetilObj.getString("mobile").toString());
                        mobile.commit();

                        SharedPreferences.Editor email = userPref.edit();
                        email.putString("email", userDetilObj.getString("email").toString());
                        email.commit();

                        SharedPreferences.Editor isLogin = userPref.edit();
                        isLogin.putString("isLogin", "1");
                        isLogin.commit();

                        SharedPreferences.Editor userImage = userPref.edit();
                        userImage.putString("userImage", userDetilObj.getString("image").toString());
                        userImage.commit();

                        SharedPreferences.Editor dob = userPref.edit();
                        dob.putString("date_of_birth", userDetilObj.getString("dob").toString());
                        dob.commit();

                        SharedPreferences.Editor gender = userPref.edit();
                        gender.putString("gender", Common.Gender);
                        gender.commit();

                        SharedPreferences.Editor braintree = userPref.edit();
                        braintree.putString("braintree_id",userDetilObj.getString("braintree_id").toString());
                        braintree.commit();


                        if(!userDetilObj.getString("facebook_id").toString().equals("")) {
                            SharedPreferences.Editor facebook_id = userPref.edit();
                            facebook_id.putString("facebook_id", userDetilObj.getString("facebook_id").toString());
                            facebook_id.commit();
                        }

                        if(!userDetilObj.getString("twitter_id").toString().equals("")) {
                            SharedPreferences.Editor twitter_id = userPref.edit();
                            twitter_id.putString("twitter_id", userDetilObj.getString("twitter_id").toString());
                            twitter_id.commit();
                        }

                        //Common.showMkSucess(SignUpActivity.this, resObj.getString("message"),"no");

                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent hi = new Intent(activity, HomeActivity.class);
                                hi.putExtra("PickupLatitude",Common.RegLattude);
                                hi.putExtra("PickupLongtude",Common.RegLontude);
                                startActivity(hi);
                                finish();
                            }
                        }, 100);

                    } else if (resObj.getString("status").equals("failed")) {
                        Log.d("signupUrl", "signupUrl status = " + resObj.getString("status"));

                        Common.showLoginRegisterMkError(activity, resObj.getString("message"));
                    }
                } catch (JSONException e) {
                    Log.d("signupUrl", "signupUrl error = " + e.getMessage());
                    e.printStackTrace();
                }
            }
        }
    }

    public class UpdateMobileNumberHttp extends AsyncTask<String, Integer, String> {

        private String content = null;
        HttpEntity entity;
        Activity activity;
        SharedPreferences userPref;
        Dialog ProgressDialogTwi;
        RotateLoading cusRotateLoadingTwi;

        public UpdateMobileNumberHttp(Activity activity, Dialog ProgressDialogTwi, RotateLoading cusRotateLoadingTwi) {
            MultipartEntityBuilder entityBuilder = MultipartEntityBuilder.create();
            entityBuilder.setMode(HttpMultipartMode.BROWSER_COMPATIBLE);

            userPref = PreferenceManager.getDefaultSharedPreferences(activity);

            entityBuilder.addTextBody("user_id", userPref.getString("id", ""));
            entityBuilder.addTextBody("mobile", Common.CountryCode + " " + Common.Mobile);
            entity = entityBuilder.build();

            Log.d("User Id","User Id = "+userPref.getString("id", ""));


            this.activity = activity;
            this.ProgressDialogTwi = ProgressDialogTwi;
            this.cusRotateLoadingTwi = cusRotateLoadingTwi;

        }

        @Override
        protected String doInBackground(String... strings) {
            try {
                HttpClient client = new DefaultHttpClient();
                HttpParams HttpParams = client.getParams();
                HttpConnectionParams.setConnectionTimeout(HttpParams, 60 * 60 * 1000);
                HttpConnectionParams.setSoTimeout(HttpParams, 60 * 60 * 1000);

                HttpPost post = new HttpPost(Url.mobileUpdateUrl);
                post.setEntity(entity);
                client.execute(post, new ResponseHandler<String>() {
                    @Override
                    public String handleResponse(HttpResponse httpResponse) throws ClientProtocolException, IOException {

                        HttpEntity httpEntity = httpResponse.getEntity();
                        content = EntityUtils.toString(httpEntity);
                        Log.d("Result >>>", "Result One" + content);

                        return null;
                    }
                });

            } catch (Exception e) {
                e.printStackTrace();
                return e.getMessage();
            }
            return content;
        }

        @Override
        protected void onPostExecute(String result) {
            ProgressDialogTwi.cancel();
            cusRotateLoadingTwi.stop();
            Log.d("signupUrl", "signupUrl result= " + result);
            boolean isStatus = Common.ShowHttpErrorMessage(activity, result);
            if (isStatus) {

                try {
                    JSONObject resObj = new JSONObject(new String(result));
                    Log.d("signupUrl", "signupUrl two= " + resObj);
                    if (resObj.getString("status").equals("success")) {

                        Common.showMkSucess(activity, getResources().getString(R.string.mobile_update_sucess),"yes");

                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                finish();
                            }
                        }, 2000);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }


            }
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, String permissions[], int[] grantResults) {

        if(requestCode == 3){
            if(Common.checkAndRequestPermissions(OneTimePasswordActivity.this)){
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        new SendSmsByTwiliyo().execute();
                    }
                }, 100);
            }
        }
    }
}
