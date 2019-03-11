package come.texi.user.utils;

import android.app.Application;
import android.content.Context;
import android.content.SharedPreferences;
import android.preference.PreferenceManager;
import android.support.multidex.MultiDex;
import android.util.Log;

import com.twitter.sdk.android.Twitter;
import com.twitter.sdk.android.core.TwitterAuthConfig;

import io.fabric.sdk.android.Fabric;

/**
 * Created by techintegrity on 08/07/16.
 */
public class TwitterApplication extends Application {

    @Override
    public void onCreate() {

        super.onCreate();
        MultiDex.install(this);
        TwitterAuthConfig authConfig =  new TwitterAuthConfig("0dafbb2yIUgaXPNNF7kUesHdK", "MVF4pS6y4VJp9CKiJySFjkoCKYoOVgEOGLL8dvINEQyV5LVj9A");
        Log.d("authConfig","authConfig = "+authConfig);
        //Fabric.with(this, new Twitter(authConfig));
        Fabric.with(this, new Twitter(authConfig));
    }

    private static SharedPreferences sSharedPreferences;

    public static SharedPreferences getPreferences(Context context) {
        if (sSharedPreferences == null) {
            sSharedPreferences = PreferenceManager.getDefaultSharedPreferences(context.getApplicationContext());
        }

        return sSharedPreferences;
    }

    public static void setBrainTreeClientToken(Context context,String clientToken) {
        getPreferences(context).edit().putString("braintree_client_token",clientToken).apply();
    }
    public static String getBrainTreeClientToken(Context context) {
        return getPreferences(context).getString("braintree_client_token", null);
    }

}
