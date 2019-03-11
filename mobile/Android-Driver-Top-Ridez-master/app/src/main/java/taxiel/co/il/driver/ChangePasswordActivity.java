package taxiel.co.il.driver;

import android.app.AlertDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Animation;
import android.view.animation.TranslateAnimation;
import android.widget.CompoundButton;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.Switch;
import android.widget.TextView;

import com.github.nkzawa.emitter.Emitter;
import com.github.nkzawa.socketio.client.IO;
import com.github.nkzawa.socketio.client.Socket;
import com.google.gson.JsonObject;
import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import com.ocriders.appd.R;
import taxiel.co.il.driver.utils.Common;
import taxiel.co.il.driver.utils.SocketSingleObject;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.URISyntaxException;
import java.util.Locale;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class ChangePasswordActivity extends AppCompatActivity {

    TextView txt_change_password,txt_change_password_button;
    EditText edit_current_pass;
    EditText edit_new_pass;
    EditText edit_con_pass;
    RelativeLayout layout_change_password;
    RelativeLayout layout_menu;
    TextView txt_forgot_password;

    Typeface OpenSans_Regular,OpenSans_Bold,regularRoboto,Roboto_Bold;
    SlidingMenu slidingMenu;

    SharedPreferences userPref;

    Common common = new Common();
    Switch driver_status;
    TextView switch_driver_status;

    GPSTracker gps;
    double latitude;
    double longitude;
    LoaderView loader;

    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;

    Pattern letter;

    Pattern digit = Pattern.compile("[0-9]");
    Pattern special = Pattern.compile ("[!@#$%&*()_+=|<>?{}\\[\\]~-]");

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_change_password);

        if(Locale.getDefault().getLanguage().equals("en")){
            letter = Pattern.compile("[a-zA-z]");
            Log.d("Locale","Locale Language one= "+Locale.getDefault().getLanguage());
        }else{
            letter = Pattern.compile("[^x00-x7F]");
        }

        loader=new LoaderView(ChangePasswordActivity.this);

        gps = new GPSTracker(ChangePasswordActivity.this);
        if(gps.canGetLocation()){
            latitude = gps.getLatitude();
            longitude = gps.getLongitude();
        }else{
            gps.showSettingsAlert();
        }

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        RelativeLayout.LayoutParams rlMainParam = new RelativeLayout.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT,ViewGroup.LayoutParams.WRAP_CONTENT);
        rlMainParam.setMargins(0, (int) getResources().getDimension(R.dimen.height_50),0,0);
        rlMainView.setLayoutParams(rlMainParam);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        slidingMenu = new SlidingMenu(this);
        slidingMenu.setMode(SlidingMenu.LEFT);
        slidingMenu.setTouchModeAbove(SlidingMenu.TOUCHMODE_FULLSCREEN);
        slidingMenu.setBehindOffsetRes(R.dimen.slide_menu_width);
        slidingMenu.setFadeDegree(0.20f);
        slidingMenu.attachToActivity(this, SlidingMenu.SLIDING_CONTENT);
        slidingMenu.setMenu(R.layout.left_menu);

        common.SlideMenuDesign(slidingMenu, ChangePasswordActivity.this,"change password");

        txt_change_password = (TextView)findViewById(R.id.txt_change_password);
        txt_change_password.setTypeface(OpenSans_Bold);
        txt_change_password_button = (TextView)findViewById(R.id.txt_change_password_button);
        edit_current_pass = (EditText)findViewById(R.id.edit_current_pass);
        edit_new_pass = (EditText)findViewById(R.id.edit_new_pass);
        edit_con_pass = (EditText)findViewById(R.id.edit_con_pass);
        layout_change_password = (RelativeLayout) findViewById(R.id.layout_change_password);
        layout_menu = (RelativeLayout)findViewById(R.id.layout_menu);
        txt_forgot_password = (TextView)findViewById(R.id.txt_forgot_password);

        userPref = PreferenceManager.getDefaultSharedPreferences(ChangePasswordActivity.this);

        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/opensans-regular.ttf");
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/opensans-bold.ttf");
        regularRoboto = Typeface.createFromAsset(getAssets(), getString(R.string.font_regular_roboto));
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/roboto_bold.ttf");

        txt_change_password.setTypeface(OpenSans_Bold);
        edit_new_pass.setTypeface(OpenSans_Regular);
        edit_con_pass.setTypeface(OpenSans_Regular);
        edit_current_pass.setTypeface(OpenSans_Regular);
        txt_forgot_password.setTypeface(Roboto_Bold);
        txt_change_password_button.setTypeface(Roboto_Bold);

        layout_change_password.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(edit_current_pass.getText().toString().trim().length() == 0){
                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.please_enter_current_password),rlMainView,tvTitle,regularRoboto);
                    edit_current_pass.requestFocus();
                    return;
                }else if(!edit_current_pass.getText().toString().trim().equals(userPref.getString("password",""))){
                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.please_current_password),rlMainView,tvTitle,regularRoboto);
                    edit_current_pass.requestFocus();
                    return;
                }else if(edit_new_pass.getText().toString().trim().length() == 0){
                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.please_enter_new_password),rlMainView,tvTitle,regularRoboto);
                    edit_new_pass.requestFocus();
                    return;
                }else if (edit_new_pass.getText().toString().trim().length() < 6 || edit_new_pass.getText().toString().trim().length() > 32) {
                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.password_new_length),rlMainView,tvTitle,regularRoboto);
                    edit_new_pass.requestFocus();
                    return;
                }
