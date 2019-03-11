package come.texi.user;

import android.app.DatePickerDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.ContextWrapper;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Matrix;
import android.graphics.Typeface;
import android.media.ExifInterface;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Environment;
import android.os.Handler;
import android.preference.PreferenceManager;
import android.provider.MediaStore;
import android.support.v4.content.FileProvider;
import android.support.v7.app.AppCompatActivity;
import android.text.InputType;
import android.text.TextUtils;
import android.util.Log;
import android.view.Gravity;
import android.view.MotionEvent;
import android.view.View;
import android.view.ViewGroup;
import android.view.WindowManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.TextView;

import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;
import com.koushikdutta.ion.builder.Builders;
import com.ocriders.appu.BuildConfig;
import com.squareup.picasso.Picasso;
import com.victor.loading.rotate.RotateLoading;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.File;
import java.io.FileOutputStream;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Calendar;
import java.util.Date;
import java.util.List;
import java.util.Locale;
import come.texi.user.utils.CircleTransform;
import come.texi.user.utils.Common;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

import static come.texi.user.utils.Common.showMKPanelError;

public class UserProfileActivity extends AppCompatActivity {

    TextView txt_profile;
    TextView txt_name;
    EditText edt_name;
    //TextView txt_user_name;
   // EditText edt_user_name;
    TextView txt_user_mobile;
    EditText edt_mobile;
    TextView txt_user_email;
    EditText edt_email;
    RelativeLayout layout_back_arrow;
    ImageView img_add_image;
    //TextView txt_date_of_birth;
    //EditText edt_date_of_birth_val;
   // Spinner spinner_gender;
    RelativeLayout layout_save;
    TextView txt_save;



    Typeface OpenSans_Regular,OpenSans_Bold,Roboto_Regular,Roboto_Medium,Roboto_Bold;
    SharedPreferences userPref;

    Dialog ProgressDialog;
    RotateLoading cusRotateLoading;

    Dialog OpenCameraDialog;
    private Uri mCapturedImageURI;
    public static int REQUEST_CAMERA = 1;
    public static int REQUEST_GALLERY = 2;
    File userImage;

   // Calendar myCalendar;
   // DatePickerDialog.OnDateSetListener date;

