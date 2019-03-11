package come.texi.user;

import android.app.AlertDialog;
import android.app.Dialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
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
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.jeremyfeinstein.slidingmenu.lib.SlidingMenu;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

import come.texi.user.adapter.ReviewsAdapter;
import come.texi.user.utils.AllTripFeed;
import come.texi.user.utils.Common;
import come.texi.user.utils.ReviewsData;
import come.texi.user.utils.SimpleRatingBar;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

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

    RecyclerView rv_reviews;
    LinearLayoutManager linearLayoutManager;
    ArrayList<ReviewsData> reviewsArray;
    ReviewsAdapter reviewsAdapter;
    SwipeRefreshLayout swipe_refresh_layout;
    RelativeLayout rl_no_reviews;
    SimpleRatingBar properRatingbar;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_myreviews);

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

        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Regular_0.ttf");
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        regularRoboto = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Bold.ttf");

        layout_menu = (RelativeLayout)findViewById(R.id.layout_menu);
        layout_menu.setVisibility(View.VISIBLE);
        layout_menu.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                slidingMenu.toggle();
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
    }

    public void getAllReviews(final int offset) {
        if(offset == 0) {
            reviewsArray = new ArrayList<>();
            if(reviewsArray != null){
                reviewsArray.clear();
            }
        }
        Log.e("OkaySwiss","Reviews URL ="+ Url.MyReviewsUrl+"=="+userPref.getString("id","")+"=="+String.valueOf(offset));
        Ion.with(MyReviewsActivity.this)
                .load(Url.MyReviewsUrl+"?user_id="+userPref.getString("id","")+"&off="+String.valueOf(offset))
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
                                    JSONArray tripArray = new JSONArray(resObj.getString("user_rate_detail"));
                                    for (int t = 0; t < tripArray.length(); t++) {
                                        JSONObject trpObj = tripArray.getJSONObject(t);
                                        ReviewsData allTripFeed = new ReviewsData();
                                        allTripFeed.setDriver_id(trpObj.getString("user_id"));
                                        allTripFeed.setDriver_name(trpObj.getString("name"));
                                        allTripFeed.setDriver_user_comment(trpObj.getString("driver_comment"));
                                        allTripFeed.setDriver_time(trpObj.getString("time"));
                                        allTripFeed.setDriver_image(trpObj.getString("image"));
                                        allTripFeed.setDriver_rate(trpObj.getString("user_rate"));
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

                                    if(offset == 0) {
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
