package come.texi.user;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
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
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.Locale;

import come.texi.user.countrypicker.Country;
import come.texi.user.countrypicker.CountryPickerCallbacks;
import come.texi.user.countrypicker.CountryPickerDialog;
import come.texi.user.utils.Common;
import come.texi.user.utils.Url;
import cz.msebera.android.httpclient.HttpEntity;
import cz.msebera.android.httpclient.HttpResponse;
import cz.msebera.android.httpclient.client.ClientProtocolException;
import cz.msebera.android.httpclient.client.HttpClient;
import cz.msebera.android.httpclient.client.ResponseHandler;
import cz.msebera.android.httpclient.client.methods.HttpPost;
import cz.msebera.android.httpclient.entity.mime.HttpMultipartMode;
import cz.msebera.android.httpclient.entity.mime.MultipartEntityBuilder;
import cz.msebera.android.httpclient.impl.client.DefaultHttpClient;
import cz.msebera.android.httpclient.params.HttpConnectionParams;
import cz.msebera.android.httpclient.params.HttpParams;
import cz.msebera.android.httpclient.util.EntityUtils;
import com.ocriders.appu.R;

import static come.texi.user.utils.Common.showMKPanelError;

public class ChangeMobileNumberActivity extends AppCompatActivity {

    SlidingMenu slidingMenu;

    EditText edit_country_code,edit_mobile_number;
    RelativeLayout layout_menu,layout_change_password_button;

    Dialog countryPicker;

    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;

