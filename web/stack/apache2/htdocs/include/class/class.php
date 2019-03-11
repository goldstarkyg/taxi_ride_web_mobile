<?php
class okswissweb
{
    public function get_cartype($dataArr)
    {
        $post_data=array_decode($dataArr);
        if(isset($post_data['cab_id']))
        {
            $rs=sel_rec(cabdetails,"*","cab_id=".$post_data['cab_id']);
        }
        else
        {
            $rs=sel_rec(cabdetails);
        }
        $cab_id=array();
        $cartype=array();
        $car_rate=array();
        $intialkm=array();
        $fromintailrate=array();
        $night_intailrate=array();
        $night_fromintailrate=array();
        $icon=array();
        $seat_capacity=array();
        while($row=mysql_fetch_assoc($rs))
        {
            $cab_id[]=array("cab_id"=>$row['cab_id']);
            $cartype[]=array("cartype"=>$row['cartype']);
            $car_rate[]=array("car_rate"=>$row['car_rate']);
            $intialkm[]=array("intialkm"=>$row['intialkm']);
            $fromintailrate[]=array("fromintailrate"=>$row['fromintailrate']);
            $night_intailrate[]=array("night_intailrate"=>$row['night_intailrate']);
            $night_fromintailrate[]=array("night_fromintailrate"=>$row['night_fromintailrate']);
            $icon[]=array("icon"=>$row['icon']);
            $seat_capacity[]=array("seat_capacity"=>$row['seat_capacity']);
        }
        if($rs)
        {
            return '{"success":' . json_encode("true") .',"message":"Sucessfullye Fetch CarType","data":'.json_encode(array("cab_id"=>$cab_id,"cartype"=>$cartype,"car_rate"=>$car_rate,"intialkm"=>$intialkm,"fromintailrate"=>$fromintailrate,"night_intailrate"=>$night_intailrate,"night_fromintailrate"=>$night_fromintailrate,"icon"=>$icon,"seat_capacity"=>$seat_capacity)).'}';
        }
        else
        {
             return '{"success":' . json_encode("false") .',"message":"Not Sucessfullye Fetch CarType"}';
        }       
    }
    public function webuser_chkmobile($dataArr)
    {
        $post_data=array_decode($dataArr);
        $rs=sel_rec(userdetails,"*","mobile='".$post_data['mobile']."'");
        if($rs)
        {
            $row=mysql_fetch_assoc($rs);
            $id=$row['id'];
            $username=$row['username'];
            return '{"success":'.json_encode("true").',"id":' . json_encode($id) .',"username":' . json_encode($username) . ',"message":"Success"}';
        }
        else
        {
            return '{"message":"Not Success","success":' . json_encode('false') . '}';
        }
    }
     public function get_timedetails($dataArr)
    {
        $post_data=array_decode($dataArr);
        $rs=sel_rec(time_detail,"*");
        if($rs)
        {
            $row=mysql_fetch_assoc($rs);
            $day_start_time=$row['day_start_time'];
            $day_end_time=$row['day_end_time'];
            return '{"message":"Success","day_start_time":' . json_encode($day_start_time) .',"day_end_time":' . json_encode($day_end_time) . ',"success":' . json_encode("true") . '}';
        }
        else
        {
            return '{"message":"Not Success","success":' . json_encode('false') . '}';
        }
    }
    public function add_userdetails($dataArr)
    {
        $post_data=array_decode($dataArr);
        if(ins_rec(userdetails,$post_data))
        {
            return '{"message":"Success","data":' . json_encode($post_data) . ',"success":' . json_encode("true") . '}';
        }
        else
        {
            return '{"message":"Not Success","success":' . json_encode('false') . '}';
        }
    }
    public function add_booking($dataArr)
    {
        $post_data=array_decode($dataArr);
        if(ins_rec(bookingdetails,$post_data))
        {
            return '{"message":"Success","data":' . json_encode($post_data) . ',"success":' . json_encode("true") . '}';
        }
        else
        {
            return '{"message":"Not Success","success":' . json_encode('false') . '}';
        }
    }
}