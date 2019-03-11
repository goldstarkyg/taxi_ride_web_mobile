package come.texi.user;

import android.app.Dialog;
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
import android.view.WindowManager;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.squareup.picasso.Picasso;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.File;
import java.util.ArrayList;

import come.texi.user.adapter.ReviewsAdapter;

import come.texi.user.utils.AllTripFeed;
import come.texi.user.utils.CircleTransform;
import come.texi.user.utils.Common;
import come.texi.user.utils.ReviewsData;
import come.texi.user.utils.SimpleRatingBar;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

public class ReviewProfileActivity extends AppCompatActivity implements ReviewsAdapter.OnAllTripClickListener{

    EditText edt_name,edt_address,edt_dob,edt_phone,edt_car_type,edt_license_expiry_date,edt_gender;
    RelativeLayout layout_back_arrow;
    ImageView img_add_image;
    RelativeLayout layout_save;
    TextView txt_save;


    TextView tv_driver_name;

    Typeface OpenSans_Regular,OpenSans_Bold,Roboto_Regular,Roboto_Medium,Roboto_Bold;
    SharedPreferences userPref;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;


    RecyclerView rv_reviews;
    LinearLayoutManager  linearLayoutManager;
    ArrayList<ReviewsData> reviewsArray;
    ReviewsAdapter reviewsAdapter;
    AllTripFeed allTripFeed;
    RelativeLayout rl_no_reviews;
    SwipeRefreshLayout swipe_refresh_layout;

    String driverId;
    SimpleRatingBar properRatingbar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_myreviews);

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        RelativeLayout.LayoutParams params = new RelativeLayout.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
        params.setMargins(0, (int) getResources().getDimension(R.dimen.height_50), 0, 0);
        rlMainView.setLayoutParams(params);

        allTripFeed=Common.allTripFeeds;


        rl_no_reviews=(RelativeLayout)findViewById(R.id.rl_no_reviews);
        rv_reviews=(RecyclerView)findViewById(R.id.rv_reviews);
        linearLayoutManager = new LinearLayoutManager(this);
        rv_reviews.setLayoutManager(linearLayoutManager);

        swipe_refresh_layout = (SwipeRefreshLayout)findViewById(R.id.swipe_refresh_layout);

        tv_driver_name=(TextView)findViewById(R.id.tv_driver_name);
        properRatingbar=(SimpleRatingBar)findViewById(R.id.properRatingbar);

        edt_name = (EditText)findViewById(R.id.edt_name);
        edt_address = (EditText)findViewById(R.id.edt_address);
        edt_dob=(EditText)findViewById(R.id.edt_dob);
        edt_phone = (EditText)findViewById(R.id.edt_phone);
        edt_car_type=(EditText)findViewById(R.id.edt_car_type);
        edt_license_expiry_date=(EditText)findViewById(R.id.edt_license_expiry_date);
        edt_gender=(EditText)findViewById(R.id.edt_gender);


        layout_back_arrow = (RelativeLayout)findViewById(R.id.layout_back_arrow);
        layout_back_arrow.setVisibility(View.VISIBLE);

        img_add_image = (ImageView)findViewById(R.id.img_add_image);

        layout_save = (RelativeLayout)findViewById(R.id.layout_save);
        txt_save = (TextView)findViewById(R.id.txt_save);

        ProgressDialog = new Dialog(ReviewProfileActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        userPref = PreferenceManager.getDefaultSharedPreferences(ReviewProfileActivity.this);

        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Regular_0.ttf");
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        Roboto_Regular = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");
        Roboto_Medium = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Medium.ttf");
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Bold.ttf");

        try {

            JSONObject drvObj = new JSONObject(allTripFeed.getDriverDetail());
            Log.e("Okayswiss","Driver details :"+drvObj);
            driverId=drvObj.getString("id");
            Picasso.with(ReviewProfileActivity.this)
                    .load(Uri.parse(Url.DriverImageUrl+drvObj.getString("image")))
                    .placeholder(R.drawable.avatar_placeholder)
                    .transform(new CircleTransform())
                    .into(img_add_image);

            if(drvObj.has("name") && drvObj.getString("name")!=null)
            tv_driver_name.setText(drvObj.getString("name"));

            if(drvObj.has("rating_avrage") && drvObj.getString("rating_avrage")!=null){
                properRatingbar.setRating(Float.parseFloat(drvObj.getString("rating_avrage")));
            }


        } catch (JSONException e) {
            e.printStackTrace();
        }

        this.getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_HIDDEN);
        layout_back_arrow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                if(driverId!=null){
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
                if (Common.isNetworkAvailable(ReviewProfileActivity.this)) {
                    if(userPref.getString("id","")!=null){
                        getAllReviews(0);
                    }
                }else{
                    //Network is not available
                    rv_reviews.setEnabled(true);
                    swipe_refresh_layout.setRefreshing(false);
                    Common.showInternetInfo(ReviewProfileActivity.this, "Network is not available");
                }
            }
        });


    }
    public void getAllReviews(final int offset) {
        if(offset == 0) {

            reviewsArray = new ArrayList<>();
            if(reviewsArray != null){
                reviewsArray.clear();
            }

        }
        Log.e("OkaySwiss","Reviews URL ="+Url.ReviewsUrl+"=="+driverId+"=="+String.valueOf(offset));
        Ion.with(ReviewProfileActivity.this)
                .load(Url.ReviewsUrl+"?driver_id="+driverId+"&off="+String.valueOf(offset))
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
                                            reviewsAdapter = new ReviewsAdapter(ReviewProfileActivity.this, reviewsArray);
                                            rv_reviews.setAdapter(reviewsAdapter);
                                            reviewsAdapter.setOnAllTripItemClickListener(ReviewProfileActivity.this);
                                            ProgressDialog.cancel();
                                            cusRotateLoading.stop();
                                        }
                                        reviewsAdapter.updateItems();
//                                        swipe_refresh_layout.setEnabled(true);
                                    }
                                }else if(resObj.getString("status").equals("false")){
                                    Common.user_InActive = 1;
                                    Common.InActive_msg = resObj.getString("message");

                                    SharedPreferences.Editor editor = userPref.edit();
                                    editor.clear();
                                    editor.commit();

                                    Intent logInt = new Intent(ReviewProfileActivity.this, LoginOptionActivity.class);
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
                                        Toast.makeText(ReviewProfileActivity.this, resObj.getString("message").toString(), Toast.LENGTH_LONG).show();
                                    }
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        } else {
                            ProgressDialog.cancel();
                            cusRotateLoading.stop();

                            Common.ShowHttpErrorMessage(ReviewProfileActivity.this, error.getMessage());
                        }
                    }
                });

    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        edt_phone = null;
        layout_save = null;
        txt_save = null;
        layout_back_arrow = null;
    }

    @Override
    public void scrollToLoad(int position) {

        if(Common.isNetworkAvailable(ReviewProfileActivity.this)) {
            if(driverId != null){
                ProgressDialog.show();
                cusRotateLoading.start();
                getAllReviews(position + 1);
            }
        }else{
             ProgressDialog.cancel();
            cusRotateLoading.stop();
            Common.showInternetInfo(ReviewProfileActivity.this, "Network is not available");
        }

    }
}
