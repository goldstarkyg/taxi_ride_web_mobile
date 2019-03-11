package taxiel.co.il.driver;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

//import com.google.firebase.iid.FirebaseInstanceId;
import com.google.firebase.iid.FirebaseInstanceId;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import com.ocriders.appd.R;
import taxiel.co.il.driver.utils.Common;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class SplashActivity extends AppCompatActivity {

    SharedPreferences userPref;
    TextView txt_progress;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        String token = FirebaseInstanceId.getInstance().getToken();
        Common.device_token = token;

        Log.d("device_token","device_token = "+Common.device_token);

        txt_progress = (TextView)findViewById(R.id.txt_progress);

//        Intent intent = new Intent(this, RegistrationIntentService.class);
//        startService(intent);

        userPref = PreferenceManager.getDefaultSharedPreferences(SplashActivity.this);
        Log.d("is login","is login = "+userPref.getBoolean("is_login",false));

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {

                if(Utility.isNetworkAvailable(SplashActivity.this)){
                    getCarType();
                }else {
                    //Network
                    Utility.showInternetInfo(SplashActivity.this, "Network is not available");
                }
            }
        }, 1000);


        txt_progress.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getCarType();
            }
        });

    }

    public void getCarType(){

        String CarTypeUrl = Url.driver_cartype+"?driver_id="+userPref.getString("id","")+"&username="+userPref.getString("user_name","")+"&password="+userPref.getString("password","");

        Log.d("driver_cartype","driver_cartype = "+CarTypeUrl);
        Utility.arrayCarTypeList=new ArrayList<HashMap<String, String>>();
        Ion.with(SplashActivity.this)
                .load(CarTypeUrl)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception e, JsonObject result){
                        // do stuff with the result or error

                        if(e != null) {
                            txt_progress.setText(getResources().getString(R.string.retry));
                            Toast.makeText(SplashActivity.this, e.getMessage(), Toast.LENGTH_LONG).show();
                            return;
                        }

                        try {
                            JSONObject jsonObject=new JSONObject(result.toString());
                            Log.d("jsonObject","jsonObject = "+jsonObject);
                            if(jsonObject.has("status") && jsonObject.getString("status").equalsIgnoreCase("success")){
                                JSONArray jsonArray=jsonObject.getJSONArray("Car_Type");
                                for(int i=0;i<jsonArray.length();i++){
                                    JSONObject jsonObjectCarType = jsonArray.getJSONObject(i);
                                    HashMap<String,String> hm = new HashMap<String, String>();
                                    if(jsonObjectCarType.has("cab_id") && !jsonObjectCarType.getString("cab_id").equalsIgnoreCase(""))
                                        hm.put("car_id",jsonObjectCarType.getString("cab_id"));
                                    else
                                        hm.put("car_id","");
                                    Log.d("jsonObject","jsonObject = "+hm.get("car_id"));


                                    if(jsonObjectCarType.has("cartype") && !jsonObjectCarType.getString("cartype").equalsIgnoreCase(""))
                                        hm.put("car_type",jsonObjectCarType.getString("cartype"));
                                    else
                                        hm.put("car_type","");

                                    if(jsonObjectCarType.has("icon") && !jsonObjectCarType.getString("icon").equalsIgnoreCase(""))
                                        hm.put("icon",jsonObjectCarType.getString("icon"));
                                    else
                                        hm.put("icon","");

                                    if(jsonObjectCarType.has("car_rate") && !jsonObjectCarType.getString("car_rate").equalsIgnoreCase(""))
                                        hm.put("car_rate",jsonObjectCarType.getString("car_rate"));
                                    else
                                        hm.put("car_rate","");

                                    hm.put("is_selected","0");

                                    if(jsonObjectCarType.has("seating_capecity") && !jsonObjectCarType.getString("seating_capecity").equalsIgnoreCase(""))
                                        hm.put("seating_capecity",jsonObjectCarType.getString("seating_capecity"));
                                    else
                                        hm.put("seating_capecity","");

                                    if(jsonObjectCarType.has("bank_name") && !jsonObjectCarType.getString("bank_name").equalsIgnoreCase(""))
                                        hm.put("bank_name",jsonObjectCarType.getString("bank_name"));
                                    else
                                        hm.put("bank_name","");

                                    if(jsonObjectCarType.has("bank_number") && !jsonObjectCarType.getString("bank_number").equalsIgnoreCase(""))
                                        hm.put("bank_number",jsonObjectCarType.getString("seating_capecity"));
                                    else
                                        hm.put("bank_number","");

                                    if(jsonObjectCarType.has("bank_routing") && !jsonObjectCarType.getString("bank_routing").equalsIgnoreCase(""))
                                        hm.put("bank_routing",jsonObjectCarType.getString("bank_routing"));
                                    else
                                        hm.put("bank_routing","");

                                    Utility.arrayCarTypeList.add(hm);
                                }

                                SharedPreferences.Editor DriverStatus = userPref.edit();
                                DriverStatus.putString("driver_status",jsonObject.getString("driver_status"));
                                DriverStatus.commit();

                                txt_progress.setText(getResources().getString(R.string.sucess));
                                if(userPref.getBoolean("is_login",false)){
                                    new Handler().postDelayed(new Runnable() {
                                        @Override
                                        public void run() {
                                            Intent intent = new Intent(SplashActivity.this, DriverTripActivity.class);
                                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
                                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                            startActivity(intent);
                                            finish();
                                        }
                                    }, 1000);
                                }else{
                                    new Handler().postDelayed(new Runnable() {
                                        @Override
                                        public void run() {
                                            Intent intent = new Intent(SplashActivity.this, MainActivity.class);
                                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
                                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                            startActivity(intent);
                                            finish();
                                        }
                                    }, 1000);
                                }
                            }else{
                                txt_progress.setText(jsonObject.getString("message"));
//                                new Handler().postDelayed(new Runnable() {
//                                    @Override
//                                    public void run() {
//                                        Intent intent = new Intent(SplashActivity.this, DriverTripActivity.class);
//                                        intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
//                                        intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
//                                        startActivity(intent);
//                                        finish();
//                                    }
//                                }, 1000);
                            }

                        }catch (Exception e1){
                            e1.printStackTrace();
                        }
                    }
                });
    }

    @Override
    public void onResume() {
        super.onResume();  // Always call the superclass method first

        if(Common.device_token != null && Common.device_token.equals(""))
            Common.device_token = Common.device_refresh_token;
    }


}
