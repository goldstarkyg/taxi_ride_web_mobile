package come.texi.user;

import android.app.Dialog;
import android.content.Intent;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.TranslateAnimation;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import com.victor.loading.rotate.RotateLoading;
import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import come.texi.user.utils.Common;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

import static come.texi.user.utils.Common.*;


public class LoginActivity extends AppCompatActivity {

    EditText edit_username;
    EditText edit_password;
    RelativeLayout layout_signin;
    RelativeLayout layout_forgot;
    TextView txt_forgot_pass;
    TextView txt_signin,txt_sign_in_logo;
    LinearLayout layout_login_main;

    Typeface OpenSans_Regular,OpenSans_Bold,regularRoboto,Roboto_Bold;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;
    Common common = new Common();

    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        layout_login_main = (LinearLayout)findViewById(R.id.layout_login_main);
        edit_username = (EditText)findViewById(R.id.edit_username);
        edit_password = (EditText)findViewById(R.id.edit_password);
        layout_signin = (RelativeLayout) findViewById(R.id.layout_signin);
        layout_forgot = (RelativeLayout)findViewById(R.id.layout_forgot);
        txt_forgot_pass = (TextView)findViewById(R.id.txt_forgot_pass);
        txt_signin = (TextView)findViewById(R.id.txt_signin);
        txt_sign_in_logo = (TextView)findViewById(R.id.txt_sign_in_logo);

        ProgressDialog = new Dialog(LoginActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Regular_0.ttf");
        regularRoboto = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Bold.ttf");

        edit_username.setTypeface(OpenSans_Regular);
        edit_password.setTypeface(OpenSans_Regular);
        txt_forgot_pass.setTypeface(OpenSans_Regular);
        txt_signin.setTypeface(Roboto_Bold);
        txt_sign_in_logo.setTypeface(Roboto_Bold);

        layout_signin.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if (edit_username.getText().toString().trim().length() == 0) {
                    //showLoginRegisterMkError(LoginActivity.this, getResources().getString(R.string.please_enter_username));
                    showMKPanelError(LoginActivity.this, getResources().getString(R.string.please_enter_email),rlMainView,tvTitle,regularRoboto);
                    return;
                } else if (edit_password.getText().toString().trim().length() == 0) {
                    showMKPanelError(LoginActivity.this, getResources().getString(R.string.please_enter_password),rlMainView,tvTitle,regularRoboto);
                    return;
                } else if (edit_password.getText().toString().trim().length() < 8 || edit_password.getText().toString().trim().length() > 32) {
                    showMKPanelError(LoginActivity.this, getResources().getString(R.string.password_length),rlMainView,tvTitle,regularRoboto);
                    return;
                }

                if (isNetworkAvailable(LoginActivity.this)) {

                    String loginUrl = null;
                    try {
                        loginUrl = Url.loginUrl+"?email="+ URLEncoder.encode(edit_username.getText().toString().trim(), "UTF-8")+"&password="+edit_password.getText().toString().trim();
                    } catch (UnsupportedEncodingException e) {
                        e.printStackTrace();
                    }

                    Log.d("loginUrl", "loginUrl " + loginUrl);
                    new Common.LoginCallHttp(LoginActivity.this, ProgressDialog, cusRotateLoading, edit_password.getText().toString().trim(), "", loginUrl).execute();
                } else {
                    showInternetInfo(LoginActivity.this, "");
                }



            }
        });

        layout_forgot.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent fi = new Intent(LoginActivity.this,ForgotActivity.class);
                startActivity(fi);
            }
        });

        layout_login_main.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(rlMainView.getVisibility() == View.VISIBLE){
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
        });

        Common.ValidationGone(LoginActivity.this,rlMainView,edit_username);
        Common.ValidationGone(LoginActivity.this,rlMainView,edit_password);

    }
}