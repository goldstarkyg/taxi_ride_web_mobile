package taxiel.co.il.driver;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.net.Uri;
import android.os.Bundle;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.Switch;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.squareup.picasso.Picasso;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import com.ocriders.appd.R;
import taxiel.co.il.driver.Adapter.ReviewsAdapter;
import taxiel.co.il.driver.utils.Common;
import taxiel.co.il.driver.utils.DriverAllTripFeed;
import taxiel.co.il.driver.utils.ReviewsData;
import taxiel.co.il.driver.utils.SimpleRatingBar;
import taxiel.co.il.driver.utils.SocketSingleObject;

public class MyReviewsActivity extends AppCompatActivity implements ReviewsAdapter.OnAllTripClickListener {

    RelativeLayout layout_menu;
    Typeface OpenSans_Regular,OpenSans_Bold,regularRoboto,Roboto_Bold;
    SlidingMenu slidingMenu;

    SharedPreferences userPref;

    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;


    //MyReviews
    TextView txt_profile,tv_driver_name;
    ImageView img_add_image;

    RecyclerView rv_reviews;
    LinearLayoutManager linearLayoutManager;
    ArrayList<ReviewsData> reviewsArray;
    ReviewsAdapter reviewsAdapter;
    SwipeRefreshLayout swipe_refresh_layout;


    RelativeLayout rl_no_reviews;
    SimpleRatingBar properRatingbar;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    //
    LinearLayout vUserProfileRoot;

    Common common = new Common();
    Switch driver_status;
    TextView switch_driver_status;

