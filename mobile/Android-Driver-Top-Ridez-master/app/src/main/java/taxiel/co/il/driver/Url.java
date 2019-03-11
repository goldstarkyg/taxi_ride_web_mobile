package taxiel.co.il.driver;

/**
 * Created by techintegrity on 08/10/16.
 */
public class Url {

    public static String baseUrl = "http://132.148.66.112/web_service/";
    public static String driver_sign_up = baseUrl+"driver_sign_up";
    public static String driver_edit_profile = baseUrl+"driver_profile_edit";
    public static String driver_cartype_update="http://132.148.66.112:4040/updateDriverCarType?";
    public static String driver_login = baseUrl+"driver_login?";
    public static String driver_forgot_password = baseUrl+"driver_forgot_password?";
    public static String DriverTripUrl = baseUrl+"driver_bookings";
    public static String DriverAcceptTripUrl = baseUrl+"driver_accept_trip";
    public static String DriverRejectTripUrl = baseUrl+"driver_reject_trip";
    public static String DriverFilterTripUrl = baseUrl+"driver_filter_book";

    public static String DriverArrivedTripUrl = baseUrl+"driver_arrived_trip";
    public static String DriverOnTripUrl = baseUrl+"driver_on_trip";
    public static String DriverCompletedTripUrl = baseUrl+"driver_completed_trip";
    public static String DriverChangPasswordUrl = baseUrl+"driver_change_password";

    public static String driver_cartype = baseUrl+"car_type";
    public static String imageurl="http://132.148.66.112/cms/driverimages/";
    public static String userImageUrl = "http://132.148.66.112/cms/user_image/";

    public static String subscribeUrl = "http://132.148.66.112:8002/subscribe";
    public static String unsubscribeUrl = "http://132.148.66.112:8002/unsubscribe";

    public static String carImageUrl = "http://132.148.66.112/car_image/";
    public static String FacebookImgUrl = "https://graph.facebook.com/";

    public static String updateNodeStatus=baseUrl+"update_node_status";
    public static String ReviewsUrl=baseUrl+"get_user_rate";
    public static String MyReviewsUrl=baseUrl+"get_driver_rate";
    public static String UploadReviewUrl=baseUrl+"user_rate";
    public static String inviteUrl=baseUrl+"invite_contact";

    public static String cashout=baseUrl+"request_cashout";

}
