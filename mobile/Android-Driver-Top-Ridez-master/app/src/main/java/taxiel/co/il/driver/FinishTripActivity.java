package taxiel.co.il.driver;

import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.support.annotation.NonNull;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RadioButton;
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

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.Date;

public class FinishTripActivity extends AppCompatActivity {

    RelativeLayout layout_finished;
    RelativeLayout layout_back_arrow;
    TextView txt_booking_detail;
    ImageView img_user;
    TextView txt_user_name,txt_booking_date, txt_pickup_location,txt_pickup_time,txt_pickup_location_val,txt_drop_location,
             txt_drop_time,txt_drop_location_val,txt_distance,txt_distance_val,txt_total_time,txt_approc_price,txt_approc_price_val,
             txt_final_price,txt_final_price_val,txt_appr_currence,txt_final_currence;
    EditText edt_final_amount;
    EditText edt_reason_ride;
    RadioButton radioCase,radioCard,radioPos;
    String PaymentType = "";

    DriverAllTripFeed driverAllTripFeed;

    SharedPreferences userPref;
    LoaderView loader;
    int position;
    String userid,paymentStatus;

    String uploadUserId;

     @Override
    protected void onCreate(Bundle savedInstanceState) {
         super.onCreate(savedInstanceState);
         setContentView(R.layout.activity_finish_trip);

         userPref = PreferenceManager.getDefaultSharedPreferences(FinishTripActivity.this);
         loader = new LoaderView(FinishTripActivity.this);

         position = getIntent().getIntExtra("position", 0);

         driverAllTripFeed = Common.driverAllTripFeed;

         txt_booking_detail = (TextView) findViewById(R.id.txt_booking_detail);
         img_user = (ImageView) findViewById(R.id.img_user);
         txt_user_name = (TextView) findViewById(R.id.txt_user_name);
         txt_booking_date = (TextView) findViewById(R.id.txt_booking_date);
         txt_pickup_location = (TextView) findViewById(R.id.txt_pickup_location);
         txt_pickup_time = (TextView) findViewById(R.id.txt_pickup_time);
         txt_pickup_location_val = (TextView) findViewById(R.id.txt_pickup_location_val);
         txt_drop_location = (TextView) findViewById(R.id.txt_drop_location);
         txt_drop_time = (TextView) findViewById(R.id.txt_drop_time);
         txt_drop_location_val = (TextView) findViewById(R.id.txt_drop_location_val);
         layout_finished = (RelativeLayout) findViewById(R.id.layout_finished);
         txt_distance = (TextView) findViewById(R.id.txt_distance);
         txt_distance_val = (TextView) findViewById(R.id.txt_distance_val);
         txt_total_time = (TextView) findViewById(R.id.txt_total_time);
         txt_approc_price = (TextView) findViewById(R.id.txt_approc_price);
         txt_approc_price_val = (TextView) findViewById(R.id.txt_approc_price_val);
         txt_final_price = (TextView) findViewById(R.id.txt_final_price);
         txt_final_price_val = (TextView) findViewById(R.id.txt_final_price_val);
         txt_appr_currence = (TextView) findViewById(R.id.txt_appr_currence);
         txt_final_currence = (TextView) findViewById(R.id.txt_final_currence);
         edt_final_amount = (EditText) findViewById(R.id.edt_final_amount);
         edt_final_amount.setEnabled(false);
         edt_reason_ride = (EditText) findViewById(R.id.edt_reason_ride);
         radioCase = (RadioButton) findViewById(R.id.radioCase);
         radioCard = (RadioButton) findViewById(R.id.radioCard);
         radioPos = (RadioButton)findViewById(R.id.radioPos);

         txt_appr_currence.setText(userPref.getString("currency", ""));
         txt_final_currence.setText(userPref.getString("currency", ""));
         if (Common.OnTripTime != "")
             txt_pickup_time.setText(Common.OnTripTime);
         if (Common.FinishedTripTime != "")
             txt_drop_time.setText(Common.FinishedTripTime);
         txt_approc_price_val.setText(driverAllTripFeed.getAmount());


         SimpleDateFormat timeDifFormate = new SimpleDateFormat("HH:mm:ss");
         String TotalTime = "";
         try {
             Date starttime = timeDifFormate.parse(Common.OnTripTime);
             Date endtime = timeDifFormate.parse(Common.FinishedTripTime);

             long TwoTimeDif = endtime.getTime() - starttime.getTime();

             long mills = Math.abs(TwoTimeDif);

             int Hours = (int) (mills / (1000 * 60 * 60));
             int Mins = (int) (mills / (1000 * 60)) % 60;
             long Secs = (int) (mills / 1000) % 60;

             Log.d("TwoTimeDif", "TwoTimeDif = " + Common.FinishedTripTime + "==" + Common.OnTripTime);
             Log.d("TwoTimeDif", "TwoTimeDif = " + endtime.getTime() + "==" + starttime.getTime());
             Log.d("TwoTimeDif", "TwoTimeDif = " + TwoTimeDif + "==" + Hours + "==" + Mins + "==" + Secs);

             if (Hours > 0)
                 TotalTime += Hours + " hr ";
             if (Mins > 0)
                 TotalTime += Mins + " min ";

             txt_total_time.setText(TotalTime);

         } catch (ParseException e) {
             e.printStackTrace();
         }

         txt_distance_val.setText(driverAllTripFeed.getKm() + " km");

         if (driverAllTripFeed.getuserDetail() != null && !driverAllTripFeed.getuserDetail().equals("")) {
             try {
                 JSONObject DrvObj = new JSONObject(driverAllTripFeed.getuserDetail());
                 uploadUserId=DrvObj.getString("id");
                 System.out.println("DriverApp - UserDetails >>>" + DrvObj);
                 Picasso.with(FinishTripActivity.this)
                         .load(Uri.parse(Url.userImageUrl + DrvObj.getString("image")))
                         .placeholder(R.drawable.user_photo)
                         .transform(new CircleTransformation(FinishTripActivity.this))
                         .into(img_user);
                 txt_user_name.setText(DrvObj.getString("username"));

                 userid = DrvObj.getString("id");

             } catch (JSONException e) {
                 e.printStackTrace();
             }
         }

         SimpleDateFormat simpleDateFormat = new SimpleDateFormat("yyyy-MM-dd HH:mm:ss");
         String pickup_date_time = "";
         try {
             Date parceDate = simpleDateFormat.parse(driverAllTripFeed.getPickupDateTime());
             SimpleDateFormat parceDateFormat = new SimpleDateFormat("dd MMM yyyy");
             pickup_date_time = parceDateFormat.format(parceDate.getTime());

         } catch (ParseException e) {
             e.printStackTrace();
         }

         txt_booking_date.setText(pickup_date_time);

         txt_pickup_location_val.setText(driverAllTripFeed.getPickupArea());
         txt_drop_location_val.setText(driverAllTripFeed.getDropArea());

        /*Final amount caculation*/

         String approxTime[] = driverAllTripFeed.getApproxTime().split(" ");
         int hours = 0;
         int mintus = 0;
         if (approxTime.length == 4) {
             hours = Integer.parseInt(approxTime[0]) * 60;
             mintus = Integer.parseInt(approxTime[2]);
         } else if (approxTime.length == 2) {
             if (approxTime[1].contains("mins"))
                 mintus = Integer.parseInt(approxTime[0]);
             else
                 mintus = Integer.parseInt(approxTime[0]) * 3600;
         }

         Float aprTime = (hours + mintus) * Float.parseFloat(driverAllTripFeed.getPerMinuteRate());
         Log.d("Driver Price", "Driver Price = " + aprTime + "==" + hours + "==" + mintus);
         Float RideAmount = Integer.parseInt(driverAllTripFeed.getAmount()) - aprTime;

         int final_hours = 0;
         int final_mintus = 0;
         String timeSplite[] = TotalTime.split(" ");
         if (timeSplite.length == 2) {
             final_mintus = Integer.parseInt(timeSplite[0]);
         } else if (timeSplite.length == 4) {
             final_hours = Integer.parseInt(timeSplite[0]) * 60;
             final_mintus = Integer.parseInt(timeSplite[2]);
         }

         float DriverAmount = (final_hours + final_mintus) * Float.parseFloat(driverAllTripFeed.getPerMinuteRate());
         int finalPrice = (int) (DriverAmount + RideAmount);
         txt_final_price_val.setText(finalPrice + "");
         edt_final_amount.setText(finalPrice + "");
         Log.d("Driver Price", "Driver Price = " + aprTime + "==" + RideAmount + "==" + final_mintus + "==" + final_hours + "==" + DriverAmount);

         layout_finished.setOnClickListener(new View.OnClickListener() {
             @Override
             public void onClick(View view) {

                 Common.UpdateSocketDriverStatus(Common.socket, userPref, "0");

                 if (edt_final_amount.getText().toString().length() == 0) {
                     Common.showMkError(FinishTripActivity.this, getResources().getString(R.string.please_enter_amount));
                     return;
                 }
//                 if (radioCard.isChecked()) {
                     PaymentType = "card";
                     paymentStatus = "1";
//                 }

//                 else if (radioCase.isChecked()) {
//                     PaymentType = "cash";
//                     paymentStatus = "2";
//                 }else if(radioPos.isChecked()){
//                     PaymentType = "pos";
//                     paymentStatus = "2";
//                 }

                 loader.show();
                 String FinishUrl = "";
                 try {

                     FinishUrl = Url.DriverCompletedTripUrl + "?booking_id=" + driverAllTripFeed.getId() + "&driver_id="
                             + userPref.getString("id", "") + "&final_amount=" + edt_final_amount.getText().toString()
                             + "&delay_reason=" + URLEncoder.encode(edt_reason_ride.getText().toString(), "utf-8") + "&payment_type="
                             + PaymentType + "&user_id=" + userid + "&currency=" + userPref.getString("currency", "") + "&payment_status=" + paymentStatus;

                 } catch (UnsupportedEncodingException e) {
                     e.printStackTrace();
                 }
                 Log.e("Okayswiss", "FinishUrl = " + FinishUrl);
                 Ion.with(FinishTripActivity.this)
                         .load(FinishUrl)
                         .setTimeout(60 * 60 * 1000)
                         .asJsonObject()
                         .setCallback(new FutureCallback<JsonObject>() {
                             @Override
                             public void onCompleted(Exception e, JsonObject result) {

                                 Log.e("Okayswiss","Finish Trip :"+result.toString());

                                 loader.loaderObject().stop();
                                 loader.loaderDismiss();

                                 // do stuff with the result or error
                                 if (e != null) {
                                     Common.showMkError(FinishTripActivity.this, e.getMessage());
                                     return;
                                 }
                                 layout_finished.setVisibility(View.GONE);
                                 try {
                                     JSONObject jsonObject = new JSONObject(result.toString());
                                     if (jsonObject.has("status") && jsonObject.getString("status").equals("success")) {

                                         layout_finished.setVisibility(View.GONE);

                                         SharedPreferences.Editor isBookingAccept = userPref.edit();
                                         isBookingAccept.putBoolean("isBookingAccept", false);
                                         isBookingAccept.commit();

                                         SharedPreferences.Editor booking_status = userPref.edit();
                                         booking_status.putString("booking_status", "finished");
                                         booking_status.commit();

                                         if(jsonObject.has("payment_status")){
                                             JSONObject jsonObject1=new JSONObject(jsonObject.getString("payment_status"));
                                             if(jsonObject1.has("payment_status")){
                                                 PaymentType=jsonObject1.getString("payment_type");
                                                 paymentStatus=jsonObject1.getString("payment_status");
                                             }
                                         }

                                         driverAllTripFeed.setStatus("9");
                                         driverAllTripFeed.setDriverFlag("3");
                                         driverAllTripFeed.setPaymentType(PaymentType);
                                         driverAllTripFeed.setPaymentStatus(paymentStatus);


                                         updateBookingStatus();

                                         SharedPreferences.Editor DriverStatus = userPref.edit();
                                         DriverStatus.putString("driver_status", "free");
                                         DriverStatus.commit();


                                         openReviewDialog();



                                     }
                                 } catch (Exception e1) {
                                     e1.printStackTrace();
                                 }
                             }
                         });

             }
         });

         layout_back_arrow = (RelativeLayout) findViewById(R.id.layout_back_arrow);
         layout_back_arrow.setOnClickListener(new View.OnClickListener() {
             @Override
             public void onClick(View view) {
                 finish();
             }
         });


     }


