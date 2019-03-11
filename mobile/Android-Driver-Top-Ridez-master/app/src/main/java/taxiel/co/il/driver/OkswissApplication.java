package taxiel.co.il.driver;

import android.app.Activity;
import android.app.Application;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.widget.Toast;

import com.google.gson.JsonObject;
import com.koushikdutta.async.future.FutureCallback;
import com.koushikdutta.ion.Ion;

import com.ocriders.appd.R;
import taxiel.co.il.driver.utils.Common;
import taxiel.co.il.driver.utils.SocketSingleObject;

/**
 * Created by techintegrity on 08/07/16.
 */
public class OkswissApplication extends Application{

    public static SharedPreferences userPref;

    @Override
    public void onCreate() {
        super.onCreate();
        userPref = PreferenceManager.getDefaultSharedPreferences(this);
    }
    public static void isOnline() {
        activityVisible=true;
    }
    public static void isOffline() {
        activityVisible=false;
    }

    public static void activityResumed(Activity activity) {
        if(userPref.getBoolean("is_login",false) && activityVisible) {

            if(Common.socket!=null && !Common.socket.connected()){
                Common.socket.emit("New Driver Register",userPref.getString("id", ""));
            }

            String updateNodeStatus = Url.updateNodeStatus + "?driver_id=" + userPref.getString("id", "");
            System.out.println("Update Node Status >>>"+updateNodeStatus+" and Switch On >>"+Common.CustomSocketOn);
            Ion.with(activity)
            .load(updateNodeStatus)
            .asJsonObject()
            .setCallback(new FutureCallback<JsonObject>() {
                @Override
                public void onCompleted(Exception e, JsonObject result) {
                    // do stuff with the result or error

                    if (e != null) {
                        return;
                    }

                    try{
                        System.out.println("Upadate Node Status Response >>"+result.toString());
                    }catch (Exception e1){
                        e1.printStackTrace();
                    }
                }

            });

        }

    }


    private static boolean activityVisible;


}
