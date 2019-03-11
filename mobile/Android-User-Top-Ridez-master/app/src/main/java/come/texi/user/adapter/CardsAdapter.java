package come.texi.user.adapter;

/**
 * Created by techintegrity on 29/08/16.
 */
import android.app.Activity;
import android.graphics.Typeface;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.ocriders.appu.R;


public class CardsAdapter extends RecyclerView.Adapter<RecyclerView.ViewHolder> implements View.OnClickListener {

    Activity activity;
    JSONArray cardsArray;
    Typeface OpenSans_Regular;
    private static final int VIEW_TYPE_DEFAULT = 1;
    private static final int VIEW_TYPE_LOADER = 2;
    private boolean showLoadingView = false;

    private OnCardTypeClickListener onCardTypeClickListener;

    public CardsAdapter(Activity activity, JSONArray cardsArray){

        this.activity = activity;
        this.cardsArray = cardsArray;
        OpenSans_Regular = Typeface.createFromAsset(activity.getAssets(), "fonts/OpenSans-Regular_0.ttf");
    }

    @Override
    public RecyclerView.ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {

        View view = LayoutInflater.from(activity).inflate(R.layout.cards_list_items, parent, false);
        CarTypeViewHolder carTypeViewHolder = new CarTypeViewHolder(view);
        carTypeViewHolder.card_view.setOnClickListener(this);
        carTypeViewHolder.iv_delete_card.setOnClickListener(this);
        return carTypeViewHolder;
    }

    @Override
    public void onBindViewHolder(RecyclerView.ViewHolder viewHolder, int position) {
        CarTypeViewHolder holder = (CarTypeViewHolder) viewHolder;
        if (getItemViewType(position) == VIEW_TYPE_DEFAULT) {
            bindCarTypeFeedItem(position, holder);
        } else if (getItemViewType(position) == VIEW_TYPE_LOADER) {
            bindLoadingFeedItem(holder);
        }
    }

    private void bindCarTypeFeedItem(int position, CarTypeViewHolder holder) {
        try {
            JSONObject jsonObject = cardsArray.getJSONObject(position);
            if(jsonObject.has("cardtype") && !jsonObject.getString("cardtype").equals(""))
            holder.mNonceString.setText(jsonObject.getString("cardtype"));

            if(jsonObject.has("cardimage") && !jsonObject.getString("cardimage").equals(""))
            holder.mNonceIcon.setImageResource(jsonObject.getInt("cardimage"));

            if(jsonObject.has("lastdigits") && !jsonObject.getString("lastdigits").equals(""))
            holder.nonce_details.setText("ending in " + jsonObject.getString("lastdigits"));

            if(jsonObject.has("is_selected") && jsonObject.getBoolean("is_selected")){
                holder.iv_selected_card.setVisibility(View.VISIBLE);
            }else{
                holder.iv_selected_card.setVisibility(View.GONE);
            }

            holder.iv_delete_card.setTag(holder);
            holder.card_view.setTag(holder);

        } catch (JSONException e) {
            e.printStackTrace();
        }

    }


    private void bindLoadingFeedItem(CarTypeViewHolder holder) {
        System.out.println("BindLoadingFeedItem >>>>>");
    }

    @Override
    public int getItemCount() {
        return cardsArray.length();
    }

    @Override
    public void onClick(View view) {
        int viewId = view.getId();
        CarTypeViewHolder holder = (CarTypeViewHolder) view.getTag();
        if(viewId == R.id.card_view){
            if(onCardTypeClickListener != null)
                onCardTypeClickListener.SelectCardType(holder.getPosition());
        }else if(viewId == R.id.iv_delete_card){
            if(onCardTypeClickListener != null){
                try {
                JSONObject jsonObject = cardsArray.getJSONObject(holder.getPosition());
                onCardTypeClickListener.deleteCard(holder.getAdapterPosition(),"***"+jsonObject.getString("lastdigits"));
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }
    }

    public void updateItems() {
        notifyDataSetChanged();
    }

    public void removeItemsCard(int position,JSONArray array){
        notifyItemRemoved(position);
        cardsArray=array;
        notifyDataSetChanged();
    }

    @Override
    public int getItemViewType(int position) {
        if (showLoadingView && position == 0) {
            return VIEW_TYPE_LOADER;
        } else {
            return VIEW_TYPE_DEFAULT;
        }
    }

    public class CarTypeViewHolder extends RecyclerView.ViewHolder {

        private CardView card_view;
        private ImageView mNonceIcon;
        private TextView mNonceString;
        private TextView nonce_details;
        private ImageView iv_selected_card;
        private ImageView iv_delete_card;
        public CarTypeViewHolder(View view) {
            super(view);
            card_view = (CardView)view.findViewById(R.id.card_view);
            mNonceIcon = (ImageView)view.findViewById(R.id.nonce_icon);
            mNonceString = (TextView)view.findViewById(R.id.nonce);
            nonce_details =(TextView)view.findViewById(R.id.nonce_details);
            iv_selected_card = (ImageView)view.findViewById(R.id.iv_selected_card);
            iv_delete_card=(ImageView)view.findViewById(R.id.iv_delete_card);
        }
    }

    public void setOnCardTypeItemClickListener(OnCardTypeClickListener onCardTypeClickListener) {
        this.onCardTypeClickListener = onCardTypeClickListener;
    }

    public interface OnCardTypeClickListener {
        public void SelectCardType(int position);
        public void deleteCard(int position,String cardno);
    }
}