    GPSTracker gps;
    double latitude;
    double longitude;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_myreviews);

        gps = new GPSTracker(MyReviewsActivity.this);
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


        rl_no_reviews=(RelativeLayout)findViewById(R.id.rl_no_reviews);
        rv_reviews=(RecyclerView)findViewById(R.id.rv_reviews);
        linearLayoutManager = new LinearLayoutManager(this);
        rv_reviews.setLayoutManager(linearLayoutManager);

        swipe_refresh_layout = (SwipeRefreshLayout)findViewById(R.id.swipe_refresh_layout);


        tv_driver_name=(TextView)findViewById(R.id.tv_driver_name);
        img_add_image=(ImageView)findViewById(R.id.img_add_image);
        properRatingbar=(SimpleRatingBar)findViewById(R.id.properRatingbar);

        //Header Title
        txt_profile=(TextView)findViewById(R.id.txt_profile);
        txt_profile.setText(getString(R.string.my_reviews));

        slidingMenu = new SlidingMenu(this);
        slidingMenu.setMode(SlidingMenu.LEFT);
        slidingMenu.setTouchModeAbove(SlidingMenu.TOUCHMODE_FULLSCREEN);
        slidingMenu.setBehindOffsetRes(R.dimen.slide_menu_width);
        slidingMenu.setFadeDegree(0.20f);
        slidingMenu.attachToActivity(this, SlidingMenu.SLIDING_CONTENT);
        slidingMenu.setMenu(R.layout.left_menu);

        Common.SlideMenuDesign(slidingMenu, MyReviewsActivity.this,"my reviews");

        ProgressDialog = new Dialog(MyReviewsActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        userPref = PreferenceManager.getDefaultSharedPreferences(MyReviewsActivity.this);

        tv_driver_name.setText(userPref.getString("name",""));
        Picasso.with(MyReviewsActivity.this)
                .load(Uri.parse(Url.imageurl+userPref.getString("image","")))
                .placeholder(R.drawable.user_photo)
                .transform(new CircleTransformation(MyReviewsActivity.this))
                .into(img_add_image);


        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/opensans-regular.ttf");
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/opensans-bold.ttf");
        regularRoboto = Typeface.createFromAsset(getAssets(), getString(R.string.font_regular_roboto));
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/roboto_bold.ttf");


        layout_menu = (RelativeLayout)findViewById(R.id.layout_menu);
        layout_menu.setVisibility(View.VISIBLE);
        layout_menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
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
                            Common.socket= SocketSingleObject.get(MyReviewsActivity.this).getSocket();
                        } catch (Exception e) {
                            e.printStackTrace();
                            Log.d("connected ", "connected error = " + e.getMessage());
                        }

                        Common.CustomSocketOn = 1;

                        Common.SocketFunction(MyReviewsActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
                        switch_driver_status.setText(getResources().getString(R.string.on_duty));
                    }else{

                        Common.CustomSocketOn = 0;
                        switch_driver_status.setText(getResources().getString(R.string.off_duty));
                        driver_status.setChecked(false);
                        gps.showSettingsAlert();

                        common.ChangeLocationSocket(MyReviewsActivity.this,driver_status);
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

                    common.ChangeLocationSocket(MyReviewsActivity.this,driver_status);
                }
            }
        });

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                if(userPref.getString("id","")!=null){
                    ProgressDialog.show();
                    cusRotateLoading.start();
                    getAllReviews(0);
                }
            }
        },1000);

        //Swipe To Refresh
        swipe_refresh_layout.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                rv_reviews.setEnabled(false);
                if (Common.isNetworkAvailable(MyReviewsActivity.this)) {
                    if(userPref.getString("id","")!=null){
                        getAllReviews(0);
                    }
                }else{
                    //Network is not available
                    rv_reviews.setEnabled(true);
                    swipe_refresh_layout.setRefreshing(false);
                    Common.showInternetInfo(MyReviewsActivity.this, "Network is not available");
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
                    Common.socket= SocketSingleObject.get(MyReviewsActivity.this).getSocket();
                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("connected ", "connected error = " + e.getMessage());
                }

                Common.SocketFunction(MyReviewsActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
            }

        }else if(Common.CustomSocketOn == 1 && !userPref.getString("driver_status","").equals("busy")){
            driver_status.setChecked(true);
            driver_status.setClickable(true);
            switch_driver_status.setText(getResources().getString(R.string.on_duty));

            if(gps.canGetLocation()) {
                try {
                    Common.socket=null;
                    Common.socket=SocketSingleObject.get(MyReviewsActivity.this).getSocket();

                } catch (Exception e) {
                    e.printStackTrace();
                    Log.d("connected ", "connected error = " + e.getMessage());
                }

                Common.SocketFunction(MyReviewsActivity.this,Common.socket,driver_status,latitude,longitude,common,userPref);
            }

        }else{
            driver_status.setChecked(false);
            driver_status.setClickable(true);
            switch_driver_status.setText(getResources().getString(R.string.on_duty));
        }
    }

    public void getAllReviews(final int offset) {
        if(offset == 0) {
            reviewsArray = new ArrayList<>();
            if(reviewsArray != null){
                reviewsArray.clear();
            }
        }
        Log.e("OkaySwiss","Reviews URL ="+Url.MyReviewsUrl+"=="+userPref.getString("id","")+"=="+String.valueOf(offset));
        Ion.with(MyReviewsActivity.this)
                .load(Url.MyReviewsUrl+"?driver_id="+userPref.getString("id","")+"&off="+String.valueOf(offset))
                .setTimeout(60*60*1000)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception error, JsonObject result) {
                        // do stuff with the result or error
                        Log.e("Okayswiss", "reviews result = " + result + "==" + error);
                        if (error == null) {

                            ProgressDialog.cancel();
                            cusRotateLoading.stop();
                            rv_reviews.setEnabled(true);
                            swipe_refresh_layout.setRefreshing(false);

                            try {
                                JSONObject resObj = new JSONObject(result.toString());
//                                swipe_refresh_layout.setRefreshing(false);
                                if (resObj.getString("status").equals("success")) {
                                    rv_reviews.setEnabled(true);
                                    JSONArray tripArray = new JSONArray(resObj.getString("driver_rate_detail"));
                                    for (int t = 0; t < tripArray.length(); t++) {
                                        JSONObject trpObj = tripArray.getJSONObject(t);
                                        ReviewsData allTripFeed = new ReviewsData();
                                        allTripFeed.setDriver_id(trpObj.getString("driver_id"));
                                        allTripFeed.setDriver_name(trpObj.getString("name"));
                                        allTripFeed.setDriver_user_comment(trpObj.getString("user_comment"));
                                        allTripFeed.setDriver_time(trpObj.getString("time"));
                                        allTripFeed.setDriver_image(trpObj.getString("image"));
                                        allTripFeed.setDriver_rate(trpObj.getString("driver_rate"));
                                        reviewsArray.add(allTripFeed);
                                    }

                                    Log.e("Okswiss", "reviews three= " + reviewsArray.size());
                                    if (reviewsArray != null && reviewsArray.size() > 0) {
                                        if (offset == 0) {
                                            rv_reviews.setVisibility(View.VISIBLE);
                                            rl_no_reviews.setVisibility(View.GONE);
                                            reviewsAdapter = new ReviewsAdapter(MyReviewsActivity.this, reviewsArray);
                                            rv_reviews.setAdapter(reviewsAdapter);
                                            reviewsAdapter.setOnAllTripItemClickListener(MyReviewsActivity.this);
                                            ProgressDialog.cancel();
                                            cusRotateLoading.stop();
                                        }
                                        reviewsAdapter.updateItems();
//                                        swipe_refresh_layout.setEnabled(true);
                                    }
                                }else if(resObj.getString("status").equals("false")){

                                    SharedPreferences.Editor editor = userPref.edit();
                                    editor.clear();
                                    editor.commit();

                                    Intent logInt = new Intent(MyReviewsActivity.this, LoginActivity.class);
                                    logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                                    logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                    logInt.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                    startActivity(logInt);

                                } else {

                                    if (offset == 0) {
                                        ProgressDialog.cancel();
                                        cusRotateLoading.stop();

                                        rv_reviews.setVisibility(View.GONE);
                                        rl_no_reviews.setVisibility(View.VISIBLE);


                                    } else {
                                        Toast.makeText(MyReviewsActivity.this, resObj.getString("message").toString(), Toast.LENGTH_LONG).show();
                                    }
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        } else {
                            ProgressDialog.cancel();
                            cusRotateLoading.stop();

                            rv_reviews.setEnabled(true);
                            swipe_refresh_layout.setRefreshing(false);
                            Common.ShowHttpErrorMessage(MyReviewsActivity.this, error.getMessage());
                        }
                    }
                });

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
                            MyReviewsActivity.super.onBackPressed();
                        }
                    }).create().show();
        }

    }

    @Override
    public void scrollToLoad(int position) {
        Log.e("OkaySwissDriver","scrolltoload :"+position);
        if(Common.isNetworkAvailable(MyReviewsActivity.this)) {
            if(userPref.getString("id","")!=null){
                ProgressDialog.show();
                cusRotateLoading.start();
                getAllReviews(position + 1);
            }
        }else{
            ProgressDialog.cancel();
            cusRotateLoading.stop();
            Common.showInternetInfo(MyReviewsActivity.this, "Network is not available");
        }
    }
}
