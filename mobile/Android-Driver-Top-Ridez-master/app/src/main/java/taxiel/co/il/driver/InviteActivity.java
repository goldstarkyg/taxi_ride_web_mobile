package taxiel.co.il.driver;

import android.app.Activity;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.Switch;
import android.widget.TextView;

import com.google.gson.JsonObject;
import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.Locale;
import com.ocriders.appd.R;
import taxiel.co.il.driver.countrypicker.Country;
import taxiel.co.il.driver.countrypicker.CountryPickerCallbacks;
import taxiel.co.il.driver.countrypicker.CountryPickerDialog;
import taxiel.co.il.driver.utils.Common;
import taxiel.co.il.driver.utils.SocketSingleObject;

public class InviteActivity extends AppCompatActivity {

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

    String countryCode;

    Common common = new Common();
    Switch driver_status;
    TextView switch_driver_status;

    GPSTracker gps;
    double latitude;
    double longitude;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_invite);

        OpenSans_Regular = Typeface.createFromAsset(getAssets(), getString(R.string.font_regular_opensans));
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), getString(R.string.font_bold_opensans));
        regularRoboto = Typeface.createFromAsset(getAssets(), getString(R.string.font_regular_roboto));
        Roboto_Bold = Typeface.createFromAsset(getAssets(), getString(R.string.font_bold_roboto));

        gps = new GPSTracker(InviteActivity.this);
        if(gps.canGetLocation()){
            latitude = gps.getLatitude();
            longitude = gps.getLongitude();
        }else{
            gps.showSettingsAlert();
        }

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        RelativeLayout.LayoutParams params = new RelativeLayout.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
        params.setMargins(0, (int) getResources().getDimension(R.dimen.height_50), 0, 0);
        rlMainView.setLayoutParams(params);

        ProgressDialog = new Dialog(InviteActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        userPref = PreferenceManager.getDefaultSharedPreferences(InviteActivity.this);

        slidingMenu = new SlidingMenu(this);
        slidingMenu.setMode(SlidingMenu.LEFT);
        slidingMenu.setTouchModeAbove(SlidingMenu.TOUCHMODE_FULLSCREEN);
        slidingMenu.setBehindOffsetRes(R.dimen.slide_menu_width);
        slidingMenu.setFadeDegree(0.20f);
        slidingMenu.attachToActivity(this, SlidingMenu.SLIDING_CONTENT);
        slidingMenu.setMenu(R.layout.left_menu);

        Common.SlideMenuDesign(slidingMenu, InviteActivity.this, "invite");

        edit_country_code = (EditText)findViewById(R.id.edit_country_code);
        edit_country_code.setTypeface(OpenSans_Regular);
        edit_country_code.setText("+1");
        countryCode="+1";
        edit_mobile_number = (EditText)findViewById(R.id.edit_mobile_number);
        edit_mobile_number.setTypeface(OpenSans_Regular);

        edit_mobile_number.setSelection(edit_mobile_number.getText().toString().length());
        edit_country_code.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                countryPicker = new CountryPickerDialog(InviteActivity.this, new CountryPickerCallbacks() {
                            @Override
                            public void onCountrySelected(Country country, int flagResId) {
                                // TODO handle callback
                                Log.d("country", country.getDialingCode());
                                Log.d("country",new Locale(getResources().getConfiguration().locale.getLanguage(),
                                        country.getIsoCode()).getDisplayCountry());
                                edit_country_code.setText("+"+country.getDialingCode()+"");
                                //+new Locale(getResources().getConfiguration().locale.getLanguage(),country.getIsoCode()).getDisplayCountry()
                                countryCode = "+"+country.getDialingCode();
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

                if((rlMainView.getVisibility() == View.VISIBLE)){
                    rlMainView.setVisibility(View.GONE);
                }

                Log.e("Okayswiss","Mobile Number >>"+edit_mobile_number.getText().toString());
                Log.e("Okayswiss","Country Code >>"+countryCode);

                if(edit_mobile_number.getText().toString().trim().length() == 0){
                    Utility.showMKPanelError(InviteActivity.this, getResources().getString(R.string.please_enter_mobile),rlMainView,tvTitle,regularRoboto);
                    edit_mobile_number.requestFocus();
                    return;
                } else if(edit_country_code.getText().toString().trim().length() == 0){
                    Utility.showMKPanelError(InviteActivity.this, getResources().getString(R.string.please_country_code),rlMainView,tvTitle,regularRoboto);
                    edit_country_code.requestFocus();
                    return;
                }

                if(countryCode.equals("+41")){

                    if (Common.isNetworkAvailable(InviteActivity.this)) {
                        ProgressDialog.show();
                        cusRotateLoading.start();
                        String inviteUrl = Url.inviteUrl+"?contact_number="+edit_mobile_number.getText().toString()+"&country_code="+countryCode+"&driver_name="+userPref.getString("name","");
                        Log.d("Okayswiss","InviteURL ="+inviteUrl);
                        Ion.with(InviteActivity.this)
                                .load(inviteUrl)
                                .asJsonObject()
                                .setCallback(new FutureCallback<JsonObject>() {
                                    @Override
                                    public void onCompleted(Exception error, JsonObject result) {
                                        // do stuff with the result or error
                                        Log.e("Okayswiss", "Invite result = " + result + "==" + error);
                                        ProgressDialog.cancel();
                                        cusRotateLoading.stop();
                                        if (error == null) {
                                            try {

                                                JSONObject resObj = new JSONObject(result.toString());
                                                if(resObj.getString("status").equals("success")) {
                                                    Common.showMkSucess(InviteActivity.this, getString(R.string.invite_success), "yes");
                                                    edit_mobile_number.setText("");

                                                }else if(resObj.getString("status").equals("failed")){
                                                    Common.showMkError(InviteActivity.this,"14");
                                                }
                                                else if(resObj.getString("status").equals("false")){

                                                    Common.showMkError(InviteActivity.this,resObj.getString("error code").toString());
                                                    if(resObj.has("Isactive") && resObj.getString("Isactive").equals("Inactive")) {

                                                        SharedPreferences.Editor editor = userPref.edit();
                                                        editor.clear();
                                                        editor.commit();

                                                        new Handler().postDelayed(new Runnable() {
                                                            @Override
                                                            public void run() {
                                                                Intent intent = new Intent(InviteActivity.this, MainActivity.class);
                                                                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
                                                                intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                                                startActivity(intent);
                                                                finish();
                                                            }
                                                        }, 2500);
                                                    }
                                                }
                                            } catch (JSONException e) {
                                                e.printStackTrace();
                                            }

                                        } else {
                                            Common.ShowHttpErrorMessage(InviteActivity.this, error.getMessage());
                                        }
                                    }
                                });
                    }

                }else{

                    String mobile = countryCode+edit_mobile_number.getText().toString();
                    String message = getString(R.string.you_have_been_invited)+userPref.getString("name","")+getString(R.string.to_join_okay_switzerland)+"\n"+
                            "iTunes - https://oc-rides.com/ \n" +
                    "Playstore - https://oc-rides.com/";
                    Uri uri = Uri.parse("smsto:"+mobile);
                    Intent it = new Intent(Intent.ACTION_SENDTO, uri);
                    it.putExtra("sms_body", message);
                    startActivity(it);

                }


            }
        });

        layout_menu = (RelativeLayout)findViewById(R.id.layout_menu);
        layout_menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                slidingMenu.toggle();
            }
        });

        driver_status = (Switch)slidingMenu.findViewById(R.id.switch_driver_status);
        switch_driver_status = (TextView)slidingMenu.findViewById(R.id.txt_driver_status);
        driver_status.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
            @Override
            public void onCheckedChanged(CompoundButton compoundButton, boolean b) {
                Log.d("is Checked","is Checked = "+b+"=="+userPref.getBoolean("isBookingAccept",false));
                if(b){
                    if(gps.canGetLocation()) {
                        try {
                            Common.socket=null;
                            Common.socket= SocketSingleObject.get(InviteActivity.this).getSocket();
                        } catch (Exception e) {
                            e.printStackTrace();
                            Log.d("connected ", "connected error = " + e.getMessage());
                        }

                        Common.CustomSocketOn = 1;

                        Common.SocketFunction(InviteActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
                        switch_driver_status.setText(getResources().getString(R.string.on_duty));
                    }else{

                        Common.CustomSocketOn = 0;
                        switch_driver_status.setText(getResources().getString(R.string.off_duty));
                        driver_status.setChecked(false);
                        gps.showSettingsAlert();

                        common.ChangeLocationSocket(InviteActivity.this,driver_status);
                    }
                }else{
                    switch_driver_status.setText(getResources().getString(R.string.off_duty));

                    try {
                        JSONArray locAry = new JSONArray();
                        locAry.put(latitude);
                        locAry.put(longitude);
                        JSONObject emitobj = new JSONObject();
                        emitobj.put("coords",locAry);
                        emitobj.put("driver_name",userPref.getString("user_name",""));
                        emitobj.put("driver_id", userPref.getString("id",""));
                        emitobj.put("driver_status", "0");
                        emitobj.put("car_type",userPref.getString("car_type",""));
                        emitobj.put("isdevice","1");
                        emitobj.put("booking_status",userPref.getString("booking_status",""));
                        emitobj.put("isLocationChange",0);
                        Log.d("emitobj", "emitobj = " + emitobj);

                        Common.socket.emit("Create Driver Data", emitobj );
                        Common.socket.emit("forceDisconnect",emitobj);
//                        Common.socket.disconnect();

                    } catch (JSONException e) {
                        e.printStackTrace();
                    }

                    Common.CustomSocketOn = 0;

                    common.ChangeLocationSocket(InviteActivity.this,driver_status);
                }
            }
        });

    }

    @Override
    protected void onResume() {
        super.onResume();

        if(userPref.getString("driver_status","").equals("busy")){
            driver_status.setChecked(true);
            driver_status.setClickable(false);
            switch_driver_status.setText(getResources().getString(R.string.on_duty));
            if(gps.canGetLocation()) {
                try {
                    Common.socket=null;
                    Common.socket=SocketSingleObject.get(InviteActivity.this).getSocket();
                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("connected ", "connected error = " + e.getMessage());
                }

                Common.SocketFunction(InviteActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
            }

        }else if(Common.CustomSocketOn == 1 && !userPref.getString("driver_status","").equals("busy")){
            driver_status.setChecked(true);
            driver_status.setClickable(true);
            switch_driver_status.setText(getResources().getString(R.string.on_duty));

            if(gps.canGetLocation()) {
                try {
                    Common.socket=null;
                    Common.socket=SocketSingleObject.get(InviteActivity.this).getSocket();

                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("connected ", "connected error = " + e.getMessage());
                }

                Common.SocketFunction(InviteActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
            }

        }else{
            driver_status.setChecked(false);
            driver_status.setClickable(true);
            switch_driver_status.setText(getResources().getString(R.string.on_duty));
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
                            InviteActivity.super.onBackPressed();
                        }
                    }).create().show();
        }
    }
}