//                else if(!PasswordValidaton(edit_new_pass.getText().toString())){
//                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.hint_password_msg),rlMainView,tvTitle,regularRoboto);
//                    edit_new_pass.requestFocus();
//                    return;
//                }
                else if(edit_con_pass.getText().toString().trim().length() == 0){
                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.please_enter_confirm_password),rlMainView,tvTitle,regularRoboto);
                    edit_con_pass.requestFocus();
                    return;
                }else if(!edit_new_pass.getText().toString().equals(edit_con_pass.getText().toString())){
                    Utility.showMKPanelError(ChangePasswordActivity.this, getResources().getString(R.string.password_new_confirm),rlMainView,tvTitle,regularRoboto);
                    edit_con_pass.requestFocus();
                    return;
                }

                if (Common.isNetworkAvailable(ChangePasswordActivity.this)) {
                    loader.show();
                    String DrvChangPasswordUrl = Url.DriverChangPasswordUrl+"?password="+edit_new_pass.getText().toString()+"&did="+userPref.getString("id","");
                    Log.d("DrvBookingUrl","DrvBookingUrl ="+DrvChangPasswordUrl);
                    Ion.with(ChangePasswordActivity.this)
                            .load(DrvChangPasswordUrl)
                            .asJsonObject()
                            .setCallback(new FutureCallback<JsonObject>() {
                                @Override
                                public void onCompleted(Exception error, JsonObject result) {
                                    // do stuff with the result or error
                                    Log.d("load_trips result", "load_trips result = " + result + "==" + error);
                                    loader.cancel();
                                    if (error == null) {
                                        try {
                                            SharedPreferences.Editor password = userPref.edit();
                                            password.putString("password",edit_new_pass.getText().toString().trim());
                                            password.commit();

                                            JSONObject resObj = new JSONObject(result.toString());
                                            if(resObj.getString("status").equals("success")) {

                                                Common.showMkSucess(ChangePasswordActivity.this, resObj.getString("message"), "yes");

                                                edit_new_pass.setText("");
                                                edit_current_pass.setText("");
                                                edit_con_pass.setText("");
                                            }else if(resObj.getString("status").equals("false")){

                                                Common.showMkError(ChangePasswordActivity.this,resObj.getString("error code").toString());

                                                if(resObj.has("Isactive") && resObj.getString("Isactive").equals("Inactive")) {

                                                    SharedPreferences.Editor editor = userPref.edit();
                                                    editor.clear();
                                                    editor.commit();

                                                    new Handler().postDelayed(new Runnable() {
                                                        @Override
                                                        public void run() {
                                                            Intent intent = new Intent(ChangePasswordActivity.this, MainActivity.class);
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
                                        Common.ShowHttpErrorMessage(ChangePasswordActivity.this, error.getMessage());
                                    }
                                }
                            });
                }
            }
        });

        layout_menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                slidingMenu.toggle();
            }
        });

        /*Change driver Status*/

        //Log.d("Socket is Conntecte","Socket is Conntecte = "+Common.socket.connected());

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
                            Common.socket=SocketSingleObject.get(ChangePasswordActivity.this).getSocket();
                        } catch (Exception e) {
                            e.printStackTrace();
                            Log.d("connected ", "connected error = " + e.getMessage());
                        }

                        Common.CustomSocketOn = 1;

                        Common.SocketFunction(ChangePasswordActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
                        switch_driver_status.setText(getResources().getString(R.string.on_duty));
                    }else{

                        Common.CustomSocketOn = 0;
                        switch_driver_status.setText(getResources().getString(R.string.off_duty));
                        driver_status.setChecked(false);
                        gps.showSettingsAlert();

                        common.ChangeLocationSocket(ChangePasswordActivity.this,driver_status);
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

                    common.ChangeLocationSocket(ChangePasswordActivity.this,driver_status);
                }
            }
        });

        PasswordValidationGone(edit_current_pass);
        PasswordValidationGone(edit_new_pass);
        PasswordValidationGone(edit_con_pass);
    }

    public void PasswordValidationGone(EditText edt_reg_username){
        edt_reg_username.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {
                Log.d("charSequence","charSequence = "+charSequence.length()+"=="+rlMainView.getVisibility()+"=="+View.VISIBLE);
                if(charSequence.length() > 0 && rlMainView.getVisibility() == View.VISIBLE){
                    if(!isFinishing()){
                        TranslateAnimation slideUp = new TranslateAnimation(Animation.RELATIVE_TO_SELF, 0, Animation.RELATIVE_TO_SELF, 0, Animation.RELATIVE_TO_SELF, 0, Animation.RELATIVE_TO_SELF, -100);
                        slideUp.setDuration(10);
                        slideUp.setFillAfter(true);
                        rlMainView.startAnimation(slideUp);
                        slideUp.setAnimationListener(new Animation.AnimationListener() {

                            @Override
                            public void onAnimationStart(Animation animation) {
                            }

                            @Override
                            public void onAnimationRepeat(Animation animation) {
                            }

                            @Override
                            public void onAnimationEnd(Animation animation) {
                                rlMainView.setVisibility(View.GONE);
                            }
                        });

                    }
                }
            }

            @Override
            public void afterTextChanged(Editable editable) {

            }
        });
    }

    public final boolean PasswordValidaton(String password) {
        Matcher hasLetter = letter.matcher(password);
        Matcher hasDigit = digit.matcher(password);
        //Matcher hasSpecial = special.matcher(password);

        return hasLetter.find() && hasDigit.find();
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
                    Common.socket=SocketSingleObject.get(ChangePasswordActivity.this).getSocket();
                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("connected ", "connected error = " + e.getMessage());
                }

                Common.SocketFunction(ChangePasswordActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
            }

        }else if(Common.CustomSocketOn == 1 && !userPref.getString("driver_status","").equals("busy")){
            driver_status.setChecked(true);
            driver_status.setClickable(true);
            switch_driver_status.setText(getResources().getString(R.string.on_duty));

            if(gps.canGetLocation()) {
                try {
                    Common.socket=null;
                    Common.socket=SocketSingleObject.get(ChangePasswordActivity.this).getSocket();

                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("connected ", "connected error = " + e.getMessage());
                }

                Common.SocketFunction(ChangePasswordActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
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
        }else{
            new AlertDialog.Builder(this)
                    .setTitle(getResources().getString(R.string.really_exit))
                    .setMessage(getResources().getString(R.string.are_you_sure))
                    .setNegativeButton(android.R.string.no, null)
                    .setPositiveButton(android.R.string.yes, new DialogInterface.OnClickListener() {

                        public void onClick(DialogInterface arg0, int arg1) {
                            ChangePasswordActivity.super.onBackPressed();
                        }
                    }).create().show();
        }
    }
}
