<?php
include ('language.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Booking Details - <?php echo $header_title; ?></title>

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/bootstrap/bootstrap.min.css" />

    <!-- RTL support - for demo only -->
    <script src="<?php echo base_url();?>application/views/js/demo-rtl.js"></script>
    <!--
    If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
    And add "rtl" class to <body> element - e.g. <body class="rtl">
    -->

    <!-- libraries -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/nanoscroller.css" />

    <!-- global styles -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/compiled/theme_styles.css" />

    <!-- this page specific styles -->
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/libs/daterangepicker.css" type="text/css" />

    <!-- Favicon -->
    <link type="image/x-icon" href="<?php echo base_url();?>upload/favicon.png" rel="shortcut icon" />

    <!-- google font libraries -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <!--<link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>-->
    <link href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">.modal-open .modal{ background:url(<?php echo base_url();?>application/views/img/transpharant.png) top left repeat;}</style>
<style>
    .goog-te-banner-frame.skiptranslate {
      display: none !important;
    }
    body {
      top: 0px !important;
    }
          .goog-logo-link
           {
               display: none !important;
            }


  </style>
  <!-loader ->
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/main.css">
    <script src="<?php echo base_url();?>application/views/js/vendor/modernizr-2.6.2.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>application/views/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>application/views/js/main.js"></script>
    <!-- end loader-->
</head>
<body>
<div class="cover"></div>
<div id="theme-wrapper">
    <?php
    include"includes/admin_header.php";
    ?>
    <div id="page-wrapper" class="container">
        <div class="row">
            <?php
            include"includes/admin_sidebar.php";
            ?>
            <div id="content-wrapper">
                <div class="row" style="opacity: 1;">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="content-header" class="clearfix">
                                    <div class="pull-left">
                                        <h1><?php echo $Booking_Details_lng; ?></h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#"><?php echo $Home_lng; ?></a></li>
                                            <li class="active"><span><?php echo $Booking_Details_lng; ?></span></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <div class="panel" style="margin-bottom:0px;">
                                        <div class="panel-body">
                                            <h2><?php echo $Booking_Details_lng; ?></h2>
                                        </div>
                                    </div>
                                    <div class="main-box-body clearfix">
                                            <div class="box-header with-border">
                                                <h3 class="box-title"></h3>
                                                <div class="taxi"></div>
                                            </div><!-- /.box-header -->
                                            <form action="javascript:void(0);" enctype="multipart/form-data"
                                                  method="post" class="form-horizontal" id="formAddBooking" name="add_booking"
                                                  role="form">
                                                    <h3><span><?php echo $User_Details_lng; ?></span></h3>
                                                    <br/>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label"
                                                               for="inputUser"><?php echo $User_ID_lng; ?></label>
                                                        <div id="inputUser" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter user id" name="userid"
                                                                   id="userId" class="form-control"
                                                                   value="<?php echo $query->user_id; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label"
                                                               for="inputUser">Driver Gender</label>
                                                        <div id="inputUser" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="" name="driverGender"
                                                                   id="driverGender" class="form-control"
                                                                   value="<?php echo ($query->driverGender) == ""?"Either":$query->driverGender; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label"
                                                               for="inputUser"><?php echo $User_Name_lng; ?></label>
                                                        <div id="inputUser" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter user name" name="username"
                                                                   id="userName" class="form-control"
                                                                   value="<?php echo $query->username; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label"
                                                               for="inputUser"><?php echo $Booking_ID_lng; ?></label>
                                                        <div id="inputUser" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter booking id" name="bookingid"
                                                                   id="userId" class="form-control"
                                                                   value="<?php echo $query->id; ?>" readonly>
                                                        </div>     
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="pickupArea"><?php echo $Pickup_Area_lng; ?></label>
                                                        <div id="inputPickupArea" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter pickup area" name="pickuparea"
                                                                   id="pickupArea" class="form-control"
                                                                   value="<?php echo $query->pickup_area; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="droppArea"><?php echo $Drop_Area_lng; ?></label>
                                                        <div id="inputDropArea" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter drop area" name="droparea"
                                                                   id="dropArea" class="form-control"
                                                                   value="<?php echo $query->drop_area; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="person"><?php echo $person; ?></label>
                                                        <div id="inputDropArea" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter person" name="person"
                                                                   id="person" class="form-control"
                                                                   value="<?php echo $query->person; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="adult_13plus"><?php echo $adult_13plus; ?></label>
                                                        <div id="adult_13plus" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter adult_13plus" name="adult_13plus"
                                                                   id="adult_13plus" class="form-control"
                                                                   value="<?php echo $query->adult_13plus; ?>" readonly>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="child_13less"><?php echo $child_13less; ?></label>
                                                        <div id="child_13less" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter child_13less" name="child_13less"
                                                                   id="child_13less" class="form-control"
                                                                   value="<?php echo $query->child_13less; ?>" readonly>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="child_7less"><?php echo $child_7less; ?></label>
                                                        <div id="child_7less" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter child_7less" name="child_7less"
                                                                   id="child_7less" class="form-control"
                                                                   value="<?php echo $query->child_7less; ?>" readonly>
                                                        </div>
                                                    </div>
                                                     <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="infant_1less"><?php echo $infant_1less; ?></label>
                                                        <div id="infant_1less" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter infant_1less" name="infant_1less"
                                                                   id="infant_1less" class="form-control"
                                                                   value="<?php echo $query->infant_1less; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="pickupdate"><?php echo $Booking_Date_Time_lng ?></label>
                                                        <div id="inputBookingDate" class="col-lg-10">
                                                            <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                                                <input type="text" id="bookingDate" class="form-control"
                                                                       placeholder="Enter booking date"
                                                                       value="<?php echo $query->book_create_date_time; ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="pickupdate"><?php echo $Pickup_Date_Time_lng; ?></label>
                                                        <div id="inputPickupDate" class="col-lg-10">
                                                            <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-calendar"></i></span>
                                                                <input type="text" id="pickupDate" class="form-control"
                                                                       placeholder="Enter pickup date"
                                                                       value="<?php echo $query->pickup_date_time; ?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="comment"><?php echo $Comment_lng; ?>
                                                            </label>
                                                        <div id="comment" class="col-lg-10">
                                                                <textarea id="comment" class="form-control"
                                                                       placeholder="Enter comment" readonly>
                                                                           <?php echo $query->comment; ?>
                                                                       </textarea>
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group">
                                                    <label class="col-lg-2 control-label" for="pickuptime">Pickup
                                                        Time</label>
                                                    <div id="inputPickupTime" class="col-lg-10">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i
                                                                    class="fa fa-clock-o"></i></span>
                                                            <input type="text" id="pickupTime" class="form-control"
                                                                   placeholder="Enter pickup time" value="<?php echo $query->pickup_date_time; ?>" readonly>
                                                        </div>
                                                    </div>
                                                </div>-->
                                                    <h3><span><?php echo $Driver_Details_lng; ?></span></h3>
                                                    <br/>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="selectcar"><?php echo $Select_Car_lng; ?></label>
                                                        <div id="inputSelectCar" class="col-lg-10">
                                                        <?php
                                                        if($query->status==1 || $query->status==5){
                                                        ?>
                                                            <select id="select-car" name="select-car" class="form-control">
                                                            <?php
                                                        }
                                                        else{
                                                        ?>
                                                            <select id="select-car" name="select-car" class="form-control" disabled> 
                                                        <?php    
                                                        }
                                                        ?>    
                                                                <option value=""><?php echo $Select_Car_lng; ?></option>
                                                                <?php
                                                                foreach ($query1 as $row1) {
                                                                    if($row1['cartype']==$query->taxi_type){
                                                                    ?>
                                                                    <option value="<?php echo $row1['cab_id']; ?>" selected><?php echo $row1['cartype']; ?></option>
                                                                    <?php    
                                                                    }
                                                                    else{
                                                                    ?>
                                                                    <option value="<?php echo $row1['cab_id']; ?>"><?php echo $row1['cartype']; ?></option>
                                                                    <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                            <div id="car-calculate" style="display:none;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="pickupaddress"><?php echo $Pickup_Address_lng; ?></label>
                                                        <div id="inputPickupAddress" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="<?php echo $Enter_pickup_address_lng; ?>"
                                                                   name="pickuaddress"
                                                                   id="pickupAddeess" class="form-control" value="<?php echo $query->pickup_address; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="selectdriver">Assigned
                                                            For</label>
                                                        <div class="col-lg-10">
                                                            <table align="center" border="1" style="width:100%;text-align:center">
                                                            <tr>
                                                                <th style="text-align:center"><?php echo $Driver_ID_lng; ?></th>
                                                                <th style="text-align:center"><?php echo $Driver_Name_lng; ?></th>
                                                                <th style="text-align:center"><?php echo $Driver_User_Name_lng; ?></th>
                                                                <th style="text-align:center"><?php echo $Driver_Email_lng; ?></th>
                                                                <th style="text-align:center"><?php echo $Ride_Status_lng; ?></th>
                                                            </tr>
                                                            <?php
                                                            $permission_page = $this->session->userdata('permission_page');
                                                            $permission_name = $this->session->userdata('username');

                                                            $permission_booking = true;
                                                            $flaged_val = $query->status_code;
                                                            if($permission_name == 'staff' ) {

                                                                if (!in_array(MANAGEBOOKING_PENDNINGBOOKING_EDIT_EDITDRIVER, $permission_page) && $flaged_val == 'pending') {
                                                                    $permission_booking = false;
                                                                }else if (!in_array(MANAGEBOOKING_USERCANCELBOOKING_EDIT_EDITDRIVER, $permission_page) && $flaged_val == 'user-cancelled') {
                                                                    $permission_booking = false;
                                                                }else if (!in_array(MANAGEBOOKING_DRIVERCANCELBOOKING_EDIT_EDITDRIVER, $permission_page) && $flaged_val == 'driver-unavailable') {
                                                                    $permission_booking = false;
                                                                }else if (!in_array(MANAGEBOOKING_ALLBOOKING_EDIT_EDITDRIVER, $permission_page)) {
                                                                    $permission_booking = false;
                                                                }
                                                            }

                                                            if ($query4) 
                                                            {
                                                                $driver_ct=0;
                                                                $edit_link_chk=0;
                                                                foreach($query4 as $row4)
                                                                {
                                                                    if($driver_ct<5)
                                                                    {
                                                                        echo '<tr>';
                                                                        echo '<td>'.$row4['id'].'</td>';
                                                                        echo '<td>'.$row4['name'].'</td>';
                                                                        echo '<td>'.$row4['user_name'].'</td>';
                                                                        echo '<td>'.$row4['email'].'</td>';
                                                                        if($row4['driver_flag']=='0'){
                                                                            $edit_link_chk=1;
                                                                            echo '<td>Pending</td></tr>';
                                                                        }
                                                                        else if($row4['driver_flag']=='1'){
                                                                            echo '<td>Accepted</td></tr>';
                                                                        }
                                                                        else if($row4['driver_flag']=='2'){
                                                                            echo '<td>Cancelled</td></tr>';
                                                                        }
                                                                        else if($row4['driver_flag']=='3'){
                                                                            echo '<td>Completed</td></tr>';
                                                                        }
                                                                    }
                                                                    $driver_ct++;
                                                                }
                                                                if($permission_booking == true) {
                                                                    if ($row4['driver_flag'] == '2' && $driver_ct < 5 && $edit_link_chk == 0 && $query->status != 3 && $query->status != 4 && $query->status != 7 && $query->status != 8 && $query->status != 9) {
                                                                        echo '<tr><td colspan="5" align="center"><a href="#" id="edit-driver-link">Edit Driver</a></td></tr>';
                                                                    }
                                                                }
                                                            }
                                                            else
                                                            {
                                                                echo '<tr><td colspan="5" align="center">Not any driver assigned yet!</td></tr>';
                                                                if($permission_booking == true) {
                                                                    if ($query->status != 3 && $query->status != 4 && $query->status != 7 && $query->status != 8 && $query->status != 9) {
                                                                        echo '<tr><td colspan="5" align="center"><a href="#" id="edit-driver-link">Edit Driver</a></td></tr>';
                                                                    }
                                                                }
                                                            }
                                                            ?>
                                                            </table>    
                                                            <div class="table-responsive">
                                                                <table id="example" class="table user-list" style="width:100%;">
                                                                    <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $Driver_ID_lng; ?></a></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $Driver_Name_lng; ?></a></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $Driver_Phone_lng; ?></a></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $License_No_lng; ?></a></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $Car_Type_lng; ?></a></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $Car_No_lng; ?></a></th>
                                                                        <th><a href="javascript:void(0);"><?php echo $Status_lng ?></a></th>
                                                                    </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="map"><?php echo $Map_lng; ?></label>
                                                        <div id="dvMap" class="col-lg-7" style="height: 500px"></div>
                                                        <div id="dvPanel" class="col-lg-3" style="height: 500px;overflow:scroll;"></div>
                                                        <!--<div id="dvDistance"></div>-->
                                                    </div>
                                                    <h3><span><?php echo $Payment_Details_lng; ?></span></h3>
                                                    <br/>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="selectcar"><?php echo $Payment_Type_lng; ?></label>
                                                        <div id="inputPaymentMode" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter payment type"
                                                                   name="paymentmode"
                                                                   id="paymentMode" class="form-control" value="<?php echo $query->payment_type; ?>" readonly>
                                                        </div>
                                                    </div>

                                                    <?php
                                                    if($query->payment_type!='cash'){
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="pickupaddress"><?php echo $Transaction_Id_lng; ?></label>
                                                        <div id="inputTransactionId" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter transaction id"
                                                                   name="transactionid"
                                                                   id="transactionId" class="form-control" value="<?php echo $query->transaction_id; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if($query->status==9)
                                                    {
                                                    ?>
                                                    <div class="form-group">
                                                        <label class="col-lg-2 control-label" for="pickupaddress"><?php echo $Final_Amount_lng; ?></label>
                                                        <div id="inputFinalAmount" class="col-lg-10">
                                                            <input type="text"
                                                                   onkeyup="javascript:capitalize(this.id, this.value);"
                                                                   onkeydown="errorValidUser();"
                                                                   placeholder="Enter final amount"
                                                                   name="finalamount"
                                                                   id="finalAmount" class="form-control" value="<?php echo $query->final_amount; ?>" readonly>
                                                        </div>
                                                    </div>
                                                    <?php    
                                                    }
                                                    ?>
                                                    <?php
                                                    if($query->payment_type== 'braintree'){
                                                    ?>
                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#refundModal">
                                                                Refund
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    <!--refund modal page-->
                                                    <div class="modal fade" id="refundModal" tabindex="-1" role="dialog" aria-labelledby="refundModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Refund</h5>
                                                                    <button type="button" class="close" style="margin-top: -20px;" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <div  class="col-xs-1 col-xs-offset-1">
                                                                            <input type="radio"  name="refund_name"  value="full" checked />
                                                                        </div>
                                                                        <label class="col-xs-2 control-label" style="text-align: left;" >Full Refund</label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div  class="col-xs-1 col-xs-offset-1">
                                                                            <input type="radio"  name="refund_name" value="partial" />
                                                                        </div>
                                                                        <label class="col-xs-2 control-label" style="text-align: left;" >Partial</label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-xs-2 control-label"></label>
                                                                        <div  class="col-xs-4">
                                                                            <input type="text" name="refund_price"  class="form-control " />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="button" class="btn btn-primary" id="refund_btn">Refund</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!---->

                                                    <?php
                                                        if($query->status==1 || $query->status==5 || $query->status==6){
                                                        ?>
                                                    <div class="form-group">
                                                        <div class="col-lg-offset-2 col-lg-10">
                                                            <button style="display:block;" class="btn btn-success"
                                                                    onclick="return check_User();"
                                                                    id="notification-trigger-bouncyflip" type="submit">
                                                                <span id="category_button" class="content"><?php echo $SUBMIT_lng; ?></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <footer class="row" id="footer-bar" style="opacity: 1;">
                    <p id="footer-copyright" class="col-xs-12">
                        <?php echo $footer; ?>
                    </p>
                </footer>
            </div>
        </div>
    </div>
</div>

<div id="config-tool" class="closed" style="display:none;">
    <a id="config-tool-cog">
        <i class="fa fa-cog"></i>
    </a>

    <div id="config-tool-options">
        <h4>Layout Options</h4>
        <ul>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-header" checked />
                    <label for="config-fixed-header">
                        Fixed Header
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-sidebar" checked />
                    <label for="config-fixed-sidebar">
                        Fixed Left Menu
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-fixed-footer" checked />
                    <label for="config-fixed-footer">
                        Fixed Footer
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-boxed-layout" />
                    <label for="config-boxed-layout">
                        Boxed Layout
                    </label>
                </div>
            </li>
            <li>
                <div class="checkbox-nice">
                    <input type="checkbox" id="config-rtl-layout" />
                    <label for="config-rtl-layout">
                        Right-to-Left
                    </label>
                </div>
            </li>
        </ul>
        <br/>
        <h4>Skin Color</h4>
        <ul id="skin-colors" class="clearfix">
            <li>
                <a class="skin-changer" data-skin="" data-toggle="tooltip" title="Default" style="background-color: #34495e;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-white" data-toggle="tooltip" title="White/Green" style="background-color: #2ecc71;">
                </a>
            </li>
            <li>
                <a class="skin-changer blue-gradient" data-skin="theme-blue-gradient" data-toggle="tooltip" title="Gradient">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-turquoise" data-toggle="tooltip" title="Green Sea" style="background-color: #1abc9c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-amethyst" data-toggle="tooltip" title="Amethyst" style="background-color: #9b59b6;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-blue" data-toggle="tooltip" title="Blue" style="background-color: #2980b9;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-red" data-toggle="tooltip" title="Red" style="background-color: #e74c3c;">
                </a>
            </li>
            <li>
                <a class="skin-changer" data-skin="theme-whbl" data-toggle="tooltip" title="White/Blue" style="background-color: #3498db;">
                </a>
            </li>
        </ul>
    </div>
</div>
<?php
$get_currency=$this->db->get("settings")->row()->currency;
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({ pageLanguage: "en" }, "google_translate_element");
  };

  $(function () {
    $(".loadMore").click(function () {
      $("<p/>", {
        text: "This is some injected text that will not be translated."
      }).appendTo($(".destination"));
    });
    $.getScript("//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit");
  });
</script>

<script src="<?php echo base_url();?>application/views/js/jquery-1.12.3.js"></script>

<!-- global scripts -->
<script src="<?php echo base_url();?>application/views/js/demo-skin-changer.js"></script> <!-- only for demo -->

<script src="<?php echo base_url();?>application/views/js/jquery.js"></script>
<script src="<?php echo base_url();?>application/views/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>application/views/js/jquery.nanoscroller.min.js"></script>

<script src="<?php echo base_url();?>application/views/js/demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="<?php echo base_url();?>application/views/js/moment.min.js"></script>
<script src="<?php echo base_url();?>application/views/js/gdp-data.js"></script>

<!-- theme scripts -->
<script src="<?php echo base_url();?>application/views/js/scripts.js"></script>
<script src="<?php echo base_url();?>application/views/js/pace.min.js"></script>

<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>

<!-- this page specific inline scripts -->
<script type="text/javascript">
    $(document).ready(function() {
        //CHARTS
        function gd(year, day, month) {
            return new Date(year, month - 1, day).getTime();
        }
        $('.table-responsive').css('display','none');
    });
</script>
<script type="text/javascript" language="javascript">
    $(window).load(function() {
        $(".cover").fadeOut(2000);
    });
    $(document).ready(function() {
var currency='<?php echo $get_currency; ?>';
             // get selected car type data
             if($("#select-car option:selected").val()!=''){
                $('#car-calculate').show();
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>admin/get_cartype_data",
                    data: {cab_id:$("#select-car option:selected").val()},
                    success: function (result) {
                    var json_arr=JSON.parse(result);
                   /* $('#car-calculate').html('<table class="cartype-details" align="center" border="1" style="width:100%;"><tr><td>Car Type:</td><td>'+$("#select-car option:selected").text()+'</td></tr><tr><td>First 5 km:</td><td>'+json_arr.car_rate+'ريال /km</td></tr><tr><td>After 5 km:</td><td>'+json_arr.fromintailrate+'ريال /km</td></tr><tr><td>Per Minute</td><td>'+json_arr.ride_time_rate+'ريال /min</td></tr><tr><td>Approx Distance:</td><td id="approx-distance"></td></tr><tr><td>Approx Cost:</td><td id="approx-cost"><span></span>ريال</td></tr><tr><td>Approx Time:</td><td id="approx-time"></td></tr></table>');*/
      $('#car-calculate').html('<table class="cartype-details" align="center" border="1" style="width:100%;"><tr><td><?php echo $Car_Type_lng; ?>:</td><td>'+$("#select-car option:selected").text()+'</td></tr><tr><td><?php echo $First_5_km_lng; ?>:</td><td>'+json_arr.car_rate+currency+' /<?php echo $km_lng; ?></td></tr><tr><td><?php echo $After_5_km_lng; ?>:</td><td>'+json_arr.fromintailrate+currency+' /<?php echo $km_lng; ?></td></tr><tr><td><?php echo $Per_Minute_lng; ?></td><td>'+json_arr.ride_time_rate+currency+' /<?php echo $min_lng; ?></td></tr><tr><td><?php echo $Approx_Distance_lng; ?>:</td><td id="approx-distance"></td></tr><tr><td><?php echo $Approx_Cost_lng; ?>:</td><td id="approx-cost"><span></span>'+currency+'</td></tr><tr><td><?php echo  $Approx_Time_lng ?>:</td><td id="approx-time"></td></tr></table>');
                    }
                });
        }
            // submit form on submit
        $('#formAddBooking').submit(function(){
            $('#example tr').each(function() {
                    if($(this).hasClass('selected'))
                    {
                        var sel_id=$(this).find('td:nth-child(2)').html();
                        if(sel_id=='' || sel_id==null){
                            sel_id=null;
                        }
                    }
                    else
                    {
                        sel_id=null; 
                    } 
                    if($('#select-car').val()!=''){
                        var car_type=$("#select-car option:selected").text();
                        var approx_amt=$('#approx-cost span').html();
                    }
                    else{
                        alert('Please select atlease one car type');
                        return false;
                        var car_type=null;
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url(); ?>admin/update_booking_data",
                        data: {id:'<?php echo $query->id; ?>',data_id: sel_id,taxi_type: car_type,amount:approx_amt},
                        success: function (result) {
                            if(result == 0){
                                $(".taxi").html('<p class="error">Error</p>');
                                setTimeout(function(){$(".taxi").hide(); }, 3000);
                            }
                            else{
                                location.reload();
                                //$(".taxi").html('<p class="success">Booking Details Saved Successfully</p>');
                                //setTimeout(function(){$(".taxi").hide(); }, 1500);
                            }
                        },
                        async: false
                    });
            });
        });

        if($('#edit-driver-link').length>0)
        {
            $('.table-responsive').css('display','none');
        }
        $('#edit-driver-link').click(function(e)
        {
            e.preventDefault();
            $( ".table-responsive" ).toggle();
        });
        var dataTable = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
            "columnDefs": [
                {
                    orderable: false,
                    className: 'select-checkbox',
                    targets:   0
                },
                {
                    "targets": [ 1 ],
                    "visible": true,
                    "searchable": true,
                    "width": "10%",
                    "sortable" :true
                },
                {
                    "targets": [ 2 ],
                    "visible": true,
                    "searchable": true,
                    "sortable" :true
                },
                {
                    "targets": [ 3 ],
                    "visible": true,
                    "searchable": true,
                    "sortable" :true
                },
                {
                    "targets": [ 4 ],
                    "visible": true,
                    "searchable": true,
                    "width": "20%",
                    "sortable" :true
                },
                {
                    "targets": [ 5 ],
                    "visible": true,
                    "searchable": true,
                    "width": "20%",
                    "sortable" :true
                },
                {
                    "targets": [ 6 ],
                    "visible": true,
                    "searchable": true,
                    "width": "20%",
                    "sortable" :true
                },
                {
                    "targets": [ 7 ],
                    "visible": true,
                    "searchable": false,
                    "width": "10%",
                    "sortable" :false
                }
            ],
            select: {
                style:    'os',
                selector: 'td:first-child'
            },
            "ajax":{
                url : '<?php echo base_url(); ?>admin/get_select_driver_data', // json datasource
                type: "post",  // method  , by default get
                data: {booking_id:'<?php echo $query->id; ?>'},
                error: function(){  // error handling
                    $(".booking-grid-error").html("");
                    $("#example").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#booking-grid_processing").css("display","none");
                }
            }
        });
    });

    $('#select-car').on('change',function(){
        if($(this).val()!=''){
        $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/get_cartype_data",
                data: {cab_id:$(this).val()},
                success: function (result) {
                    GetRoute();
                    $('#car-calculate').show();
                    var json_arr=JSON.parse(result);
                   $('#car-calculate').html('<table class="cartype-details" align="center" border="1" style="width:100%;"><tr><td>Car Type:</td><td>'+$("#select-car option:selected").text()+'</td></tr><tr><td>First 5 km:</td><td>'+json_arr.car_rate+'ريال /km</td></tr><tr><td>After 5 km:</td><td>'+json_arr.fromintailrate+'ريال /km</td></tr><tr><td>Per Minute</td><td>'+json_arr.ride_time_rate+'ريال /min</td></tr><tr><td>Approx Distance:</td><td id="approx-distance"></td></tr><tr><td>Approx Cost:</td><td id="approx-cost"><span></span>ريال</td></tr><tr><td>Approx Time:</td><td id="approx-time"></td></tr></table>');
                }
            });
        }
        else{
            $('#car-calculate').hide();
            alert('Please select atleast one car type');
        }
    });
    $('#refund_btn').click(function () {
        var refund_name = $(':radio[name="refund_name"]:checked').val();
        var refund_price = $('input[name="refund_price"]').val();
        var transaction_id  = '<?php echo $query->transaction_id; ?>';
        var payment_type = '<?php echo $query->payment_type; ?>'; // cash, card, braintree
        var booking_id = '<?php echo $query->id; ?>';
        var payment_status = '<?php echo $query->payment_status; ?>'; //0 ,2 ,1
        var status_code = '<?php echo $query->status_code; ?>'; //status_code=status, driver-unavailable=6, completed=9, user-cancelled=4, accepted=3, pending=1
        var amount = '<?php echo $query->amount; ?>';
        var final_amount = '<?php echo $query->final_amount; ?>';
//        refund_price = 5 ;
//        payment_type = 'BrainTree';
//        transaction_id = '4aapky4t';
//        refund_name = 'full';
//        status_code = 'completed';
//        final_amount = 10;
        if(refund_name == 'partial' ) {
            if(refund_price < 0 || refund_price == null) {
                alert("Please enter  a price for refund!");
                return false;
            }
        }
        if(transaction_id =='') {
            alert("This transaction id is not exist.");
            return  false;
        }
        if(payment_type !='braintree') {
            alert("You can 't refund for this payment status.");
            return  false;
        }
        if(final_amount == 0 && final_amount != '') {
            alert("You can 't refund becaue amount is 0.");
            return  false;
        }

        $.ajax({
            url: '<?php echo base_url()?>admin/manage_booking_refund',
            data: {
                refund_name: refund_name,
                refund_price: refund_price,
                transaction_id: transaction_id,
                payment_type : payment_type,
                booking_id : booking_id,
                payment_status: payment_status,
                status_code : status_code,
                final_amount : final_amount
            },
            type: 'post',
            dataType: "json",
            success: function(output) {
                var refund = 0 ;
                if(output.refund_result == true) {
                   refund = 1;
                }
                if(output.refund_result == false) {
                    if (output.result_transaction_status == 'submitted_for_settlement' || output.result_transaction_status == 'settled') {
                        refund = 2;
                    }
                }
                if(refund == 1) {
                    alert('Sucessfully refunded.');
                }else if(refund == 2){
                    alert('This transaction was refunded already.');
                }
                else{
                    alert('Unsucessfully refund.');
                }
            },
            error: function(e){
                alert('Something went wrong');
            }
        });
    });
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5WgfHn67qGhlT_qAZOBiU5zMXz67qhE&callback=GetRoute"></script>
<script type="text/javascript">
            // calculate distance and time between two points
            function GetRoute() {
                document.getElementById('dvPanel').innerHTML="";
                var source, destination;
                var directionsDisplay;
                var directionsService = new google.maps.DirectionsService();
                directionsDisplay = new google.maps.DirectionsRenderer({ 'draggable': true });
                var mumbai = new google.maps.LatLng(18.9750, 72.8258);
                //var mumbai = new google.maps.LatLng(51.5287352, -0.3817859);
                var mapOptions = {
                    zoom: 7,
                    center: mumbai,
                    scrollwheel: false,
                    navigationControl: false,
                    mapTypeControl: false,
                    scaleControl: false,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                map = new google.maps.Map(document.getElementById('dvMap'), mapOptions);
                directionsDisplay.setMap(map);
                directionsDisplay.setPanel(document.getElementById('dvPanel'));
                //*********DIRECTIONS AND ROUTE**********************//
                //source = document.getElementById("pickupArea").value;
                //destination = document.getElementById("dropArea").value;
                source = {lat: <?php echo $query->pickup_lat ?>, lng: <?php echo $query->pickup_long ?>};
                destination = {lat: <?php echo $query->drop_lat ?>, lng: <?php echo $query->drop_long ?>};
                var request = {
                    origin: source,
                    destination: destination,
                    travelMode: google.maps.TravelMode.DRIVING
                };
                directionsService.route(request, function (response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                    }
                });
             
                //*********DISTANCE AND DURATION**********************//
                var service = new google.maps.DistanceMatrixService();
                service.getDistanceMatrix({
                    origins: [source],
                    destinations: [destination],
                    travelMode: google.maps.TravelMode.DRIVING,
                    unitSystem: google.maps.UnitSystem.METRIC,
                    avoidHighways: false,
                    avoidTolls: false
                }, function (response, status) {
                    if (status == google.maps.DistanceMatrixStatus.OK && response.rows[0].elements[0].status != "ZERO_RESULTS") {
                        //var distance = response.rows[0].elements[0].distance.text;
                        //var duration = response.rows[0].elements[0].duration.text;
                        var distance = (response.rows[0].elements[0].distance.value/1000).toFixed(2);
                        var round_distance = Math.round(distance);
                        var duration = (response.rows[0].elements[0].duration.value/60).toFixed(0);
                        var show_duration = response.rows[0].elements[0].duration.text;
                        /*var dvDistance = document.getElementById("dvDistance");
                       dvDistance.innerHTML = "";
                        dvDistance.innerHTML += "Distance: " + distance + "<br />";
                        dvDistance.innerHTML += "Duration:" + duration;*/
                        if(distance>1.0)
                        {
                            $('#approx-distance').html(round_distance+" km");
                        }
                        else
                        {
                            $('#approx-distance').html(distance+" km");
                        }
                        $('#approx-time').html(show_duration);
                        if($("#select-car option:selected").val()!=''){
                            $.ajax({
                                type: "POST",
                                url: "<?php echo base_url(); ?>admin/calculate_ride_rates",
                                data: {pickup_date_time:'<?php echo $query->pickup_date_time; ?>',cab_id:$("#select-car option:selected").val(),approx_distance:round_distance,approx_time:duration},
                                success: function (result) {
                                    $('#approx-cost span').html(result);
                                }
                            });
                        }
             
                    } else {
                        alert("Unable to find the distance via road.");
                    }
                });
            }
</script>
<!--<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5WgfHn67qGhlT_qAZOBiU5zMXz67qhE&callback=initMap">
</script>-->
</body>
</html>