    public void openReviewDialog(){

        MaterialDialog.Builder builder = new MaterialDialog.Builder(FinishTripActivity.this)
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
                    Picasso.with(FinishTripActivity.this)
                            .load(facebookImage)
                            .placeholder(R.drawable.user_photo)
                            .resize(200, 200)
                            .transform(new CircleTransformation(FinishTripActivity.this))
                            .into(iv_user_photo);

                } else if (userObj.has("image")) {

                    Picasso.with(FinishTripActivity.this)
                            .load(Uri.parse(Url.userImageUrl + userObj.getString("image")))
                            .placeholder(R.drawable.user_photo)
                            .transform(new CircleTransformation(FinishTripActivity.this))
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

                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        driverAllTripFeed.setIsUploadReview("0");
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
                }, 500);

            }
        });
        dialog.getBuilder().onPositive(new MaterialDialog.SingleButtonCallback() {
            @Override
            public void onClick(@NonNull MaterialDialog dialog, @NonNull DialogAction which) {
                if(review_rating.getRating()==0){
                    Log.e("Okayswiss","Please give rating"+review_rating.getRating());
                    Toast.makeText(FinishTripActivity.this,"Please give rating.", Toast.LENGTH_LONG).show();
                }else if(edt_reviews.getText().toString().equals("")){
                    Log.e("Okayswiss","Please enter views");
                    Toast.makeText(FinishTripActivity.this,"Please enter your feed back.", Toast.LENGTH_LONG).show();
                }else{
                    dialog.cancel();
                    uploadReviews(review_rating.getRating()+"",edt_reviews.getText().toString());
                    new Handler().postDelayed(new Runnable() {
                        @Override
                        public void run() {
                            driverAllTripFeed.setIsUploadReview("1");
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
                    }, 500);
                }

                Log.e("Okayswiss","rating :"+review_rating.getRating());
                Log.e("Okayswiss","rating :"+edt_reviews.getText().toString());

            }
        });
        dialog.show();
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
            emitobj.put("driver_status", "1");
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
                Common.socket=SocketSingleObject.get(FinishTripActivity.this).getSocket();
                Common.socket.connect();
                Common.socket.emit("Create Driver Data", emitobj);
            }

        } catch (JSONException e) {
            e.printStackTrace();
        }
    }


    public void uploadReviews(String rating,String feedback){
        try {
//        http://139.59.154.174/web_service/user_rate?user_id=60&driver_id=228&driver_comment=Nsw2§ice sdkfasajfdkjjk ksdsfj sfjksfjksjf kasf&user_rate=2.8
            Log.e("Upload Rating", Url.UploadReviewUrl + "?driver_id=" + userPref.getString("id", "") + "&user_id=" + uploadUserId + "&driver_comment=" + feedback + "&user_rate=" + rating+"&book_id="+driverAllTripFeed.getId());
            Ion.with(FinishTripActivity.this)
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

                                        Intent logInt = new Intent(FinishTripActivity.this, LoginActivity.class);
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
                                Common.ShowHttpErrorMessage(FinishTripActivity.this, error.getMessage());
                            }
                        }
                    });

        }catch (Exception e){
            e.printStackTrace();
        }
    }

}


