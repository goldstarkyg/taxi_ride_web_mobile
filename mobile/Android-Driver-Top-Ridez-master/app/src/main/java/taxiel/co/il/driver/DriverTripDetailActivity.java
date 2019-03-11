package taxiel.co.il.driver;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.net.Uri;
import android.os.Build;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.annotation.NonNull;
import android.support.annotation.RequiresApi;
import android.support.design.widget.FloatingActionButton;
import android.support.v4.content.ContextCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.afollestad.materialdialogs.DialogAction;
import com.afollestad.materialdialogs.GravityEnum;
import com.afollestad.materialdialogs.MaterialDialog;
import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.squareup.picasso.Picasso;

import com.ocriders.appd.R;
import taxiel.co.il.driver.utils.Common;
import taxiel.co.il.driver.utils.DriverAllTripFeed;
import taxiel.co.il.driver.utils.SimpleRatingBar;
import taxiel.co.il.driver.utils.SocketSingleObject;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.net.URLEncoder;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class DriverTripDetailActivity extends AppCompatActivity {

    RelativeLayout layout_back_arrow;

    ImageView img_user_image;

    TextView txt_booking_detail,txt_payment_detial,txt_vehicle_detail,txt_to;
    TextView txt_booking_id;
    TextView txt_booking_id_val;
    TextView txt_pickup_point;
    TextView txt_pickup_point_val;
    TextView txt_booking_date;
    TextView txt_drop_point;
    TextView txt_drop_point_val;
    TextView txt_user_name;
    TextView txt_user_email;
    TextView txt_mobile_num;
    TextView txt_distance;
    TextView txt_distance_val;
    TextView txt_distance_km;
    TextView txt_total_price;
    TextView txt_total_price_dol;
    TextView txt_total_price_val;
    TextView txt_payment_type;
    TextView txt_payment_type_val;
    TextView txt_approx_time;
    TextView txt_approx_time_val;

    LinearLayout layout_accepted;
    RelativeLayout layout_arrived;
    RelativeLayout layout_begin_trip;
    RelativeLayout layout_user_call;
    RelativeLayout layout_finished;

    RelativeLayout layout_payment_type;

    String UserMobileNu;

    Typeface OpenSans_Regular,Roboto_Regular,Roboto_Medium,Roboto_Bold,OpenSans_Semibold;

    SharedPreferences userPref;

    LoaderView loader;
    DriverAllTripFeed driverAllTripFeed;
    int position;


    //Reviews
    RelativeLayout rl_view_reviews;
    SimpleRatingBar properRatingbar;

    TextView tv_upload_review;
    String uploadUserId;

    //Get Direction
    FloatingActionButton btnMapDirection;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_driver_trip_detail);

        userPref = PreferenceManager.getDefaultSharedPreferences(DriverTripDetailActivity.this);

        position = getIntent().getIntExtra("position",0);

        loader=new LoaderView(DriverTripDetailActivity.this);


        OpenSans_Regular = Typeface.createFromAsset(getAssets(), getResources().getString(R.string.font_regular_opensans));
        Roboto_Regular = Typeface.createFromAsset(getAssets(), getResources().getString(R.string.font_regular_roboto));
        Roboto_Medium = Typeface.createFromAsset(getAssets(), getResources().getString(R.string.font_medium_roboto));
        Roboto_Bold = Typeface.createFromAsset(getAssets(), getResources().getString(R.string.font_bold_roboto));
        OpenSans_Semibold = Typeface.createFromAsset(getAssets(), getResources().getString(R.string.font_semibold_opensans));

        driverAllTripFeed = Common.driverAllTripFeed;

        layout_back_arrow = (RelativeLayout)findViewById(R.id.layout_back_arrow);
        layout_back_arrow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent di = new Intent();
                di.putExtra("position", position);
                di.putExtra("status", driverAllTripFeed.getStatus());
                di.putExtra("driver_flage", driverAllTripFeed.getDriverFlag());
                di.putExtra("payment_type", driverAllTripFeed.getPaymentType());
                di.putExtra("payment_status", driverAllTripFeed.getPaymentStatus());
                di.putExtra("reviews", driverAllTripFeed.getIsUploadReview());
                setResult(1, di);
                finish();
            }
        });

        //Top Heading - Review
        tv_upload_review=(TextView)findViewById(R.id.tv_upload_review);
        tv_upload_review.setTypeface(Roboto_Regular);
        if(driverAllTripFeed.getIsUploadReview()!=null && !driverAllTripFeed.getIsUploadReview().equals("") && driverAllTripFeed.getIsUploadReview().equals("1")){
            tv_upload_review.setVisibility(View.GONE);
        }else{
            if(driverAllTripFeed.getStatus().equals("9") && driverAllTripFeed.getIsUploadReview()!=null && !driverAllTripFeed.getIsUploadReview().equals("") && driverAllTripFeed.getIsUploadReview().equals("0")) {
                tv_upload_review.setVisibility(View.VISIBLE);
            }else{
                tv_upload_review.setVisibility(View.GONE);
            }
        }
        tv_upload_review.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                MaterialDialog.Builder builder = new MaterialDialog.Builder(DriverTripDetailActivity.this)
                        .title(R.string.dialog_review_title)
                        .titleGravity(GravityEnum.CENTER)
                        .customView(R.layout.reviewupload,true)
                        .cancelable(false)
                        .canceledOnTouchOutside(true)
                        .autoDismiss(false)
                        .negativeText(R.string.dialog_cancel)
                        .positiveText(R.string.submit);

                MaterialDialog dialog = builder.build();
                final ImageView iv_user_photo=(ImageView)dialog.getCustomView().findViewById(R.id.iv_user_photo);
                if(driverAllTripFeed.getuserDetail() != null && !driverAllTripFeed.getuserDetail().equals("")) {
                    try {
                        JSONObject userObj = new JSONObject(driverAllTripFeed.getuserDetail());
                        uploadUserId=userObj.getString("id");
                        Log.e("Okayswitzerland","Driver ->Userid >>"+uploadUserId);
                        if (userObj.has("facebook_id") && !userObj.getString("facebook_id").equals("")) {
                            String facebookImage = Url.FacebookImgUrl + userObj.getString("facebook_id").toString() + "/picture?type=large";
                            Picasso.with(DriverTripDetailActivity.this)
                                    .load(facebookImage)
                                    .placeholder(R.drawable.user_photo)
                                    .resize(200, 200)
                                    .transform(new CircleTransformation(DriverTripDetailActivity.this))
                                    .into(iv_user_photo);

                        } else if (userObj.has("image")) {

                            Picasso.with(DriverTripDetailActivity.this)
                                    .load(Uri.parse(Url.userImageUrl + userObj.getString("image")))
                                    .placeholder(R.drawable.user_photo)
                                    .transform(new CircleTransformation(DriverTripDetailActivity.this))
                                    .into(iv_user_photo);
                        }

                    }catch (Exception e){
                        e.printStackTrace();}
                }
                final SimpleRatingBar review_rating = (SimpleRatingBar) dialog.getCustomView().findViewById(R.id.review_rating);
                final EditText edt_reviews = (EditText) dialog.getCustomView().findViewById(R.id.edt_reviews);
                dialog.getBuilder().onNegative(new MaterialDialog.SingleButtonCallback() {
                    @Override
                    public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                        dialog.cancel();
                    }
                });
                dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
                    @Override
                    public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                        if(review_rating.getRating()==0){
                            Log.e("Okayswiss","Please give rating"+review_rating.getRating());
                            Toast.makeText(DriverTripDetailActivity.this,"Please give rating.", Toast.LENGTH_LONG).show();
                        }else if(edt_reviews.getText().toString().equals("")){
                            Log.e("Okayswiss","Please enter views");
                            Toast.makeText(DriverTripDetailActivity.this,"Please enter your feed back.", Toast.LENGTH_LONG).show();
                        }else{
                            dialog.cancel();
                            uploadReviews(review_rating.getRating()+"",edt_reviews.getText().toString());
                        }

                        Log.e("Okayswiss","rating :"+review_rating.getRating());
                        Log.e("Okayswiss","rating :"+edt_reviews.getText().toString());

                    }
                });
                dialog.show();

            }
        });

        txt_booking_detail = (TextView)findViewById(R.id.txt_booking_detail);
        txt_booking_id = (TextView)findViewById(R.id.txt_booking_id);
        txt_booking_id_val = (TextView)findViewById(R.id.txt_booking_id_val);
        txt_pickup_point = (TextView)findViewById(R.id.txt_pickup_point);
        txt_pickup_point_val = (TextView)findViewById(R.id.txt_pickup_point_val);
        txt_booking_date = (TextView)findViewById(R.id.txt_booking_date);
        txt_drop_point = (TextView)findViewById(R.id.txt_booking_date);
        txt_drop_point_val = (TextView)findViewById(R.id.txt_drop_point_val);
        txt_user_name = (TextView)findViewById(R.id.txt_user_name);
        txt_user_email = (TextView)findViewById(R.id.txt_user_email);
        txt_mobile_num = (TextView)findViewById(R.id.txt_mobile_num);
        txt_distance = (TextView)findViewById(R.id.txt_distance);
        txt_distance_val = (TextView)findViewById(R.id.txt_distance_val);
        txt_distance_km = (TextView)findViewById(R.id.txt_distance_km);
        txt_total_price = (TextView)findViewById(R.id.txt_total_price);
        txt_total_price_dol = (TextView)findViewById(R.id.txt_total_price_dol);
        txt_total_price_val = (TextView)findViewById(R.id.txt_total_price_val);
        txt_payment_type = (TextView)findViewById(R.id.txt_payment_type);
        txt_payment_type_val = (TextView)findViewById(R.id.txt_payment_type_val);
        txt_approx_time = (TextView)findViewById(R.id.txt_approx_time);
        txt_approx_time_val = (TextView)findViewById(R.id.txt_approx_time_val);
        txt_payment_detial = (TextView)findViewById(R.id.txt_payment_detial);
        txt_vehicle_detail = (TextView)findViewById(R.id.txt_vehicle_detail);
        txt_to = (TextView)findViewById(R.id.txt_to);

        img_user_image = (ImageView)findViewById(R.id.img_user_image);

        layout_payment_type=(RelativeLayout)findViewById(R.id.layout_payment_type);

        txt_booking_detail.setTypeface(OpenSans_Regular);

        txt_booking_id.setTypeface(Roboto_Regular);
        txt_pickup_point.setTypeface(Roboto_Regular);
        txt_drop_point.setTypeface(Roboto_Regular);
        txt_distance_km.setTypeface(Roboto_Regular);
        txt_total_price_dol.setTypeface(Roboto_Regular);
        txt_total_price_dol.setText(userPref.getString("currency",""));

        txt_user_name.setTypeface(Roboto_Regular);
        txt_user_email.setTypeface(Roboto_Regular);
        txt_mobile_num.setTypeface(Roboto_Regular);

        txt_pickup_point_val.setTypeface(OpenSans_Regular);
        txt_booking_date.setTypeface(OpenSans_Regular);
        txt_drop_point_val.setTypeface(OpenSans_Regular);
        txt_distance.setTypeface(OpenSans_Regular);
        txt_distance_val.setTypeface(OpenSans_Regular);
        txt_total_price.setTypeface(OpenSans_Regular);
        txt_total_price_val.setTypeface(OpenSans_Regular);
        txt_payment_type.setTypeface(OpenSans_Regular);
        txt_payment_type_val.setTypeface(OpenSans_Regular);
        txt_approx_time.setTypeface(OpenSans_Regular);
        txt_approx_time_val.setTypeface(OpenSans_Regular);
        txt_payment_detial.setTypeface(Roboto_Bold);
        txt_vehicle_detail.setTypeface(Roboto_Bold);
        txt_to.setTypeface(Roboto_Bold);

        txt_booking_id_val.setText(driverAllTripFeed.getId());
        txt_pickup_point_val.setText(driverAllTripFeed.getPickupArea());
        txt_drop_point_val.setText(driverAllTripFeed.getDropArea());
        txt_distance_val.setText(driverAllTripFeed.getKm());
        txt_total_price_val.setText(driverAllTripFeed.getAmount());
        txt_payment_type_val.setText(driverAllTripFeed.getPaymentType());


        btnMapDirection=(FloatingActionButton)findViewById(R.id.btnMapDirection);
        btnMapDirection.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                openMapDirection();
            }
        });

        //User Payment Status
        if(driverAllTripFeed.getDriverFlag().equals("3") || driverAllTripFeed.getStatus().equals("9")) {
            if(driverAllTripFeed.getPaymentStatus()!=null && driverAllTripFeed.getPaymentStatus().equals("1")){
                txt_payment_type_val.setText(driverAllTripFeed.getPaymentType()+" - Pending ");
                System.out.println("Payment Status >>>"+" Pending ");
                txt_payment_type_val.setTextColor(ContextCompat.getColor(this, R.color.booking_truck_type));
            }else if(driverAllTripFeed.getPaymentStatus()!=null && driverAllTripFeed.getPaymentStatus().equals("2")){
                txt_payment_type_val.setText(driverAllTripFeed.getPaymentType()+" - Complete ");
                System.out.println("Payment Status >>>"+" Complete   ");
                txt_payment_type_val.setTextColor(ContextCompat.getColor(this, R.color.detail_color));

            }
            layout_payment_type.setVisibility(View.VISIBLE);
        }else{
            layout_payment_type.setVisibility(View.GONE);
        }



        SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
        String pickup_date_time = "";
        try {
            Date parceDate = simpleDateFormat.parse(driverAllTripFeed.getPickupDateTime());
            SimpleDateFormat parceDateFormat = new SimpleDateFormat("h:mm a,dd,MMM yyyy");
            pickup_date_time = parceDateFormat.format(parceDate.getTime());
        } catch (ParseException e) {
            e.printStackTrace();
        }

        txt_booking_date.setText(pickup_date_time);

        txt_approx_time_val.setText(driverAllTripFeed.getApproxTime());

        //User Rating
        properRatingbar=(SimpleRatingBar)findViewById(R.id.properRatingbar);
        rl_view_reviews=(RelativeLayout)findViewById(R.id.rl_view_reviews);
        if(driverAllTripFeed.getuserDetail() != null && !driverAllTripFeed.getuserDetail().equals("")) {
            try {
                JSONObject userObj = new JSONObject(driverAllTripFeed.getuserDetail());

                if(userObj.has("facebook_id") && !userObj.getString("facebook_id").equals("")){
                    String facebookImage = Url.FacebookImgUrl + userObj.getString("facebook_id").toString() + "/picture?type=large";
                    Picasso.with(DriverTripDetailActivity.this)
                            .load(facebookImage)
                            .placeholder(R.drawable.user_photo)
                            .resize(200, 200)
                            .transform(new  CircleTransformation(DriverTripDetailActivity.this))
                            .into(img_user_image);

                }else if(userObj.has("image")){

                    Picasso.with(DriverTripDetailActivity.this)
                            .load(Uri.parse(Url.userImageUrl + userObj.getString("image")))
                            .placeholder(R.drawable.user_photo)
                            .transform(new CircleTransformation(DriverTripDetailActivity.this))
                            .into(img_user_image);
                }

                img_user_image.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        Intent di = new Intent(DriverTripDetailActivity.this, ReviewProfileActivity.class);
                        di.putExtra("which_activity", 1);
                        startActivity(di);

                    }
                });
                rl_view_reviews.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        img_user_image.performClick();
                    }
                });

                if(userObj.has("name"))
                txt_user_name.setText(userObj.getString("name"));
                if(userObj.has("email")) {
                    txt_user_email.setText(userObj.getString("email"));
                    txt_user_email.setVisibility(View.GONE);
                }
                if(userObj.has("mobile")){
                    UserMobileNu = userObj.getString("mobile");
                    txt_mobile_num.setText(UserMobileNu);
                }
                if(userObj.has("rating_avrage"))
                properRatingbar.setRating(Float.parseFloat(userObj.getString("rating_avrage")));
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        layout_accepted = (LinearLayout)findViewById(R.id.layout_accepted);

        layout_arrived = (RelativeLayout) findViewById(R.id.layout_arrived);
        layout_arrived.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                MaterialDialog.Builder builder = new MaterialDialog.Builder(DriverTripDetailActivity.this)
                        .content(R.string.arrived_message)
                        .negativeText(R.string.dialog_cancel)
                        .positiveText(R.string.dialog_ok)
                        .onPositive(new MaterialDialog.SingleButtonCallback() {
                            @Override
                            public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                                dialog.cancel();
                                loader.show();
                                String ArrivedUrl = Url.DriverArrivedTripUrl+"?booking_id="+driverAllTripFeed.getId()+"&driver_id="+userPref.getString("id","");
                                Log.d("ArrivedUrl","ArrivedUrl = "+ArrivedUrl);
                                DriverCall(ArrivedUrl,"7");
                            }
                        });

                MaterialDialog dialog = builder.build();
                dialog.show();

            }
        });
        layout_begin_trip = (RelativeLayout)findViewById(R.id.layout_begin_trip);
        layout_begin_trip.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                MaterialDialog.Builder builder = new MaterialDialog.Builder(DriverTripDetailActivity.this)
                        .content(R.string.begin_message)
                        .negativeText(R.string.dialog_cancel)
                        .positiveText(R.string.dialog_ok)
                        .onPositive(new MaterialDialog.SingleButtonCallback() {
                            @Override
                            public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                                dialog.cancel();
                                Common.OnTripTime = Common.getCurrentTime();
                                driverAllTripFeed.setStartRideTime(Common.getCurrentTime());

                                loader.show();
                                String BeginUrl = Url.DriverOnTripUrl+"?booking_id="+driverAllTripFeed.getId()+"&driver_id="+userPref.getString("id","");
                                Log.d("ArrivedUrl","ArrivedUrl = "+BeginUrl);
                                DriverCall(BeginUrl,"8");
                            }
                        });

                MaterialDialog dialog = builder.build();
                dialog.show();

            }
        });

        layout_user_call = (RelativeLayout)findViewById(R.id.layout_user_call);
        layout_user_call.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        Intent callIntent = new Intent(Intent.ACTION_DIAL);
                        callIntent.setData(Uri.parse("tel:"+UserMobileNu));
                        startActivity(callIntent);
                    }
                }, 100);
            }
        });

        layout_finished = (RelativeLayout)findViewById(R.id.layout_finished);
        layout_finished.setOnClickListener(new View.OnClickListener() {
            @RequiresApi(api = Build.VERSION_CODES.N)
            @Override
            public void onClick(View view) {
                driverAllTripFeed.setEndRideTime(Common.getCurrentTime());
                Common.FinishedTripTime = Common.getCurrentTime();
                Common.driverAllTripFeed = driverAllTripFeed;
                Intent fi = new Intent(DriverTripDetailActivity.this, FinishTripActivity.class);
                fi.putExtra("position",position);
                startActivityForResult(fi,1);
            }
        });

        btnMapDirection.setVisibility(View.GONE);
        if(driverAllTripFeed.getStatus().equals("1")){
            layout_accepted.setVisibility(View.GONE);
        }else if(driverAllTripFeed.getStatus().equals("3")){
            layout_accepted.setVisibility(View.VISIBLE);
            layout_arrived.setVisibility(View.VISIBLE);
            layout_user_call.setVisibility(View.VISIBLE);
            // layout_begin_trip.setVisibility(View.GONE);
            btnMapDirection.setVisibility(View.VISIBLE);
        }else if(driverAllTripFeed.getStatus().equals("7")){
            layout_accepted.setVisibility(View.VISIBLE);
            layout_arrived.setVisibility(View.GONE);
            layout_user_call.setVisibility(View.VISIBLE);
            layout_begin_trip.setVisibility(View.VISIBLE);
            btnMapDirection.setVisibility(View.VISIBLE);
        }else if(driverAllTripFeed.getStatus().equals("8")){
            layout_accepted.setVisibility(View.GONE);
            layout_arrived.setVisibility(View.GONE);
            layout_user_call.setVisibility(View.GONE);
            layout_begin_trip.setVisibility(View.GONE);
            layout_finished.setVisibility(View.VISIBLE);
            btnMapDirection.setVisibility(View.VISIBLE);
        }else if(driverAllTripFeed.getStatus().equals("9")){
            layout_accepted.setVisibility(View.GONE);
            layout_arrived.setVisibility(View.GONE);
            layout_user_call.setVisibility(View.GONE);
            layout_begin_trip.setVisibility(View.GONE);
            layout_finished.setVisibility(View.GONE);
            btnMapDirection.setVisibility(View.GONE);
        }else if(driverAllTripFeed.getStatus().equals("6")){
            layout_accepted.setVisibility(View.GONE);
            layout_arrived.setVisibility(View.GONE);
            layout_user_call.setVisibility(View.GONE);
            layout_begin_trip.setVisibility(View.GONE);
            layout_finished.setVisibility(View.GONE);
            btnMapDirection.setVisibility(View.GONE);
        }
    }

    public void openMapDirection(){
        String uri = "http://maps.google.com/maps?saddr="+"&daddr="+driverAllTripFeed.getPickupArea()+"&mode=driving";
        if(driverAllTripFeed.getStatus().equals("8")){
            uri = "http://maps.google.com/maps?saddr="+driverAllTripFeed.getPickupArea()+"&daddr="+driverAllTripFeed.getDropArea()+"&mode=driving";
        }
        Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(uri));
        intent.setClassName("com.google.android.apps.maps", "com.google.android.maps.MapsActivity");
        try
        {
            startActivity(intent);
        }
        catch(ActivityNotFoundException ex)
        {
            try
            {
                Intent unrestrictedIntent = new Intent(Intent.ACTION_VIEW, Uri.parse(uri));
                startActivity(unrestrictedIntent);
            }
            catch(ActivityNotFoundException innerEx)
            {
                Toast.makeText(this, "Please install a maps application", Toast.LENGTH_LONG).show();
            }
        }
    }

    public void uploadReviews(String rating,String feedback){
        try {
//        http://139.59.154.174/web_service/user_rate?user_id=60&driver_id=228&driver_comment=Nsw2§ice sdkfasajfdkjjk ksdsfj sfjksfjksjf kasf&user_rate=2.8
            Log.e("Upload Rating", Url.UploadReviewUrl + "?driver_id=" + userPref.getString("id", "") + "&user_id=" + uploadUserId + "&driver_comment=" + feedback + "&user_rate=" + rating+"&book_id="+driverAllTripFeed.getId());
            Ion.with(DriverTripDetailActivity.this)
                    .load(Url.UploadReviewUrl+"?driver_id="+userPref.getString("id", "")+"&user_id="+uploadUserId+"&driver_comment="+URLEncoder.encode(feedback,"UTF-8")+"&user_rate="+rating+"&book_id="+driverAllTripFeed.getId())
//                  .setTimeout(60*60*1000)
                    .asJsonObject()
                    .setCallback(new FutureCallback<JsonObject>() {
                        @Override
                        public void onCompleted(Exception error, JsonObject result) {
                            // do stuff with the result or error
                            Log.e("Okayswiss", "reviews result = " + result + "==" + error);
                            if (error == null) {
                                try {

                                    JSONObject resObj = new JSONObject(result.toString());
                                    if (resObj.getString("status").equals("success")) {

                                    } else if (resObj.getString("status").equals("false")) {

                                        SharedPreferences.Editor editor = userPref.edit();
                                        editor.clear();
                                        editor.commit();

                                        Intent logInt = new Intent(DriverTripDetailActivity.this, LoginActivity.class);
                                        logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                                        logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                        logInt.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                        startActivity(logInt);

                                    } else {


                                    }
                                } catch (JSONException e) {
                                    e.printStackTrace();
                                }

                            } else {
                                Common.ShowHttpErrorMessage(DriverTripDetailActivity.this, error.getMessage());
                            }
                        }
                    });

        }catch (Exception e){
            e.printStackTrace();
        }
    }

    /*Driver status change call*/
    public void DriverCall(String callFun, final String DriverStatus){

        Log.d("callFun","callFun = "+callFun);

        Ion.with(DriverTripDetailActivity.this)
                .load(callFun)
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @RequiresApi(api = Build.VERSION_CODES.N)
                    @Override
                    public void onCompleted(Exception e, JsonObject result) {
                        loader.loaderObject().stop();
                        loader.loaderDismiss();
                        // do stuff with the result or error
                        if (e != null) {
                            Toast.makeText(DriverTripDetailActivity.this, "Login Error" + e.getMessage(), Toast.LENGTH_LONG).show();
                            return;
                        }
                        try {
                            JSONObject jsonObject = new JSONObject(result.toString());
                            Log.d("jsonObject","jsonObject = "+jsonObject);
                            if (jsonObject.has("status") && jsonObject.getString("status").equals("success")) {

                                driverAllTripFeed.setStatus(DriverStatus);
                                if(DriverStatus.equals("7")){

                                    SharedPreferences.Editor booking_status = userPref.edit();
                                    booking_status.putString("booking_status","i have arrived");
                                    booking_status.commit();

                                    layout_accepted.setVisibility(View.VISIBLE);
                                    layout_arrived.setVisibility(View.GONE);
                                    layout_user_call.setVisibility(View.VISIBLE);
                                    layout_begin_trip.setVisibility(View.VISIBLE);

                                    updateBookingStatus();

                                }else if(DriverStatus.equals("8")){

                                    SharedPreferences.Editor booking_status = userPref.edit();
                                    booking_status.putString("booking_status","begin trip");
                                    booking_status.commit();

                                    layout_accepted.setVisibility(View.GONE);
                                    layout_arrived.setVisibility(View.GONE);
                                    layout_user_call.setVisibility(View.GONE);
                                    layout_begin_trip.setVisibility(View.GONE);
                                    layout_finished.setVisibility(View.VISIBLE);
                                    driverAllTripFeed.setStartRideTime(Common.getCurrentTime());
                                    updateBookingStatus();
                                }
                            }else if(jsonObject.getString("status").equals("false")){

                                Common.showMkError(DriverTripDetailActivity.this,jsonObject.getString("error code").toString());

                                if(jsonObject.has("Isactive") && jsonObject.getString("Isactive").equals("Inactive")) {

                                    SharedPreferences.Editor editor = userPref.edit();
                                    editor.clear();
                                    editor.commit();

                                    new Handler().postDelayed(new Runnable() {
                                        @Override
                                        public void run() {
                                            Intent intent = new Intent(DriverTripDetailActivity.this, LoginActivity.class);
                                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP | Intent.FLAG_ACTIVITY_SINGLE_TOP);
                                            intent.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                            startActivity(intent);
                                            finish();
                                        }
                                    }, 2500);
                                }
                            }
                        } catch (Exception e1) {
                            e1.printStackTrace();
                        }


                    }
                });
    }

    @Override
    public void onActivityResult(int requestCode, int resultCode, Intent data) {
        Log.d("requestCode","DETAIL_REQUEST DriverDetail = "+requestCode+"=="+resultCode);
        if(requestCode == 1){
            if(data != null) {
                Intent di = new Intent();
                di.putExtra("position", position);
                di.putExtra("status", driverAllTripFeed.getStatus());
                di.putExtra("driver_flage", driverAllTripFeed.getDriverFlag());
                di.putExtra("payment_type", driverAllTripFeed.getPaymentType());
                di.putExtra("payment_status", driverAllTripFeed.getPaymentStatus());
                di.putExtra("reviews", driverAllTripFeed.getIsUploadReview());
                setResult(1, di);
                finish();
            }
        }
    }


    public void updateBookingStatus(){
        try {

            double latitude=0.0,longitude=0.0;
            if(Common.gpsTracker.canGetLocation()){
                latitude = Common.gpsTracker.getLatitude();
                longitude = Common.gpsTracker.getLongitude();
            }else{
                Common.gpsTracker.showSettingsAlert();
            }

            JSONArray locAry = new JSONArray();
            locAry.put(latitude);
            locAry.put(longitude);
            JSONObject emitobj = new JSONObject();
            emitobj.put("coords",locAry);
            emitobj.put("driver_name",userPref.getString("user_name",""));
            emitobj.put("driver_id", userPref.getString("id",""));
            emitobj.put("driver_status", "2");
            emitobj.put("car_type",userPref.getString("car_type",""));
            emitobj.put("isdevice","1");
            emitobj.put("booking_status",userPref.getString("booking_status",""));
            emitobj.put("isLocationChange",0);
            Log.d("emitobj", "Distance emitobj = " + emitobj);
            if(Common.socket!=null && Common.socket.connected())
                Common.socket.emit("Create Driver Data", emitobj);
            else{
                Common.socket=null;
                SocketSingleObject.instance=null;
                Common.socket=SocketSingleObject.get(DriverTripDetailActivity.this).getSocket();
                Common.socket.connect();
                Common.socket.emit("Create Driver Data", emitobj);
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }

    @Override
    public void onDestroy() {
        super.onDestroy();

        layout_back_arrow = null;
        img_user_image = null;
        txt_booking_detail = null;
        txt_booking_id = null;
        txt_booking_id_val = null;
        txt_pickup_point = null;
        txt_pickup_point_val = null;
        txt_booking_date = null;
        txt_drop_point = null;
        txt_drop_point_val = null;
        txt_user_name = null;
        txt_user_email = null;
        txt_mobile_num = null;
        txt_distance = null;
        txt_distance_val = null;
        txt_distance_km = null;
        txt_total_price = null;
        txt_total_price_dol = null;
        txt_total_price_val = null;
        layout_accepted = null;
        layout_arrived = null;
        layout_begin_trip = null;
        layout_user_call = null;
        layout_finished = null;
    }
}
