package come.texi.user.utils;

import android.app.Dialog;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.telephony.SmsMessage;
import android.util.Log;
import android.widget.Toast;

import com.victor.loading.rotate.RotateLoading;

import come.texi.user.OneTimePasswordActivity;
import come.texi.user.SignUpActivity;
import com.ocriders.appu.R;

/**
 * Created by techintegrity on 19/12/16.
 */
public class SmsBroadcastReceiver extends BroadcastReceiver {

    public static final String SMS_BUNDLE = "pdus";

    @Override
    public void onReceive(Context context, Intent intent) {
        Bundle intentExtras = intent.getExtras();
        if (intentExtras != null) {
            Object[] sms = (Object[]) intentExtras.get(SMS_BUNDLE);
            String smsMessageStr = "";
            for (int i = 0; i < sms.length; ++i) {
                SmsMessage smsMessage = SmsMessage.createFromPdu((byte[]) sms[i]);
                String smsBody = smsMessage.getMessageBody().toString();
                String address = smsMessage.getOriginatingAddress();
                //smsMessageStr += "SMS From: " + address + "\n";
                if(smsBody.contains("Your OC Riders")) {
                    String[] separated = smsBody.split("\\:");
                    smsMessageStr = separated[1].replace(" ","");
                }
                Log.e("smsMessageStr","smsMessageStr = "+smsMessageStr);
            }
            //Toast.makeText(context, smsMessageStr, Toast.LENGTH_SHORT).show();

            //this will update the UI with message
            if(!smsMessageStr.equals("")) {
                OneTimePasswordActivity inst = OneTimePasswordActivity.instance();
                inst.updateList(smsMessageStr,inst);
            }
        }
    }
}
