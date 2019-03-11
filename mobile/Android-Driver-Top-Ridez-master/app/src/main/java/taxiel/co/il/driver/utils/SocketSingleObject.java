package taxiel.co.il.driver.utils;

import android.content.Context;

import com.github.nkzawa.socketio.client.IO;
import com.github.nkzawa.socketio.client.Socket;

import java.net.URISyntaxException;

/**
 * Created by rupenmakhecha on 06/01/17.
 */

public class SocketSingleObject {

        public static SocketSingleObject instance;
        private static final String SERVER_ADDRESS = "http://132.148.66.112:4040";
        private Socket mSocket;
        private Context context;

        public SocketSingleObject(Context context) {
            this.context = context;
            this.mSocket = getServerSocket();
        }

        public static SocketSingleObject get(Context context){
            if(instance == null){
                instance = getSync(context);
            }
            instance.context = context;
            return instance;
        }

        private static synchronized SocketSingleObject getSync(Context context) {
            if(instance == null){
                instance = new SocketSingleObject(context);
            }
            return instance;
        }

        public Socket getSocket(){
            return this.mSocket;
        }

        public Socket getServerSocket() {
            try {
                IO.Options opts = new IO.Options();
                opts.forceNew = true;
                opts.reconnection = true;
                mSocket = IO.socket(SERVER_ADDRESS, opts);
                return mSocket;
            } catch (URISyntaxException e) {
                throw new RuntimeException(e);
            }
        }




}