    SharedPreferences userPref;
    Typeface OpenSans_Regular,OpenSans_Bold,regularRoboto,Roboto_Bold;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    String[] MobileNumberString;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change_mobile_number);

        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Regular_0.ttf");
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        regularRoboto = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Bold.ttf");

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        RelativeLayout.LayoutParams params = new RelativeLayout.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
        params.setMargins(0, (int) getResources().getDimension(R.dimen.height_50), 0, 0);
        rlMainView.setLayoutParams(params);

        ProgressDialog = new Dialog(ChangeMobileNumberActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        userPref = PreferenceManager.getDefaultSharedPreferences(ChangeMobileNumberActivity.this);

        slidingMenu = new SlidingMenu(this);
        slidingMenu.setMode(SlidingMenu.LEFT);
        slidingMenu.setTouchModeAbove(SlidingMenu.TOUCHMODE_FULLSCREEN);
        slidingMenu.setBehindOffsetRes(R.dimen.slide_menu_width);
        slidingMenu.setFadeDegree(0.20f);
        slidingMenu.attachToActivity(this, SlidingMenu.SLIDING_CONTENT);
        slidingMenu.setMenu(R.layout.left_menu);

        Common common = new Common();
        common.SlideMenuDesign(slidingMenu, ChangeMobileNumberActivity.this, "change mobile number");

        MobileNumberString = userPref.getString("mobile","").split(" ");
        Log.e("Okayswiss","Mobile = "+userPref.getString("mobile","")+"=="+MobileNumberString.length);
        edit_country_code = (EditText)findViewById(R.id.edit_country_code);
        edit_country_code.setTypeface(OpenSans_Regular);

        edit_mobile_number = (EditText)findViewById(R.id.edit_mobile_number);
        edit_mobile_number.setTypeface(OpenSans_Regular);
        if(MobileNumberString.length == 2 ) {
            edit_country_code.setText("+" + MobileNumberString[0]);
            Common.CountryCode = MobileNumberString[0];
            edit_mobile_number.setText(MobileNumberString[1]);
        }else{
            edit_mobile_number.setText(MobileNumberString[0]);
            edit_country_code.setText("+41");
        }
        edit_mobile_number.setSelection(edit_mobile_number.getText().toString().length());
        edit_country_code.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                countryPicker =
                        new CountryPickerDialog(ChangeMobileNumberActivity.this, new CountryPickerCallbacks() {
                            @Override
                            public void onCountrySelected(Country country, int flagResId) {
                                // TODO handle callback
                                Log.d("country", country.getDialingCode());
                                Log.d("country",new Locale(getResources().getConfiguration().locale.getLanguage(),
                                        country.getIsoCode()).getDisplayCountry());
                                edit_country_code.setText("(+"+country.getDialingCode()+") ");
                                //+new Locale(getResources().getConfiguration().locale.getLanguage(),country.getIsoCode()).getDisplayCountry()
                                Common.CountryCode = country.getDialingCode();
                                edit_mobile_number.requestFocus();
                                new Handler().postDelayed(new Runnable() {
                                    @Override
                                    public void run() {
                                        InputMethodManager imm = (InputMethodManager) getSystemService(Context.INPUT_METHOD_SERVICE);
                                        imm.showSoftInput(edit_mobile_number, InputMethodManager.SHOW_IMPLICIT);
                                    }
                                },100);
                            }
                        });

                countryPicker.show();
            }
        });

        layout_change_password_button = (RelativeLayout)findViewById(R.id.layout_change_password_button);
        layout_change_password_button.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                if ((rlMainView.getVisibility() == View.VISIBLE)) {
                    rlMainView.setVisibility(View.GONE);
                }

                System.out.println("Mobile Number >>"+edit_mobile_number.getText().toString());
                System.out.println("Country Code >>"+edit_country_code.getText().toString());

                String mobileNo="";
                if(MobileNumberString.length == 2 ) {
                    mobileNo=MobileNumberString[1]+"";
                }else{
                    mobileNo=MobileNumberString[0]+"";
                }

                if(edit_mobile_number.getText().toString().trim().length() == 0){
                    showMKPanelError(ChangeMobileNumberActivity.this, getResources().getString(R.string.please_enter_mobile),rlMainView,tvTitle,regularRoboto);
                    edit_mobile_number.requestFocus();
                    return;
                } else if(edit_country_code.getText().toString().trim().length() == 0){
                    showMKPanelError(ChangeMobileNumberActivity.this, getResources().getString(R.string.please_country_code),rlMainView,tvTitle,regularRoboto);
                    edit_country_code.requestFocus();
                    return;
                }else if(mobileNo.equals(edit_mobile_number.getText().toString())){
                    showMKPanelError(ChangeMobileNumberActivity.this, getResources().getString(R.string.mobile_exit),rlMainView,tvTitle,regularRoboto);
                    edit_country_code.requestFocus();
                    return;
                }

                Common.Mobile = edit_mobile_number.getText().toString().trim();

                new MobileCheckHttp(edit_mobile_number).execute();
            }
        });

        layout_menu = (RelativeLayout)findViewById(R.id.layout_menu);
        layout_menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                slidingMenu.toggle();
            }
        });

    }

    public class MobileCheckHttp extends AsyncTask<String, Integer, String> {

        private String content =  null;
        HttpEntity entity;

        protected void onPreExecute() {
            Log.d("Start","start");
            ProgressDialog.show();
            cusRotateLoading.start();
        }

        public MobileCheckHttp(EditText email_edt){
            MultipartEntityBuilder entityBuilder = MultipartEntityBuilder.create();
            entityBuilder.setMode(HttpMultipartMode.BROWSER_COMPATIBLE);
            entityBuilder.addTextBody("mobile", Common.CountryCode +" "+ email_edt.getText().toString());
            entityBuilder.addTextBody("user_id", userPref.getString("id",""));
            entity = entityBuilder.build();
        }

        @Override
        protected String doInBackground(String... params) {

            try
            {
                HttpClient client = new DefaultHttpClient();
                HttpParams HttpParams = client.getParams();
                HttpConnectionParams.setConnectionTimeout(HttpParams, 60 * 60 * 1000);
                HttpConnectionParams.setSoTimeout(HttpParams, 60 * 60 * 1000);

                HttpPost post = new HttpPost(Url.mobileExitCheckUrl);
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
                Log.d("Indiaries", "Result error" + e);
                return e.getMessage();
            }
            return content;
        }

        @Override
        protected void onPostExecute(String result) {
            cusRotateLoading.stop();
            ProgressDialog.cancel();
            Log.d("signupUrl", "signupUrl result= " + result);
            boolean isStatus = Common.ShowHttpErrorMessage(ChangeMobileNumberActivity.this,result);
            if(isStatus) {
                try {
                    JSONObject resObj = new JSONObject(new String(result));
                    Log.d("signupUrl", "signupUrl two= " + resObj);
                    if (resObj.getString("status").equals("success")) {
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent oi = new Intent(ChangeMobileNumberActivity.this,OneTimePasswordActivity.class);
                                oi.putExtra("ActivityName","ChangeMobile");
                                startActivity(oi);
                            }
                        },100);
                    } else if (resObj.getString("status").equals("failed")) {
                        Log.d("signupUrl", "signupUrl status = " + resObj.getString("status"));
                        getCurrentFocus().clearFocus();
                        ProgressDialog.cancel();
                        cusRotateLoading.stop();
                        if(resObj.getString("code").equals("exists")) {
                            String message = "";
                            if(resObj.getString("error code").equals("13")){
                                message = getResources().getString(R.string.mobile_exit);
                            }else if(resObj.getString("error code").equals("14")){
                                message = getResources().getString(R.string.somthing_worng);
                            }else{
                                message = resObj.getString("message");
                            }
                            showMKPanelError(ChangeMobileNumberActivity.this, message,rlMainView,tvTitle,regularRoboto);
                        }
                    }
                } catch (JSONException e) {
                    Log.d("signupUrl", "signupUrl error = " + e.getMessage());
                    e.printStackTrace();
                }
            }

        }
    }

    @Override
    public void onBackPressed() {
        if(slidingMenu.isMenuShowing()){
            slidingMenu.toggle();
        }else {
            new AlertDialog.Builder(this)
                    .setTitle(getResources().getString(R.string.really_exit))
                    .setMessage(getResources().getString(R.string.are_you_sure))
                    .setNegativeButton(android.R.string.no, null)
                    .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {

                        public void onClick(DialogInterface arg0, int arg1) {
                            ChangeMobileNumberActivity.super.onBackPressed();
                        }
                    }).create().show();
        }
    }
}