    //Error Alert
    RelativeLayout rlMainView;
    TextView tvTitle;
    String genderString;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_profile);

        genderString = getResources().getString(R.string.gender);

        getWindow().setBackgroundDrawableResource(R.drawable.background);

        //Error Alert
        rlMainView=(RelativeLayout)findViewById(R.id.rlMainView);
        tvTitle=(TextView)findViewById(R.id.tvTitle);

        RelativeLayout.LayoutParams params = new RelativeLayout.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
        params.setMargins(0, (int) getResources().getDimension(R.dimen.height_50), 0, 0);
        rlMainView.setLayoutParams(params);

        txt_profile = (TextView)findViewById(R.id.txt_profile);
        txt_name = (TextView)findViewById(R.id.txt_name);
        edt_name = (EditText)findViewById(R.id.edt_name);
        //txt_user_name = (TextView)findViewById(R.id.txt_user_name);
        //edt_user_name = (EditText)findViewById(R.id.edt_user_name);
        txt_user_mobile = (TextView)findViewById(R.id.txt_user_mobile);
        edt_mobile = (EditText)findViewById(R.id.edt_mobile);
        txt_user_email = (TextView)findViewById(R.id.txt_user_email);
        edt_email = (EditText)findViewById(R.id.edt_email);
        layout_back_arrow = (RelativeLayout)findViewById(R.id.layout_back_arrow);
        img_add_image = (ImageView)findViewById(R.id.img_add_image);
       // txt_date_of_birth = (TextView)findViewById(R.id.txt_date_of_birth);
       // edt_date_of_birth_val = (EditText)findViewById(R.id.edt_date_of_birth_val);
       // spinner_gender = (Spinner)findViewById(R.id.spinner_gender);
        layout_save = (RelativeLayout)findViewById(R.id.layout_save);
        txt_save = (TextView)findViewById(R.id.txt_save);

        ProgressDialog = new Dialog(UserProfileActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
        ProgressDialog.setContentView(R.layout.custom_progress_dialog);
        ProgressDialog.setCancelable(false);
        cusRotateLoading = (RotateLoading)ProgressDialog.findViewById(R.id.rotateloading_register);

        userPref = PreferenceManager.getDefaultSharedPreferences(UserProfileActivity.this);

        OpenSans_Regular = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Regular_0.ttf");
        OpenSans_Bold = Typeface.createFromAsset(getAssets(), "fonts/OpenSans-Bold_0.ttf");
        Roboto_Regular = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Regular.ttf");
        Roboto_Medium = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Medium.ttf");
        Roboto_Bold = Typeface.createFromAsset(getAssets(), "fonts/Roboto-Bold.ttf");

        txt_profile.setTypeface(OpenSans_Bold);
        txt_save.setTypeface(Roboto_Regular);

        txt_name.setTypeface(Roboto_Regular);
        edt_name.setTypeface(Roboto_Regular);
        //txt_user_name.setTypeface(Roboto_Regular);
        //edt_user_name.setTypeface(Roboto_Regular);
        txt_user_mobile.setTypeface(Roboto_Regular);
        edt_mobile.setTypeface(Roboto_Regular);
        txt_user_email.setTypeface(Roboto_Regular);

        //edt_date_of_birth_val.setTypeface(Roboto_Regular);
        //txt_date_of_birth.setTypeface(Roboto_Regular);

        edt_email.setTypeface(Roboto_Regular);

       // edt_user_name.setText(userPref.getString("username", ""));
        edt_name.setText(userPref.getString("name", ""));
        edt_mobile.setText(userPref.getString("mobile", ""));
        edt_email.setText(userPref.getString("email", ""));
        //edt_date_of_birth_val.setText(userPref.getString("date_of_birth", ""));

        this.getWindow().setSoftInputMode(
                WindowManager.LayoutParams.SOFT_INPUT_STATE_ALWAYS_HIDDEN);

        String facebook_id = userPref.getString("facebook_id","");
        Log.d("facebook_id","facebook_id = "+facebook_id);
        if(facebook_id != null && !facebook_id.equals("") && userPref.getString("userImage", "").equals("")) {
            String facebookImage = Url.FacebookImgUrl + facebook_id + "/picture?type=large";
            Log.d("facebookImage","facebookImage = "+facebookImage);
            Picasso.with(UserProfileActivity.this)
                    .load(facebookImage)
                    .placeholder(R.drawable.avatar_placeholder)
                    .resize(200, 200)
                    .transform(new  CircleTransform())
                    .into(img_add_image);
        }else {
            Picasso.with(UserProfileActivity.this)
                    .load(Uri.parse(Url.userImageUrl + userPref.getString("userImage", "")))
                    .placeholder(R.drawable.mail_defoult)
                    .transform(new CircleTransform())
                    .into(img_add_image);
        }

        layout_save.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                if (edt_name.getText().toString().trim().length() == 0) {
                    showMKPanelError(UserProfileActivity.this, getResources().getString(R.string.please_enter_name),rlMainView,tvTitle,Roboto_Regular);
                    edt_name.requestFocus();
                    return;
                }
//                else if (edt_user_name.getText().toString().trim().length() == 0) {
//                    showMKPanelError(UserProfileActivity.this, getResources().getString(R.string.please_enter_username),rlMainView,tvTitle,Roboto_Regular);
//                    edt_user_name.requestFocus();
//                    return;
//                }
                else if (edt_mobile.getText().toString().trim().length() == 0) {
                    showMKPanelError(UserProfileActivity.this, getResources().getString(R.string.please_enter_mobile),rlMainView,tvTitle,Roboto_Regular);
                    edt_mobile.requestFocus();
                    return;
                } else if (edt_email.getText().toString().trim().length() == 0) {
                    showMKPanelError(UserProfileActivity.this, getResources().getString(R.string.please_enter_email),rlMainView,tvTitle,Roboto_Regular);
                    edt_email.requestFocus();
                    return;
                } else if (edt_email.getText().toString().trim().length() != 0 && !isValidEmail(edt_email.getText().toString().trim())) {
                    showMKPanelError(UserProfileActivity.this, getResources().getString(R.string.please_enter_valid_email),rlMainView,tvTitle,Roboto_Regular);
                    edt_email.requestFocus();
                    return;
                }

                ProgressDialog.show();
                cusRotateLoading.start();

                Log.d("user id","user id = "+userPref.getString("id", ""));
                Builders.Any.B IonObj = Ion.with(UserProfileActivity.this)
                        .load(Url.profileUrl)
                        .setTimeout(60*60*1000);

                //.setJsonObjectBody(json)
                IonObj.setMultipartParameter("name", edt_name.getText().toString().trim())
                .setMultipartParameter("username", edt_email.getText().toString().trim())
                .setMultipartParameter("email", edt_email.getText().toString().trim())
                .setMultipartParameter("mobile", edt_mobile.getText().toString().trim())
                .setMultipartParameter("uid", userPref.getString("id", ""))
                .setMultipartParameter("dob", "")
                .setMultipartParameter("gender", genderString);
                Log.d("userImage","UserProfile userImage = "+userImage);
                if(userImage != null) {
                    IonObj.setMultipartFile("image", userImage);
                }else
                    IonObj.setMultipartParameter("image", "");

                IonObj.setMultipartParameter("isdevice", "1")
                .asJsonObject()
                .setCallback(new FutureCallback<JsonObject>() {
                    @Override
                    public void onCompleted(Exception error, JsonObject result) {
                        // do stuff with the result or error
                        Log.e("UserProfile", "UserProfile = " + result + "==" + error);
                        ProgressDialog.cancel();
                        cusRotateLoading.stop();
                        if (error == null) {
                            try {
                                JSONObject resObj = new JSONObject(result.toString());
                                if (resObj.getString("status").equals("success")) {

                                    JSONArray userAry = new JSONArray(resObj.getString("user_detail"));
                                    JSONObject userDetilObj = userAry.getJSONObject(0);

                                    SharedPreferences.Editor id = userPref.edit();
                                    id.putString("id", userDetilObj.getString("id").toString());
                                    id.commit();

                                    SharedPreferences.Editor name = userPref.edit();
                                    name.putString("name", userDetilObj.getString("name").toString());
                                    name.commit();

                                    SharedPreferences.Editor username = userPref.edit();
                                    username.putString("username", userDetilObj.getString("username").toString());
                                    username.commit();

                                    SharedPreferences.Editor mobile = userPref.edit();
                                    mobile.putString("mobile", userDetilObj.getString("mobile").toString());
                                    mobile.commit();

                                    SharedPreferences.Editor email = userPref.edit();
                                    email.putString("email", userDetilObj.getString("email").toString());
                                    email.commit();

                                    SharedPreferences.Editor isLogin = userPref.edit();
                                    isLogin.putString("isLogin", "1");
                                    isLogin.commit();

                                    SharedPreferences.Editor userImage = userPref.edit();
                                    userImage.putString("userImage", userDetilObj.getString("image").toString());
                                    userImage.commit();

                                    SharedPreferences.Editor dob = userPref.edit();
                                    dob.putString("date_of_birth", userDetilObj.getString("dob").toString());
                                    dob.commit();

                                    SharedPreferences.Editor gender = userPref.edit();
                                    gender.putString("gender", genderString);
                                    gender.commit();

                                    ProgressDialog.cancel();
                                    cusRotateLoading.stop();

                                    Common.showMkSucess(UserProfileActivity.this, getResources().getString(R.string.profile_update_sucess),"yes");

                                    new Handler().postDelayed(new Runnable() {
                                        @Override
                                        public void run() {
                                            finish();
                                        }
                                    }, 2000);

                                } else if (resObj.getString("status").equals("false")) {
                                    Common.user_InActive = 1;
                                    Common.InActive_msg = resObj.getString("message");

                                    SharedPreferences.Editor editor = userPref.edit();
                                    editor.clear();
                                    editor.commit();

                                    Intent logInt = new Intent(UserProfileActivity.this, LoginOptionActivity.class);
                                    logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TOP);
                                    logInt.addFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                    logInt.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                                    startActivity(logInt);
                                }else if(resObj.getString("status").equals("failed")){
                                    Common.showMkError(UserProfileActivity.this, resObj.getString("error code"));
                                }
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }

                        } else {
                            Common.ShowHttpErrorMessage(UserProfileActivity.this, error.getMessage());
                        }
                    }
                });
            }
        });

        layout_back_arrow.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish();
            }
        });

        img_add_image.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                OpenCameraDialog = new Dialog(UserProfileActivity.this, android.R.style.Theme_Translucent_NoTitleBar);
                OpenCameraDialog.setContentView(R.layout.camera_dialog_layout);

                RelativeLayout layout_open_camera = (RelativeLayout) OpenCameraDialog.findViewById(R.id.layout_open_camera);
                layout_open_camera.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        OpenCameraDialog.cancel();
                        Intent ci = new Intent(MediaStore.ACTION_IMAGE_CAPTURE);
                        mCapturedImageURI = getImageUri();
                        ci.putExtra(MediaStore.EXTRA_OUTPUT, mCapturedImageURI);
                        ci.addFlags(Intent.FLAG_GRANT_READ_URI_PERMISSION | Intent.FLAG_GRANT_WRITE_URI_PERMISSION);
                        startActivityForResult(ci, REQUEST_CAMERA);
                    }
                });

                RelativeLayout layout_open_gallery = (RelativeLayout) OpenCameraDialog.findViewById(R.id.layout_open_gallery);
                layout_open_gallery.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        OpenCameraDialog.cancel();
                        Intent gi = new Intent(Intent.ACTION_PICK);
                        gi.setType("image/*");
                        startActivityForResult(gi, REQUEST_GALLERY);
                    }
                });

                RelativeLayout layout_open_cancel = (RelativeLayout) OpenCameraDialog.findViewById(R.id.layout_open_cancel);
                layout_open_cancel.setOnClickListener(new View.OnClickListener() {
                    @Override
                    public void onClick(View v) {
                        OpenCameraDialog.cancel();
                    }
                });

                OpenCameraDialog.show();
            }
        });

        List<String> list = new ArrayList<String>();
        list.add(getResources().getString(R.string.gender));
        list.add(getResources().getString(R.string.male));
        list.add(getResources().getString(R.string.female));

        ArrayAdapter<String> dataAdapter = new ArrayAdapter<String>(this,
                android.R.layout.simple_spinner_item, list);
        dataAdapter.setDropDownViewResource(R.layout.gender_spinner_layout);

        Common.ValidationGone(UserProfileActivity.this,rlMainView,edt_name);
        Common.ValidationGone(UserProfileActivity.this,rlMainView,edt_mobile);
        Common.ValidationGone(UserProfileActivity.this,rlMainView,edt_email);


    }

    public Uri getImageUri(){

        File file1 = new File(Environment.getExternalStorageDirectory() + "/Taxiel");
        if (!file1.exists())
        {
            file1.mkdirs();
        }
        File file2 = new File(Environment.getExternalStorageDirectory() + "/Taxiel/UserImage");
        if (!file2.exists())
        {
            file2.mkdirs();
        }
        File file = new File(Environment.getExternalStorageDirectory() + "/Taxiel/UserImage/"+System.currentTimeMillis()+".jpg");
        Uri imgUri = Uri.fromFile(file);

        if(Build.VERSION.SDK_INT > Build.VERSION_CODES.M) {
            Uri photoURI = FileProvider.getUriForFile(UserProfileActivity.this, BuildConfig.APPLICATION_ID+".provider",file);
            Log.e("UserApp","Photo URI :"+photoURI.getPath());
            return photoURI;
        }else{
            return imgUri;
        }

    }

    public final static boolean isValidEmail(CharSequence target) {
        return !TextUtils.isEmpty(target) && android.util.Patterns.EMAIL_ADDRESS.matcher(target).matches();
    }

    @Override
    public void onDestroy() {
        super.onDestroy();

        txt_profile = null;
       // txt_user_name = null;
       // edt_user_name = null;
        txt_user_mobile = null;
        edt_mobile = null;
        txt_user_email = null;
        edt_email = null;
        layout_save = null;
        txt_save = null;
        layout_back_arrow = null;
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {

        Log.d("requestCode = ","requestCode = "+requestCode+"=="+resultCode+"=="+data);
        if(requestCode == REQUEST_CAMERA){
            CreateUserImage(mCapturedImageURI);
        }else if(requestCode == REQUEST_GALLERY){
            if(data != null){
                String selImagePath = getPath(data.getData());
                mCapturedImageURI=Uri.parse(selImagePath);
                CreateUserImage(mCapturedImageURI);
            }
        }
    }

    public String getPath(Uri uri) {
        String[] projection = { MediaStore.MediaColumns.DATA };
        Cursor cursor = getContentResolver().query(uri, projection, null, null, null);
        if (cursor != null) {
            int column_index = cursor.getColumnIndexOrThrow(MediaStore.MediaColumns.DATA);
            cursor.moveToFirst();
            return cursor.getString(column_index);
        } else
            return null;
    }

    public void CreateUserImage(Uri imagePath)
    {
        try{

            String filePath=imagePath.getPath();
            if (Build.VERSION.SDK_INT > Build.VERSION_CODES.M) {
                if(filePath.contains("/external_files/")) {
                    filePath = Environment.getExternalStorageDirectory() + filePath.replace("/external_files", "");
                }
            }
            File file = new File(filePath);

            ExifInterface exif = new ExifInterface(file.getPath());
            String orientString = exif.getAttribute(ExifInterface.TAG_ORIENTATION);
            int orientation = orientString != null ? Integer.parseInt(orientString) : ExifInterface.ORIENTATION_NORMAL;
            int rotationAngle = 0;
            if (orientation == ExifInterface.ORIENTATION_ROTATE_90) rotationAngle = 90;
            if (orientation == ExifInterface.ORIENTATION_ROTATE_180) rotationAngle = 180;
            if (orientation == ExifInterface.ORIENTATION_ROTATE_270) rotationAngle = 270;

            Bitmap bitmap = resizeBitMapImage1(filePath, Common.photoSize, Common.photoSize);
            Bitmap RotateBitmap = RotateBitmap(bitmap,rotationAngle);
            SimpleDateFormat sdf = new SimpleDateFormat("yyyyMMdd_HHmmss");
            String currentDateandTime = sdf.format(new Date());
            String myFinalImagePath = saveToInternalSorage(RotateBitmap, currentDateandTime);
            Log.d("imagePath1","imagePath1 = "+myFinalImagePath);

            userImage = new File(myFinalImagePath);
            Picasso.with(UserProfileActivity.this).load(userImage).transform(new CircleTransform()).into(img_add_image);

        }
        catch(Exception es)
        {	es.printStackTrace();
            System.out.println("==== exceptin in setimage : "+es);
        }
    }

    public static Bitmap resizeBitMapImage1(String filePath, int targetWidth, int targetHeight) {
        Bitmap bitMapImage = null;
        try {
            BitmapFactory.Options options = new BitmapFactory.Options();
            options.inJustDecodeBounds = true;
            BitmapFactory.decodeFile(filePath, options);
            double sampleSize = 0;
            Boolean scaleByHeight = Math.abs(options.outHeight - targetHeight) >= Math.abs(options.outWidth
                    - targetWidth);
            if (options.outHeight * options.outWidth * 2 >= 1638) {
                sampleSize = scaleByHeight ? options.outHeight / targetHeight : options.outWidth / targetWidth;
                sampleSize = (int) Math.pow(2d, Math.floor(Math.log(sampleSize) / Math.log(2d)));
            }
            options.inJustDecodeBounds = false;
            options.inTempStorage = new byte[128];
            while (true) {
                try {
                    options.inSampleSize = (int) sampleSize;
                    bitMapImage = BitmapFactory.decodeFile(filePath, options);
                    break;
                } catch (Exception ex) {
                    try {
                        sampleSize = sampleSize * 2;
                    } catch (Exception ex1) {

                    }
                }
            }
        } catch (Exception ex) {

        }
        return bitMapImage;
    }

    private String saveToInternalSorage(Bitmap bitmapImage,String imageName){
        ContextWrapper cw = new ContextWrapper(getApplicationContext());
        // path to /data/data/yourapp/app_data/imageDir
        File directory = cw.getDir("imageDir", Context.MODE_PRIVATE);
        Log.d("imagePath2","imagePath2 = "+directory);
        // Create imageDir
        File mypath=new File(directory,imageName+".jpg");
        FileOutputStream fos = null;
        try {
            fos = new FileOutputStream(mypath);
            // Use the compress method on the BitMap object to write image to the OutputStream
            bitmapImage.compress(Bitmap.CompressFormat.JPEG, 100, fos);
            fos.close();
        } catch (Exception e) {
            e.printStackTrace();
        }
        return directory.getAbsolutePath()+"/"+imageName+".jpg";
    }

    public static Bitmap RotateBitmap(Bitmap source, float angle)
    {
        Matrix matrix = new Matrix();
        matrix.postRotate(angle);
        return Bitmap.createBitmap(source, 0, 0, source.getWidth(), source.getHeight(), matrix, true);
    }
}
