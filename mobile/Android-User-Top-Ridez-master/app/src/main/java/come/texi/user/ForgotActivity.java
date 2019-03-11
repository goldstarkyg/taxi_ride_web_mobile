package come.texi.user;

import android.app.Dialog;
import android.graphics.Typeface;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONException;
import org.json.JSONObject;
import come.texi.user.utils.Common;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

public class ForgotActivity extends AppCompatActivity {

    TextView txt_forgot_password,txt_for_pass_logo,txt_retrive_password;
    RelativeLayout layout_back_arrow,layout_retrive_password;
    EditText edit_username;

    Typeface OpenSans_Bold,Roboto_Bold;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_forgot);

        txt_forgot_password = (TextView)findViewById(R.id.txt_forgot_password);
        layout_back_arrow = (RelativeLayout)findViewById(R.id.layout_back_arrow);
        layout_retrive_password = (RelativeLayout) findViewById(R.id.layout_retrive_password);
        edit_username = (EditText)findViewById(R.id.edit_username);
        txt_for_pass_logo = (TextView)findViewById(R.id.txt_for_pass_logo);
        txt_retrive_password = (TextView)findViewById(R.id.txt_retrive_password);

        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Bold.ttf");

        txt_forgot_password.setTypeface(OpenSans_Bold);
        txt_for_pass_logo.setTypeface(Roboto_Bold);
        txt_retrive_password.setTypeface(Roboto_Bold);

        ProgressDialog = new Dialog(ForgotActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        layout_retrive_password.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if(edit_username.getText().toString().trim().length() == 0){
                    Common.showMkError(ForgotActivity.this, getResources().getString(R.string.please_enter_email));
                    return;
                }else if(edit_username.getText().toString().trim().length() != 0 && !isValidEmail(edit_username.getText().toString().trim())){
                    Common.showMkError(ForgotActivity.this, getResources().getString(R.string.please_enter_valid_email));
                    return;
                }

                if (Common.isNetworkAvailable(ForgotActivity.this)) {

                    ProgressDialog.show();
                    cusRotateLoading.start();

                    Ion.with(ForgotActivity.this)
                        .load(Url.forgotPasswordUrl + "?email=" + edit_username.getText().toString())
                        .setTimeout(60*60*1000)
                        .asJsonObject()
                        .setCallback(new FutureCallback<JsonObject>() {
                            @Override
                            public void onCompleted(Exception error, JsonObject result) {
                                // do stuff with the result or error
                                Log.d("Login result", "Login result = " + result + "==" + error);
                                ProgressDialog.cancel();
                                cusRotateLoading.stop();
                                if (error == null) {

                                    try {
                                        JSONObject resObj = new JSONObject(result.toString());

                                        if (resObj.getString("status").equals("success")) {
                                            Common.showMkSucess(ForgotActivity.this, resObj.getString("message").toString(), "yes");
                                        } else if (resObj.getString("status").equals("failed")) {
                                            Common.showMkError(ForgotActivity.this, resObj.getString("error code").toString());
                                        }

                                        new Handler().postDelayed(new Runnable() {
                                            @Override
                                            public void run() {
                                                finish();
                                            }
                                        }, 2000);

                                    } catch (JSONException e) {
                                        e.printStackTrace();
                                    }

                                } else {
                                    ProgressDialog.cancel();
                                    cusRotateLoading.stop();

                                    Common.ShowHttpErrorMessage(ForgotActivity.this, error.getMessage());
                                }
                            }
                        });

                }else{
                    ProgressDialog.cancel();
                    cusRotateLoading.stop();
                    Common.showInternetInfo(ForgotActivity.this, "Network is not available");
                }

            }
        });

        layout_back_arrow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

    }

    public final static boolean isValidEmail(CharSequence target) {
        return !TextUtils.isEmpty(target) && android.util.Patterns.EMAIL_ADDRESS.matcher(target).matches();
    }

    @Override
    public void onDestroy() {
        super.onDestroy();

        txt_forgot_password = null;
        layout_back_arrow = null;
        edit_username = null;
        layout_retrive_password = null;

    }
}
