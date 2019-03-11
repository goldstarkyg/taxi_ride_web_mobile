package come.texi.user.adapter;

import android.app.Activity;
import android.content.SharedPreferences;
import android.graphics.Typeface;
import android.net.Uri;
import android.preference.PreferenceManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;

import come.texi.user.utils.CircleTransform;
import come.texi.user.utils.ReviewsData;

import come.texi.user.utils.SimpleRatingBar;
import come.texi.user.utils.Url;
import com.ocriders.appu.R;

/**
 * Created by techintegrity on 13/07/16.
 */
public class ReviewsAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> implements View.OnClickListener {

    Activity activity;
    ArrayList<ReviewsData> TripArray;
    private int itemsCount = 0;
    private static final int VIEW_TYPE_DEFAULT = 1;
    private static final int VIEW_TYPE_LOADER = 2;
    private boolean showLoadingView = false;

    Typeface OpenSans_Regular,OpenSans_Semi_Bold,OpenSans_Light;

    private OnAllTripClickListener onAllTripClickListener;
    SharedPreferences userPref;
    public ReviewsAdapter(Activity act, ArrayList<ReviewsData> trpArray){
        activity = act;
        TripArray = trpArray;
        userPref = PreferenceManager.getDefaultSharedPreferences(act);
        OpenSans_Regular = Typeface.createFromAsset(activity.getAssets(), "fonts/OpenSans-Regular_0.ttf");
        OpenSans_Semi_Bold = Typeface.createFromAsset(activity.getAssets(), "fonts/OpenSans-Semibold_0.ttf");
        OpenSans_Light = Typeface.createFromAsset(activity.getAssets(), "fonts/OpenSans-Light_0.ttf");
    }

    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(activity).inflate(R.layout.reviews_list_items, parent, false);
        AllTripViewHolder allTrpViewHol = new AllTripViewHolder(view);
        return allTrpViewHol;
    }

    @Override
    public void onBindViewHolder(RecyclerView.ViewHolder viewHolder, int position) {
        AllTripViewHolder holder = (AllTripViewHolder) viewHolder;
        if (getItemViewType(position) == VIEW_TYPE_DEFAULT) {
            bindCabDetailFeedItem(position, holder);
        } else if (getItemViewType(position) == VIEW_TYPE_LOADER) {
            bindLoadingFeedItem(holder);
        }
    }

    private void bindCabDetailFeedItem(final int position, final AllTripViewHolder holder) {

        final ReviewsData reviewsData = TripArray.get(position);

        //Driver Photo
        if(reviewsData.getDriver_image()!=null){
            Picasso.with(activity)
                    .load(Uri.parse(Url.DriverImageUrl+reviewsData.getDriver_image()))
                    .placeholder(R.drawable.avatar_placeholder)
                    .transform(new CircleTransform())
                    .into(holder.iv_driver_photo);
        }

        //Driver Name
        if(reviewsData.getDriver_name()!=null){
            holder.tv_driver_name.setText(reviewsData.getDriver_name());
            holder.tv_driver_name.setTypeface(OpenSans_Regular);
        }

        //Driver - Usercomments
        if(reviewsData.getDriver_user_comment()!=null){
            holder.tv_driver_user_comments.setText(reviewsData.getDriver_user_comment());
            holder.tv_driver_user_comments.setTypeface(OpenSans_Regular);
        }

        //Driver -Time
        if(reviewsData.getDriver_time()!=null){
            holder.tv_driver_time.setText(reviewsData.getDriver_time()+" ago");
            holder.tv_driver_time.setTypeface(OpenSans_Regular);
        }

        if(reviewsData.getDriver_rate()!=null){
            holder.properRatingbar.setRating(Float.parseFloat(reviewsData.getDriver_rate()));
        }


        Log.e("position", "position = " + position+"=="+getItemCount());
        if(getItemCount() > 9 && getItemCount() == position+1) {
            if (onAllTripClickListener != null)
                onAllTripClickListener.scrollToLoad(position);
        }
    }

    private void bindLoadingFeedItem(final AllTripViewHolder holder) {
        System.out.println("BindLoadingFeedItem >>>>>");
    }

    @Override
    public int getItemViewType(int position) {
        if (showLoadingView && position == 0) {
            return VIEW_TYPE_LOADER;
        } else {
            return VIEW_TYPE_DEFAULT;
        }
    }

    @Override
    public int getItemCount() {
        return TripArray.size();
    }

    public void updateItems() {
        itemsCount = TripArray.size();
        notifyDataSetChanged();
    }

    public void updateItemsFilter(ArrayList<ReviewsData> allTripArray) {
        TripArray = allTripArray;
        itemsCount = TripArray.size();
        notifyDataSetChanged();
    }

    @Override
    public void onClick(View v) {

        int viewId = v.getId();
        AllTripViewHolder holder = (AllTripViewHolder) v.getTag();

    }

    public class AllTripViewHolder extends RecyclerView.ViewHolder{

        ImageView iv_driver_photo;
        TextView tv_driver_name,tv_driver_user_comments,tv_driver_time;
        SimpleRatingBar properRatingbar;

        public AllTripViewHolder(View view) {
            super(view);

            iv_driver_photo=(ImageView)view.findViewById(R.id.iv_driver_photo);
            tv_driver_name=(TextView)view.findViewById(R.id.tv_driver_name);
            tv_driver_user_comments=(TextView)view.findViewById(R.id.tv_driver_user_comments);
            tv_driver_time=(TextView)view.findViewById(R.id.tv_driver_time);

            properRatingbar=(SimpleRatingBar)view.findViewById(R.id.properRatingbar);

        }
    }
    public void setOnAllTripItemClickListener(ReviewsAdapter.OnAllTripClickListener onAllTripClickListener) {
        this.onAllTripClickListener = onAllTripClickListener;
    }
    public interface OnAllTripClickListener {
        public void scrollToLoad(int position);
    }

}
