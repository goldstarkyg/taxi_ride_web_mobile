package come.texi.user.utils;

import com.google.android.gms.maps.model.LatLng;

import java.io.Serializable;
import java.util.ArrayList;

/**
 * Created by techintegrity on 13/07/16.
 */
public class ReviewsData implements Serializable {

    String driver_id;
    String driver_name;
    String driver_user_comment;
    String driver_rate;
    String driver_time;
    String driver_image;

    public String getDriver_id() {
        return driver_id;
    }

    public void setDriver_id(String driver_id) {
        this.driver_id = driver_id;
    }

    public String getDriver_name() {
        return driver_name;
    }

    public void setDriver_name(String driver_name) {
        this.driver_name = driver_name;
    }

    public String getDriver_user_comment() {
        return driver_user_comment;
    }

    public void setDriver_user_comment(String driver_user_comment) {
        this.driver_user_comment = driver_user_comment;
    }

    public String getDriver_rate() {
        return driver_rate;
    }

    public void setDriver_rate(String driver_rate) {
        this.driver_rate = driver_rate;
    }

    public String getDriver_time() {
        return driver_time;
    }

    public void setDriver_time(String driver_time) {
        this.driver_time = driver_time;
    }

    public String getDriver_image() {
        return driver_image;
    }

    public void setDriver_image(String driver_image) {
        this.driver_image = driver_image;
    }




}
