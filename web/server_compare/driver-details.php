<?php
$base_ip = BASE_IP;
include ('language.php');
//$staff_name = $this->session->userdata('log-name');

?>
<!DOCTYPE html>
<?php
$id=$_GET['id'];
$appoint_date = '';
$appoint_time = '';
$appoint_location = '';
$appoint_id = 0;
$staff_name = '';


$query_inspect_appoint=$this->db->query("SELECT * FROM `driver_inspection_appoint`  WHERE driver_id= $id ");
if(!empty($query_inspect_appoint)) {
	$row_appoint = $query_inspect_appoint->row('driver_inspection_appoint');
	if(!empty($row_appoint->id)) {
		$appoint_id  = $row_appoint->id;
		$appoint_date = $row_appoint->inspect_date;
		$appoint_time = $row_appoint->inspect_time;
		$staff_name = $row_appoint->inspector;
		$appoint_location = $row_appoint->location;
	}
}


$query=$this->db->query("SELECT * FROM `driver_details` INNER JOIN `cabdetails` ON cabdetails.cab_id=driver_details.car_type WHERE driver_details.id=$id");
$row = $query->row('driver_details');


//echo $encryptedData;




$sensitiveData = '';
$query_ssn=$this->db->query("SELECT * FROM `driver_ssn` WHERE id= $id ");
if(!empty($query_ssn)) {
	$row1 = $query_ssn->row('driver_ssn');
	//echo strlen($row1->ssn);
	if(!empty($row1->ssn))
		openssl_private_decrypt($row1->ssn, $sensitiveData, $privateKey);
	//print_r ($sensitiveData); exit;
}

$ac_create_id = '';
$ac_create_created = '';
$ac_create_updated = '';
$ac_create_firstname = '' ;
$ac_create_lastname = '' ;
$ac_create_email = '' ;
$ac_create_all = '' ;
$query_ac_create = $this->db->query("SELECT * FROM `driver_accurate_create` WHERE driver_id= $id ");
if(!empty($query_ac_create)) {
	$row_ac = $query_ac_create->row('driver_accurate_create');
	if(!empty($row_ac->id))
		$ac_create_id = $row_ac->id;
	if(!empty($row_ac->firstName))
		$ac_create_firstname = $row_ac->firstName;
	if(!empty($row_ac->lastName))
		$ac_create_lastname = $row_ac->lastName;
	if(!empty($row_ac->created))
		$ac_create_created = $row_ac->created;
	if(!empty($row_ac->updated))
		$ac_create_updated = $row_ac->updated;
	if(!empty($row_ac->all_text))
		$ac_create_all = $row_ac->all_text;

}

//accurate place an order
$ac_order_id = '';
$ac_order_created = '';
$ac_order_updated = '';
$ac_order_submitted = '';
$ac_order_packagetype = '' ;
$ac_order_workflow= '' ;
$ac_order_copyofreport = '' ;
$ac_order_all = '' ;
$query_ac_order = $this->db->query("SELECT * FROM `driver_accurate_order` WHERE driver_id= $id ");
if(!empty($query_ac_order)) {
	$row_ac = $query_ac_order->row('driver_accurate_order');
	if(!empty($row_ac->id))
		$ac_order_id = $row_ac->id;
	if(!empty($row_ac->packageType))
		$ac_order_packagetype = $row_ac->packageType;
	if(!empty($row_ac->workflow))
		$ac_order_workflow = $row_ac->workflow;
	if(!empty($row_ac->created))
		$ac_order_copyofreport = $row_ac->copyOfReport;
	if(!empty($row_ac->created))
		$ac_order_created = $row_ac->created;
	if(!empty($row_ac->updated))
		$ac_order_updated = $row_ac->updated;
	if(!empty($row_ac->submitted))
		$ac_order_submitted = $row_ac->submitted;
	if(!empty($row_ac->all_text))
		$ac_order_all = $row_ac->all_text;

}


//accurate check order status
$ac_check_id = '';
$ac_check_created = '';
$ac_check_updated = '';
$ac_check_submitted = '';
$ac_check_packagetype = '' ;
$ac_check_workflow= '' ;
$ac_check_copyofreport = '' ;
$ac_check_all = '' ;
$query_ac_check = $this->db->query("SELECT * FROM `driver_accurate_check` WHERE driver_id= $id ");
if(!empty($query_ac_check)) {
	$row_ac = $query_ac_check->row('driver_accurate_check');
	if(!empty($row_ac->id))
		$ac_check_id = $row_ac->id;
	if(!empty($row_ac->packageType))
		$ac_check_packagetype = $row_ac->packageType;
	if(!empty($row_ac->workflow))
		$ac_check_workflow = $row_ac->workflow;
	if(!empty($row_ac->created))
		$ac_check_copyofreport = $row_ac->copyOfReport;
	if(!empty($row_ac->created))
		$ac_check_created = $row_ac->created;
	if(!empty($row_ac->updated))
		$ac_check_updated = $row_ac->updated;
	if(!empty($row_ac->submitted))
		$ac_check_submitted = $row_ac->submitted;
	if(!empty($row_ac->all_text))
		$ac_check_all = $row_ac->all_text;

}

// cash payment
$query1 = $this->db->query("SELECT SUM(b.final_amount) as cash_payment FROM `bookingdetails` b INNER JOIN `driver_status` d ON d.booking_id=b.id WHERE d.driver_id=$id AND d.driver_flag=3 AND b.payment_type='cash'");
if($query1->num_rows() > 0){
	$cash_payment = $query1->row();
	if($cash_payment->cash_payment==''){
		$cash_payment->cash_payment = 0;
	}
}
else{
	$cash_payment = 0;
}

// card payment
$query2 = $this->db->query("SELECT SUM(b.final_amount) as card_payment FROM `bookingdetails` b INNER JOIN `driver_status` d ON d.booking_id=b.id WHERE d.driver_id=$id AND d.driver_flag=3 AND b.payment_type!='cash'");
if($query2->num_rows() > 0){
	$card_payment = $query2->row();
	if($card_payment->card_payment==''){
		$card_payment->card_payment = 0;
	}
}
else{
	$card_payment = 0;
}
// current balance
$due_amount = (int)$cash_payment->cash_payment+(int)$card_payment->card_payment;
if($due_amount > 0){
	$query4 = $this->db->query("SELECT SUM(amount) as paid_amount FROM `transaction_history` WHERE t_driver_id=$id");
	if($query4->num_rows() > 0)
	{
		$paid = $query4->row();
		if($paid->paid_amount!=NULL || $paid->paid_amount!='')
		{
			$paid_balance = $paid->paid_amount;
		}
		else
		{
			$paid_balance = 0;
		}
	}
	else
	{
		$paid_balance = 0;
	}
	/*$due_balance = $query3->row();
	if($due_balance->due_payment!=NULL || $due_balance->due_payment!='') {
		$due_amount = $due_balance->due_payment;
	}
	else{
		$due_amount = 0;
	}*/
	$current_balance = $due_amount - $paid_balance;
}
else{
	$current_balance = 0;
	$paid_balance = 0;
}
if(isset($_REQUEST['update_driver']))
{
	$table='driver_details';
	$name=$_REQUEST['drivename'];
	$driver_username=$_REQUEST['driver_username'];
	$driver_email=$_REQUEST['driver_email'];
	$driver_gender=$_REQUEST['driver_gender'];
	$driver_date_birth=$_REQUEST['driver_date_birth'];
	$driver_address=$_REQUEST['driver_address'];
	$driver_phone=$_REQUEST['driver_phone'];
	$driver_emailaddress=$_REQUEST['driver_emailaddress'];
	$driver_licenno=$_REQUEST['driver_licenno'];
	$driver_exp_date=$_REQUEST['driver_exp_date'];
	$driver_licen_plate=$_REQUEST['driver_licen_plate'];
	$driver_insurance=$_REQUEST['driver_insurance'];
	$driver_car_type=$_REQUEST['driver_car_type'];
	$driver_carno=$_REQUEST['driver_carno'];
	$driver_carmodel=$_REQUEST['driver_carmodel'];
	$driver_carmake=$_REQUEST['driver_carmake'];
	$driver_carseat=$_REQUEST['driver_carseat'];
	$driver_is_featured = $_REQUEST['driver_is_featured'];

	$driver_bank_name= $_REQUEST['bank_name'];
	$driver_bank_number = $_REQUEST['bank_number'];
	$driver_bank_routing = $_REQUEST['bank_routing'];

	$update_data=array(
		'name'=>$name,
		'user_name'=>$driver_username,
		'phone'=>$driver_phone,
		'address'=>$driver_address,
		'email'=>$driver_email,
		'license_no'=>$driver_licenno,
		'car_type'=>$driver_car_type,
		'car_no'=>$driver_carno,
		'gender'=>$driver_gender,
		'dob'=>$driver_date_birth,
		'Lieasence_Expiry_Date'=>$driver_exp_date,
		'license_plate'=>$driver_licen_plate,
		'Insurance'=>$driver_insurance,
		'Car_Model'=>$driver_carmodel,
		'Car_Make'=>$driver_carmake,
		'Seating_Capacity'=>$driver_carseat,
        'is_featured' => $driver_is_featured,
				'bank_name'=>$driver_bank_name,
				'bank_number'=>$driver_bank_number,
				'bank_routing'=>$driver_bank_routing
	);
	$where_data=array(
		'id'=>$id
	);
	//print_r($update_data);exit;
	$this->db->where($where_data);
	$data = $this->db->update($table, $update_data);
	if($data == 1)
	{
		//http://139.59.154.174:4040/updateDriverCarType?{"driverId":7,"carTypeID":33333}
		$data = array('driverId'=>$id,'carTypeID'=>$driver_car_type,'feature_flag' => $driver_is_featured);
		$new_json_array = json_encode($data,JSON_UNESCAPED_SLASHES);
		$url = $base_ip.":4040/updateDriverCarType?".$new_json_array;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// This is what solved the issue (Accepting gzip encoding)
		curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
		$response = curl_exec($ch);
		curl_close($ch);

		$data1 = array('driver_id'=>$id,'feature_flag'=>$driver_is_featured);
		$new_json_array1 = json_encode($data1,JSON_UNESCAPED_SLASHES);
		$url1 = $base_ip.":4040/setFeatureFlag?".$new_json_array1;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		// This is what solved the issue (Accepting gzip encoding)
		curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
		$response = curl_exec($ch);
		curl_close($ch);

		redirect(BASE_URL."admin/manage_driver");
	}
}

$permission_page = $this->session->userdata('permission_page');
$permission_name = $this->session->userdata('username');


$permission_general = true;
$permission_general_view = true;
$permission_general_view_ssn = true;
$permission_general_edit = '';


$permission_changepass = true;
$permission_changepass_view = true;
$permission_changepass_edit = '';

$permission_car = true;
$permission_car_view = true;
$permission_car_edit = '';

$permission_inspection = true;
$permission_inspection_create = true;
$permission_inspection_editappointment = true;


$permission_bank = true;
$permission_bank_view = true;
$permission_bank_edit = '';

$permission_payment = true;
$permission_payment_view = true;
$permission_payment_edit = '';

$flaged_val = $row->flag;

if($permission_name == 'staff' )  {

	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL, $permission_page) && $flaged_val == 'no') {
		$permission_general = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_GENERAL, $permission_page) && $flaged_val == 'yes') {
		$permission_general = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_VIEW, $permission_page)&& $flaged_val == 'no' ) {
		$permission_general_view = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_VIEW_SSN, $permission_page)&& $flaged_val == 'no' ) {
		$permission_general_view_ssn = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_GENERAL_VIEW, $permission_page) && $flaged_val == 'yes') {
		$permission_general_edit = false;
	}

	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_EDIT, $permission_page)&& $flaged_val == 'no' ) {
		$permission_general_edit = 'disabled';
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_GENERAL_EDIT, $permission_page) && $flaged_val == 'yes') {
		$permission_general_edit = 'disabled';
	}



	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS, $permission_page) && $flaged_val == 'no') {
		$permission_changepass = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_CHANGEEPASS, $permission_page) && $flaged_val == 'yes') {
		$permission_changepass = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS_VIEW, $permission_page) && $flaged_val == 'no') {
		$permission_changepass_view = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_CHANGEPASS_VIEW, $permission_page) && $flaged_val == 'yes') {
		$permission_changepass_view = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS_EDIT, $permission_page) && $flaged_val == 'no') {
		$permission_changepass_edit = 'disabled';
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_CHANGEPASS_EDIT, $permission_page) && $flaged_val == 'yes') {
		$permission_changepass_edit = 'disabled';
	}



	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL, $permission_page) && $flaged_val == 'no') {
		$permission_car = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_CARDETAIL, $permission_page) && $flaged_val == 'yes') {
		$permission_car = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL_VIEW, $permission_page) && $flaged_val == 'no' ) {
		$permission_car_view = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_CARDETAIL_VIEW, $permission_page) && $flaged_val == 'yes') {
		$permission_car_view = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL_EDIT, $permission_page) && $flaged_val == 'no') {
		$permission_car_edit = 'disabled';
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_CARDETAIL_EDIT, $permission_page) && $flaged_val == 'yes' ) {
		$permission_car_edit = 'disabled';
	}


	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION, $permission_page) && $flaged_val == 'no') {
		$permission_inspection = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION, $permission_page) && $flaged_val == 'yes') {
		$permission_inspection = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_CREATE, $permission_page) && $flaged_val == 'no' ) {
		$permission_inspection_create = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_CREATE, $permission_page) && $flaged_val == 'yes') {
		$permission_inspection_create = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_EDITAPPOINTMENT, $permission_page) && $flaged_val == 'no') {
		$permission_inspection_editappointment = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_EDITAPPOINTMENT, $permission_page) && $flaged_val == 'yes' ) {
		$permission_inspection_editappointment = false;
	}


	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL, $permission_page) && $flaged_val == 'no') {
		$permission_bank = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_BANKDETAIL, $permission_page) && $flaged_val == 'yes') {
		$permission_bank = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_VIEW, $permission_page) && $flaged_val == 'no') {
		$permission_bank_view = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_BANKDETAIL_VIEW, $permission_page) && $flaged_val == 'yes') {
		$permission_bank_view = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_EDIT, $permission_page) && $flaged_val == 'no') {
		$permission_bank_edit = 'disabled';
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_BANKDETAIL_EDIT, $permission_page) && $flaged_val == 'yes' ) {
		$permission_bank_edit = 'disabled';
	}



	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL, $permission_page) && $flaged_val == 'no' ) {
		$permission_payment = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL, $permission_page) && $flaged_val == 'yes') {
		$permission_payment = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL_VIEW, $permission_page) && $flaged_val == 'no' ) {
		$permission_payment_view = false;
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL_VIEW, $permission_page) && $flaged_val == 'yes') {
		$permission_payment_view = false;
	}
	if (!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL_EDIT, $permission_page) && $flaged_val == 'no') {
		$permission_payment_edit = 'disabled';
	}
	if (!in_array(MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL_EDIT, $permission_page) && $flaged_val == 'yes') {
		$permission_payment_edit = 'disabled';
	}

}



?>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Driver Details - <?php echo $header_title; ?></title>

	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/bootstrap/bootstrap.min.css" />

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/style.css" />
	<!-- RTL support - for demo only -->
	<script src="js/demo-rtl.js"></script>
	<!--
	If you need RTL support just include here RTL CSS file <link rel="stylesheet" type="text/css" href="css/libs/bootstrap-rtl.min.css" />
	And add "rtl" class to <body> element - e.g. <body class="rtl">
	-->
  <script>

	  $("#car_year").keyup(function() {
      $("#car_year").val(this.value.match(/[0-9]*/));
		});
		$("#bank_number").keyup(function() {
		$("#bank_number").val(this.value.match(/[0-9]*/));
		});

		$("#bank_routing").keyup(function() {
		$("#bank_routing").val(this.value.match(/[0-9]*/));
		});






</script>
	<!-- libraries -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/font-awesome.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/nanoscroller.css" />

	<!-- global styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/compiled/theme_styles.css" />

	<!-- this page specific styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/timeline.css">

	<!-- this page specific styles -->
	<link rel="stylesheet" href="<?php echo base_url();?>application/views/css/libs/daterangepicker.css" type="text/css" />

	<!-- Favicon -->
	<link type="image/x-icon" href="<?php echo base_url();?>upload/favicon.png" rel="shortcut icon" />

	<!-- google font libraries -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
		<script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
	<![endif]-->

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
  <style type="text/css">.modal-open .modal{ background:url(<?php echo base_url();?>application/views/img/transpharant.png) top left repeat;}</style>
<!-loader ->
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/normalize.css">
    <link rel="stylesheet" href="<?php echo base_url();?>application/views/css/main.css">
    <script src="<?php echo base_url();?>application/views/js/vendor/modernizr-2.6.2.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo base_url();?>application/views/js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="<?php echo base_url();?>application/views/js/main.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.0.47/jquery.fancybox.min.js"></script>
    <!-- end loader-->
	<style>
		#inspection-record_paginate {
			display: none;
		}
		#inspection-record_length {
			display: none;
		}
		.inspect_grren {
			color: #09cd09;
		}
		.inspect_red {
			color: #cd4009;
		}
		#inspection-record td {
			font-size: 15px;
		}
		#inspection-appointment td {
			font-size: 15px;
		}
	</style>
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
											<h1><?php echo $Driver_Details_lng; ?></h1>
										</div>
										<div class="pull-right">
											<ol class="breadcrumb">
												<li><a href="#"><?php echo $HOME_lng; ?></a></li>
												<li class="active"><span><?php echo $Driver_Details_lng; ?></span></li>
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
											<h2><?php echo $Driver_Details_lng; ?></h2>
										  </div>
										</div>
										<div class="main-box-body clearfix">
											<div class="tabs-wrapper profile-tabs">
												<!--///////////////permission general//////////////////////-->
												<form enctype="multipart/form-data" method="post"
													  class="form-horizontal" id="formAddUser" name="add_user"
													  role="form">
												<?php if($permission_general == true) { ?>
												<ul class="nav nav-tabs">
													<li class="active"><a href="#tab-newsfeed"
																		  data-toggle="tab"><?php echo $Driver_Details_lng; ?></a>
													</li>

													<li><a href="#tab-rating" data-toggle="tab">Driver Rating</a></li>
												</ul>
												<div class="tab-content">
													<div class="main-box-body clearfix tab-pane fade in active"
														 id="tab-newsfeed">

															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $profile_picture_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<?php
																	if ($row->image) {
																		?>
																		<img
																			src="<?php echo base_url() . 'driverimages/' . $row->image; ?>"
																			width="100">
																		<?php
																	} else {
																		?>
																		<img
																			src="<?php echo base_url() ?>upload/no-image-icon.png"
																			width="100">
																		<?php
																	}
																	?>
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $driver_license_front_picture_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<?php
																	if ($row->driver_license_front) {
																		?>
																		<a data-fancybox="gallery" id="single_image"
																		   href="<?php echo base_url() . 'driverimages/' . $row->driver_license_front; ?>"><img
																				src="<?php echo base_url() . 'driverimages/' . $row->driver_license_front; ?>"
																				width="100"></a>
																		<?php
																	} else {
																		?>
																		<a data-fancybox="gallery" id="single_image"
																		   href="<?php echo base_url() ?>upload/no_thumb.jpeg"><img
																				src="<?php echo base_url() ?>upload/no_thumb.jpeg"
																				width="100"></a>
																		<?php
																	}
																	?>
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $driver_license_back_picture_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<?php
																	if ($row->driver_license_back) {
																		?>
																		<a data-fancybox="gallery" id="single_image2"
																		   href="<?php echo base_url() . 'driverimages/' . $row->driver_license_back; ?>">
																			<img
																				src="<?php echo base_url() . 'driverimages/' . $row->driver_license_back; ?>"
																				width="100">
																		</a>
																		<?php
																	} else {
																		?>
																		<a data-fancybox="gallery" id="single_image2"
																		   href="<?php echo base_url() ?>upload/no_thumb.jpeg">
																			<img
																				src="<?php echo base_url() ?>upload/no_thumb.jpeg"
																				width="100">
																		</a>
																		<?php
																	}
																	?>
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $driver_vehicle_registration_img_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<?php
																	if ($row->vehicle_registration_img) {
																		?>
																		<a data-fancybox="gallery" id="single_image2"
																		   href="<?php echo base_url() . 'driverimages/' . $row->vehicle_registration_img; ?>">
																			<img
																				src="<?php echo base_url() . 'driverimages/' . $row->vehicle_registration_img; ?>"
																				width="100">
																		</a>
																		<?php
																	} else {
																		?>
																		<a data-fancybox="gallery" id="single_image2"
																		   href="<?php echo base_url() ?>upload/no_thumb.jpeg">
																			<img
																				src="<?php echo base_url() ?>upload/no_thumb.jpeg"
																				width="100">
																		</a>
																		<?php
																	}
																	?>
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $Name_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="drivename" id="driverName"
																		   class="form-control "
																		   value="<?php echo $row->name; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $Username_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_username" id="driver_username"
																		   class="form-control"
																		   value="<?php echo $row->user_name; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $Email_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_email" id="driver_email"
																		   class="form-control"
																		   value="<?php echo $row->email; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $Gender_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_gender" id="driver_gender"
																		   class="form-control"
																		   value="<?php echo $row->gender; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $Date_Of_Birth_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_date_birth"
																		   id="driver_date_birth" class="form-control"
																		   value="<?php echo $row->dob; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<?php if($permission_general_view_ssn == true) { ?>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $driver_ssn; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_ssn"
																		   id="driver_ssn" class="form-control"
																		   value="<?php echo $sensitiveData; ?>"
																		   disabled/>
																</div>
															</div>
															<?php } ?>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="driveraddress"><?php echo $Address_lng; ?></label>
																<div id="inputDriverAddress" class="col-lg-10">
																	<textarea rows="3" id="driver_address"
																			  name="driver_address" class="form-control"
																			  required <?php echo $permission_general_edit ?> ><?php echo $row->address; ?></textarea>
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="driverphone"><?php echo $Phone_NO_lng; ?></label>
																<div id="inputDriverPhone" class="col-lg-10">
																	<div class="input-group">
																		<span class="input-group-addon"><i
																				class="fa fa-phone"></i></span>
																		<input type="text" id="driver_phone"
																			   name="driver_phone" class="form-control"
																			   value="<?php echo $row->phone; ?>"
																			   required <?php echo $permission_general_edit ?> />
																	</div>
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="driveremail"><?php echo $Email_Address_lng; ?></label>
																<div id="inputDriverEmail" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_emailaddress"
																		   id="driver_emailaddress" class="form-control"
																		   value="<?php echo $row->email; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="driverlicenseno"><?php echo $License_NO_lng; ?></label>
																<div id="inputDriverLicenseNo" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_licenno" id="driver_licenno"
																		   class="form-control"
																		   value="<?php echo $row->license_no; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $License_Expiry_Date_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_exp_date" id="driver_exp_date"
																		   class="form-control"
																		   value="<?php echo $row->Lieasence_Expiry_Date; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $License_Plate_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_licen_plate"
																		   id="driver_licen_plate" class="form-control"
																		   value="<?php echo $row->license_plate; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>
															<div class="form-group">
																<label class="col-lg-2 control-label"
																	   for="drivername"><?php echo $Insurance_lng; ?></label>
																<div id="inputDriverName" class="col-lg-10">
																	<input type="text"
																		   onkeyup="javascript:capitalize(this.id, this.value);"
																		   onkeydown="errorValidUser();"
																		   name="driver_insurance" id="driver_insurance"
																		   class="form-control"
																		   value="<?php echo $row->Insurance; ?>"
																		   required <?php echo $permission_general_edit ?> />
																</div>
															</div>

															<?php } ?>
															<!--//////////////change password///////////////////////-->
															<?php if($permission_changepass == true) { 	?>
															<?php if ($permission_changepass_view == true) { ?>
																<div class="form-group">
																	<label class="col-lg-2 control-label"
																		   for="drivername"><?php echo $Change_Password_lng; ?></label>
																	<div id="inputDriverName" class="col-lg-3">
																		<a class="btn-primary form-control text-center"
																		   href="<?php echo base_url(); ?>admin/driver_change_password?id=<?php echo $id; ?>"><?php echo $Change_Password_lng; ?></a>
																	</div>
																</div>
															<?php
																}
															}
															?>

															 <!--//////////////////////////////car details start//////////////////-->
															<?php if($permission_car == true) { ?>
															  	<h3><span><?php echo $Car_Details_lng; ?></span></h3>
															 	 <br />
																<div class="form-group">
																	<label class="col-lg-2 control-label" for="drivercartype"><?php echo $Car_Type_lng; ?></label>
																	<div id="inputDriverCarType" class="col-lg-10">
																		<?php
																		$query1 = $this->db->query("SELECT * FROM cabdetails ORDER  by cab_id DESC ");
																		?>

																		<select name="driver_car_type" id="car_type" class="form-control" required <?php echo $permission_car_edit ?> >
																			<?php
																			$i=0;
																			foreach($query1->result_array('cartype') as $row1) {
																				?>
																				<option value="<?php echo $row1['cab_id']; ?>" <?php echo $row1['cartype']==$row->cartype ? ' selected="selected"' : '';?>><?php echo $row1['cartype']; ?></option>
																				<?php
																				$i++;
																			}
																			?>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-lg-2 control-label" for="drivercarno">Car Year</label>
																	<div id="inputDriverCarNo" class="col-lg-10">
																	  <input id="car_year" type="text" maxlength="4" pattern="([0-9]|[0-9]|[0-9])" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="driver_carno" id="driver_carno" class="form-control"  value="<?php echo $row->car_no;?>" required <?php echo $permission_car_edit ?> />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-lg-2 control-label" for="drivercarno"><?php echo $Car_Model_lng; ?></label>
																	<div id="inputDriverCarNo" class="col-lg-10">
																		<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="driver_carmodel" id="driver_carmodel" class="form-control"  value="<?php echo $row->Car_Model;?>" required <?php echo $permission_car_edit ?> />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-lg-2 control-label" for="drivercarno"><?php echo $Car_Make_lng; ?></label>
																	<div id="inputDriverCarNo" class="col-lg-10">
																		<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="driver_carmake" id="driver_carmake" class="form-control" value="<?php echo $row->Car_Make;?>" required <?php echo $permission_car_edit ?> />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-lg-2 control-label" for="drivercarno"><?php echo $Loading_Capacity_lng; ?></label>
																	<div id="inputDriverCarNo" class="col-lg-10">
																		<input type="number" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="driver_carseat" id="driver_carseat" class="form-control"  value="<?php echo $row->Seating_Capacity;?>" required <?php echo $permission_car_edit ?> />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-lg-2 control-label" for="driverisfeatured"><?php echo $is_featured_lng; ?></label>
																	<div id="inputDriverisFeatured" class="col-lg-10">
																		<select name="driver_is_featured" id="is_featured" class="form-control" required <?php echo $permission_car_edit ?> >
																			<?php
																			if($row->is_featured=='0'){
																			?>
																				<option value="1">Yes</option>
																				<option value="0" selected="selected">No</option>
																			<?php
																			}
																			else if($row->is_featured=='1'){
																			?>
																				<option value="1" selected="selected">Yes</option>
																				<option value="0">No</option>
																			<?php
																			}
																			else{
																			?>
																				<option value="1">Yes</option>
																				<option value="0" selected>No</option>
																			<?php
																			}
																			?>
																		</select>
																	</div>
																</div>
																<?php if($permission_car_edit == '' ) {?>
																<div class="form-group">
																	<div class="col-lg-offset-2 col-lg-2">
																		<input class="btn-primary form-control" name="update_driver" type="submit" >
																	</div>
																</div>
																<?php } ?>
															<?php  } ?>
															<!--///////////////inspection record////////////////////////-->
															<?php if($permission_inspection == true) { ?>
																<?php  if($permission_inspection_create == true) { ?>
																	<div style="margin-bottom: 30px;">
																	<a class="btn btn-primary pull-right"  href="javascript:void(0)" onclick="window.location.href='add_inspection?driver_id=<?php echo $id?>'">
																		<i class="fa fa-plus-circle fa-lg"></i> <?php echo $Inspection_lng;?>
																	</a>
																	</div>
																<?php } ?>
																<h3><span><?php echo $Inspection_Record_Details_lng; ?></span></h3>
																<div  class="tab-pane fade in active" >
																	<table id="inspection-record" class="table user-list" style="width:100%;">
																		<thead>
																		<tr>
																			<th><a href="javascript:void(0);"><?php echo $Inspection_Date; ?></a></th>
																			<th><a href="javascript:void(0);"><?php echo $Inspection_Time; ?></a></th>
																			<th><a href="javascript:void(0);"><?php echo $Inspection_Inspector; ?></a></th>
																			<th><a href="javascript:void(0);"><?php echo $Inspection_Result; ?></a></th>
																			<th><a href="javascript:void(0);"><?php echo $Inspection_Action; ?></a></th>
																		</tr>
																		</thead>
																	</table>
																</div>

															<!--////////////////////////inspection appointment////////////////////-->

																<h3><span><?php echo $Inspection_Appointment_Details_lng; ?></span></h3>
																<div  class="tab-pane fade in active" >
																	<table id="inspection-appointment" class="table user-list" style="width:100%;">
																		<thead>
																		<tr>
																			<th><?php echo $Inspection_Date; ?></th>
																			<th><?php echo $Inspection_Time; ?></th>
																			<th><?php echo $Inspection_Inspector; ?></th>
																			<th><?php echo $Inspection_Location; ?></th>
																			<th><?php echo $Inspection_Action; ?></th>
																		</tr>
																		<tr>
																			<td>
																				<input type="date" class="form-control" name="inspect_date" id="inspect_date"  value="<?php echo $appoint_date ; ?>" />
																			</td>
																			<td>
																				<input type="time" class="form-control" name="inspect_time" id="inspect_time" value="<?php echo $appoint_time ; ?>"   />
																			</td>
																			<td>
<!--																				<input type="text" class="form-control" name="inspector" id="inspector" value="--><?php //echo $staff_name ;?><!--" readonly />-->
																				<select name="inspector" id="inspector" class="form-control" required>
																					<option value="<?php echo $staff_name ;?>" > <?php echo $staff_name ;?> </option>
																					<?php
																					$stafflist = $this->db->query("SELECT * FROM staffdetails ORDER  by id DESC ");
																					$i=0;
																					foreach($stafflist->result_array('staffdetails') as $row1)
																					{
																						$access_page = $row1['access_page'];
																						$access_pages = explode(',', $access_page);
																						$insepc_page = true;
																						if(!in_array(MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_CREATE, $access_pages) && $flaged_val == 'no') {
																							$insepc_page = false;
																						}
																						if(!in_array(MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_CREATE, $access_pages)&& $flaged_val == 'yes') {
																							$insepc_page = false;
																						}
																						if($insepc_page == true) {
																							echo "<option value='" . $row1['username'] . "' >" . $row1['username'] . "</option>";
																						}
																						$i++;
																					}
																					?>
																				</select>
																			</td>
																			<td>
																				<input type="text" class="form-control" name="location" id="location" value="<?php echo $appoint_location ?>" />
																			</td>
																			<td>
																				<?php if($permission_inspection_editappointment == true) { ?>
																					<input type="checkbox" class="form-control" id="inspect_appoint"   />
																				<?php } else { ?>
																					<input type="checkbox" class="form-control" id="inspect_appoint"   disabled />
																				<?php } ?>
																			</td>
																		</tr>
																		</thead>
																	</table>
																</div>
															<?php } ?>
															<!--//////////////////////////accuratebackground api integrate//////////////////////-->

															<div style="margin-bottom: 30px;">
<!--																<a id="btn-save-accurate" class="btn btn-primary pull-right"  href="javascript:void(0)" >-->
<!--																	Request for Create a Candidate-->
<!--																</a>-->
																<a id="accrate_loading" class="btn btn-default pull-right"href="javascript:void(0)" style="margin-right: 20px; display:none" >
																	Loading...
																</a>
															</div>
															<h3><span>Accurate Background</span></h3>
															<div  class="tab-pane fade in active" >
																<P><span class="text-danger">Candidate</span></P>
																<div class="table-responsive">
																<table id="inspection-record" class="table user-list" style="width:100%;">
																	<thead>
																	<tr>
																		<th>Candidate ID</th>
																		<th>First Name</th>
																		<th>Last Name</th>
																		<th>Email</th>							
																		<th>Created Date</th>
																		<th>Updated Date</th>
																		<th>Action</th>
																	</tr>
																	</thead>
																	<tbody>
																	<tr>
																		<td><label id="accurate_id"><?php echo $ac_create_id ?></label></td>
																		<td><?php echo $ac_create_firstname ?></td>
																		<td><?php echo $ac_create_lastname ?></td>
																		<td><?php echo $ac_create_email ?></td>
																		<td><?php echo $ac_create_created ?></td>
																		<td><?php echo $ac_create_updated  ?></td>
																		<td>
																			<label>
																				<a class="btn btn-primary"  data-toggle="modal" data-target="#createaccurateModal" >
																					<i class="fa fa-info-circle fa-lg"></i>
																				</a>
																				<a  id="create_accurate" class="btn btn-primary"  >
																					<i class="fa fa-plus-circle fa-lg"></i>
																				</a>
																			</label>
																		</td>
																	</tr>
																</table>
																</div>
																<!-- Modal -->
																<div class="modal fade" id="createaccurateModal"  role="dialog"  >
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLabel">Candidate Information</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">&times;</span>
																				</button>
																			</div>
																			<div class="modal-body">
																					<?php echo str_replace(',',',<br />',$ac_create_all);?>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end modal-->
																<P><span class="text-danger">Place Order</span></P>
																<div class="table-responsive">
																	<table id="inspection-record" class="table user-list" style="width:100%;">
																		<thead>
																		<tr>
																			<th>Order ID</th>
																			<th>PackageType</th>
																			<th>Workflow</th>
																			<th>CopyOfReport</th>
																			<th>Created Date</th>
																			<th>Submitted Date</th>
																			<th>Updated Date</th>
																			<th>Action</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><label id="accurate_id"><?php echo $ac_order_id ?></label></td>
																			<td><?php echo $ac_order_packagetype ?></td>
																			<td><?php echo $ac_order_workflow ?></td>
																			<td><?php echo $ac_order_copyofreport ?></td>
																			<td><?php echo $ac_order_created ?></td>
																			<td><?php echo $ac_order_submitted ?></td>
																			<td><?php echo $ac_order_updated ?></td>
																			<td>
																				<label>
																					<a class="btn btn-primary"  data-toggle="modal" data-target="#orderaccurateModal" >
																						<i class="fa fa-info-circle fa-lg"></i>
																					</a>
																					<a  id="order_accurate" class="btn btn-primary"  >
																						<i class="fa fa-plus-circle fa-lg"></i>
																					</a>
																				</label>
																			</td>
																		</tr>
																	</table>
																</div>
																<!-- Modal -->
																<div class="modal fade" id="orderaccurateModal"  role="dialog"  >
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLabel">Place an Order</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">&times;</span>
																				</button>
																			</div>
																			<div class="modal-body">
																				<?php echo str_replace(',',',<br />',$ac_order_all);?>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end modal-->
																<P><span class="text-danger">Check Order Status</span></P>
																<div class="table-responsive">
																	<table id="inspection-record" class="table user-list" style="width:100%;">
																		<thead>
																		<tr>
																			<th>Order ID</th>
																			<th>PackageType</th>
																			<th>Workflow</th>
																			<th>CopyOfReport</th>
																			<th>Created Date</th>
																			<th>Submitted Date</th>
																			<th>Updated Date</th>
																			<th>Action</th>
																		</tr>
																		</thead>
																		<tbody>
																		<tr>
																			<td><label id="accurate_id"><?php echo $ac_check_id ?></label></td>
																			<td><?php echo $ac_check_packagetype ?></td>
																			<td><?php echo $ac_check_workflow ?></td>
																			<td><?php echo $ac_check_copyofreport ?></td>
																			<td><?php echo $ac_check_created ?></td>
																			<td><?php echo $ac_check_submitted ?></td>
																			<td><?php echo $ac_check_updated ?></td>
																			<td>
																				<label>
																					<a class="btn btn-primary"  data-toggle="modal" data-target="#checkaccurateModal" >
																						<i class="fa fa-info-circle fa-lg"></i>
																					</a>
																				</label>
																			</td>
																		</tr>
																	</table>
																</div>
																<!-- Modal -->
																<div class="modal fade" id="checkaccurateModal"  role="dialog"  >
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																			<div class="modal-header">
																				<h5 class="modal-title" id="exampleModalLabel">Check Order Status</h5>
																				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																					<span aria-hidden="true">&times;</span>
																				</button>
																			</div>
																			<div class="modal-body">
																				<?php echo str_replace(',',',<br />',$ac_check_all);?>
																			</div>
																			<div class="modal-footer">
																				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
																			</div>
																		</div>
																	</div>
																</div>
																<!--end modal-->
															</div>
															<!--//////////////////////////bank details start//////////////////////-->
															<?php if($permission_bank == true) { ?>
																<h3><span><?php echo $Bank_Details_lng; ?></span></h3>
																 <br />
																<div class="form-group">
																		<label class="col-lg-2 control-label" for="bank_name"><?php echo $Bank_name;  ?></label>
																		<div id="inputBankname" class="col-lg-10">
																			<?php if(empty($row->bank_name))  $row->bank_name = '' ; ?>
																				<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="bank_name" id="bank_name" class="form-control"  value="<?php echo $row->bank_name; ?>" required <?php echo $permission_bank_edit ?> />
																		 </div>
																	 <br/><br/>

																		 <label class="col-lg-2 control-label" for="bank_number"><?php echo $Bank_number; ?></label>
																		 <div id="inputBankNumber" class="col-lg-10">
																			 <?php if(empty($row->bank_number))  $row->bank_number = '' ; ?>
																		 <input  type="text" maxlength="9" pattern="([0-9]|[0-9]|[0-9])"  onkeydown="errorValidUser();"  name="bank_number" id="bank_number" class="form-control"  value="<?php echo $row->bank_number;?>" required <?php echo $permission_bank_edit ?> />
																		 </div>
																	<br/><br/>
																		 <label class="col-lg-2 control-label" for="bank_routing"><?php echo $Bank_routing; ?></label>
																		<div id="inputBankRouting" class="col-lg-10">
																			<?php if(empty($row->bank_routing))  $row->bank_routing = '' ; ?>
																		<input id="bank_routing" type="text" maxlength="9" pattern="([0-9]|[0-9]|[0-9])" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="bank_routing" id="bank_routing" class="form-control"  value="<?php echo $row->bank_routing;?>" required <?php echo $permission_bank_edit ?> />
																		</div>
																	<br/><br/>
																</div>
																<?php if($permission_bank_edit == '') { ?>
																 <div class="form-group">
																		 <div class="col-lg-offset-2 col-lg-2">
																		 <input class="btn-primary form-control" name="update_driver" type="submit" >
																</div>
																<?php } ?>
																<br />
															<?php } ?>
																<!-----------------------------------end BAnk detail------------------------------------------------------>

														</form>
																<!-----------------------------payment details start------------------------------------------------->
															<?php if($permission_payment == true) { ?>
																<h3><span><?php echo $Payment_Details_lng; ?></span></h3>
																<?php
																$currency = $this->db->query("SELECT currency FROM settings WHERE id=1")->row()->currency;
																?>
																<div class="col-lg-6">
																	<label><strong><?php echo $Payment_by_Cash_lng; ?>: </strong><?php echo $cash_payment->cash_payment.' '.$currency; ?></label><br/>
																	<label><strong><?php echo $Payment_by_Card_lng; ?>: </strong><?php echo $card_payment->card_payment.' '.$currency; ?></label><br/>
																	<label><strong><?php echo $Total_Payment_lng; ?>: </strong><?php echo $cash_payment->cash_payment+$card_payment->card_payment.' '.$currency; ?></label><br/>
																	<label><strong><?php echo $Current_Balance_lng; ?>: </strong><?php echo $current_balance.' '.$currency; ?></label><br/>
																	<label><strong><?php echo $Payment_Made_lng; ?>: </strong><?php echo $paid_balance.' '.$currency; ?></label>
																</div>
																<div class="col-lg-6">
																	<center><strong><?php echo $Data_Filter_lng; ?></strong></center><br/>
																	<label><strong><?php echo $Start_Date_lng; ?>:</strong>&nbsp;</label><input type="text" id="datepicker1" name="datepicker1" autocomplete="off"/>
																	<label><strong><?php echo $End_Date_lng; ?>:</strong>&nbsp;</label><input type="text" id="datepicker2" name="datepicker2" autocomplete="off"/>
																</div>
															<?php } ?>
																<!-----------------------------Driver earning------------------------------------------------->
																<div class="col-lg-12">
																	<ul class="nav nav-tabs" role="tablist">
																	<li role="presentation" class="active"><a href="#example1-tab1" aria-controls="example1-tab1" role="tab" data-toggle="tab"><?php echo $Driver_Earnings_lng; ?></a></li>
																	<li role="presentation"><a href="#example1-tab2" aria-controls="example1-tab2" role="tab" data-toggle="tab"><?php echo $Transaction_History_lng; ?></a></li>
																</ul>

																	<!-- Tab panes -->
																	<div class="tab-content">
																		<div role="tabpanel" class="tab-pane fade in active" id="example1-tab1">
																			<table id="example1" class="table user-list" style="width:100%;">
																				<thead>
																				<tr>
																					<th><a href="javascript:void(0);"><?php echo $Booking_ID_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Pickup_Location_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Drop_Location_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Pickup_Date_Time_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Total_Payment_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Payment_Type_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Driver_Commision_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Website_Commision_lng; ?></a></th>
																					<!--<th>Driver Status</th>
																					<th class="text-center">Status</th>
																					<th class="text-center">Action</th>-->
																				</tr>
																				</thead>
																			</table>
																		</div>
																		<div role="tabpanel" class="tab-pane fade" id="example1-tab2">
																			<center><button id="btn-add-transact" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"><?php echo $Make_Payment_lng; ?></button></center>
																			<!-- Modal -->
																			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
																				<div class="modal-dialog">
																					<div class="modal-content">
																						<div class="modal-header">
																							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
																							<h4 class="modal-title" id="myModalLabel"><?php echo $Add_New_Transaction_lng; ?></h4>
																						</div>
																						<div class="modal-body row">
																							<div class="col-lg-6">
																								<label for="transact-driverId" class="control-label"><?php echo $Driver_ID_lng; ?></label>
																								<input type="text" id="transact-driverId" name="transact-driverId" class="form-control" value="<?php echo $row->id; ?>" disabled/>
																							</div>
																							<div class="col-lg-6">
																								<label for="transact-driverName" class="control-label"><?php echo $Driver_Name_lng; ?></label>
																								<input type="text" id="transact-driverName" name="transact-driverName" class="form-control" value="<?php echo $row->name; ?>" disabled/>
																							</div>
																							<div class="col-lg-12">
																								<label for="transact-mode" class="control-label"><?php echo $Payment_Mode_lng; ?></label>
																								<select class="form-control" id="transact-mode" name="transact-mode">
																									<option value=""><?php echo $Select_Payment_Type_lng; ?></option>
																									<option value="1"><?php echo $Cash_lng; ?></option>
																									<option value="2"><?php echo $Card_Net_Banking_lng; ?></option>
																									<option value="3"><?php echo $Bank_Transfer_lng; ?></option>
																								</select>
																							</div>
																							<div class="col-lg-12">
																								<label for="transact-date" class="control-label"><?php echo $Payment_Date_lng; ?></label>
																								<input type="text" id="transact-date" name="transact-date" class="form-control" autocomplete="off"/>
																							</div>
																							<div class="col-lg-12">
																								<label for="transact-amount" class="control-label"><?php echo $Amount_lng; ?></label>
																								<input type="text" id="transact-amount" name="transact-amount" class="form-control" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
																							</div>
																							<div class="col-lg-12">
																								<label for="transact-description" class="control-label"><?php echo $Description_lng; ?></label>
																								<textarea id="transact-description" name="transact-description" class="form-control"></textarea>
																							</div>
																							<div class="col-lg-12">
																								<label for="transact-comment" class="control-label"><?php echo $Comment_lng; ?></label>
																								<textarea id="transact-comment" name="transact-comment" class="form-control"></textarea>
																							</div>
																						</div>
																						<div class="modal-footer">
																							<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $Close_lng; ?></button>
																							<button type="button" id="btn-save-transact" class="btn btn-primary"><?php echo $Save_changes_lng; ?></button>
																						</div>
																					</div>
																				</div>
																			</div>
																			<table id="example2" class="table user-list">
																				<thead>
																				<tr>
																					<th><a href="javascript:void(0);"><?php echo $Transaction_Id_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Driver_ID_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Payment_Made_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Payment_Date_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Amount_lng; ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Description_lng ?></a></th>
																					<th><a href="javascript:void(0);"><?php echo $Comment_lng; ?></a></th>
																				</tr>
																				</thead>
																			</table>
																		</div>
																	</div>
																</div>
													</div>

													<div class="tab-pane fade" id="tab-rating">
														<div class="row">
															<div class="col-lg-12">

																<section id="cd-timeline" class="cd-container">
																	<?php
																	$id = $_GET['id'];
																	//echo "SELECT ur.user_rate_id,ur.driver_comment,ur.user_rate,ur.create_date,d.name,d.image FROM `user_rate` ur JOIN driver_details d on ur.driver_id=d.id WHERE ur.user_id=$id ORDER by ur.user_rate_id DESC LIMIT 10";
																	$query_rating = $this->db->query("SELECT dr.driver_rate_id,dr.user_comment,dr.driver_rate,dr.create_date,u.name,u.image FROM `driver_rate` dr JOIN userdetails u on dr.user_id=u.id WHERE dr.driver_id=$id ORDER BY dr.driver_rate_id DESC LIMIT 10");
																	$result_rating = $query_rating->result_array();
																	if ($result_rating)
																	{
																	$i = 0;
																	foreach ($query_rating->result_array() as $row_rating) {
																		if ($i[0] && $i[2] && $i[4] && $i[6] && $i[8] && $i[10]) {
																		} else {
																			?>
																			<div class="cd-timeline-block">
																				<div
																					class="cd-timeline-img cd-movie">
																					<style>
																						.img-circle {
																							border-radius: 50%;
																							margin-top: -13px;
																							margin-left: -9px;
																						}
																					</style>
																					<!--													<i class="fa fa-photo"></i>-->
																					<?php
																					if ($row_rating['image']) {
																						?>
																						<i><img class="img-circle"
																								src="<?php echo base_url() . 'user_image/' . $row_rating['image']; ?>"
																								height="50"
																								width="50"></i>
																						<?php
																					} else {
																						?>
																						<i><img class="img-circle"
																								src="<?php echo base_url() ?>upload/no-image-icon.png"
																								height="50"
																								width="50"></i>
																						<?php
																					}
																					?>
																				</div>

																				<div class="cd-timeline-content">
																					<?php
																					$timestamp = $row_rating['create_date'];
																					//$timestamp ='2016-07-09 12:56:00';
																					$splitTimeStamp = explode(" ", $timestamp);
																					$date = $splitTimeStamp[0];
																					$time = $splitTimeStamp[1];
																					$newDate = date("d-m-Y", strtotime($date));

																					?>
																					<div class="row">
																						<div class="col-lg-7">
																							<h2 style="font-size:medium;"><?php echo date('d F Y', strtotime($newDate)); ?></h2>
																						</div>
																						<div class="col-lg-5">
																							<!--																<p class=""><b>Pickup Form :</b><br />The Imperail Heights,<br />150ft Ring Road, <br />Rajkot.</p>-->
																							<?php
																							$user_avrege = $row_rating['driver_rate'];
																							?>

																							<?php
																							for ($i = 1; $i <= $user_avrege; $i++) {
																								?>
																								<b style="color: red;">
																									&#9733;</b>
																								<?php
																							}
																							?>
																						</div>
																					</div>
																					<div class="row">
																						<div class="col-lg-12">
																							<h4><?php echo $row_rating['name']; ?></h4>
																						</div>
																					</div>
																					<div class="row">
																						<div class="col-lg-6">
																							<!--																<p class=""><b>Pickup Form :</b><br />The Imperail Heights,<br />150ft Ring Road, <br />Rajkot.</p>-->
																							<p style="width: 250px;">
																								<?php echo $row_rating['user_comment']; ?>
																							</p>
																						</div>

																					</div>

																				<span class="cd-date"
																					  style="margin-right: 5px;"><?php echo $time; ?></span>
																				</div>
																			</div>
																			<?php
																		}
																		$i++;
																	}


																	?>
																</section>

															</div>
															<div class="clearfix">
																<a class="btn btn-primary pull-right"
																   href="<?php echo base_url(); ?>admin/driver_rating?driver_id=<?php echo $id; ?>">Read
																	more</a>
															</div>
															<?php
															}
															else
															{
																echo "No Data Founds";
															}
															?>
															<div class="clearfix">
																<!--<a class="btn btn-primary pull-right" href="<?php echo base_url(); ?>admin/cancelpointview?id=<?php echo $row1['id']; ?>">Read more</a>-->
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						  	</div>
						</div>
					</div>

					<footer class="row" id="footer-bar" style="opacity: 1;">
						<p id="footer-copyright" class="col-xs-12">
							<?php echo $footer ?>
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
	<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<!-- this page specific inline scripts -->
	<script type="text/javascript">
		$(window).load(function() {
			$(".cover").fadeOut(2000);
		});

	$(document).ready(function() {
	  //CHARTS
	  function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
	});

	$(document).ready(function() {
        $.urlParam = function (name) {
            var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (!results) {
                return '';
            }
            return results[1] || '';
        };

        var filter = $.urlParam('id');

        if (!filter) {
            filter = '';
        }

        var filter1 = '';
        var filter2 = '';


        $("#datepicker1").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() + 1);
                $("#datepicker2").datepicker("option", "minDate", dt);
                $('#datepicker1').val(selected);
                filter1 = $('#datepicker1').val();
                $('.tab-pane #example1').DataTable().ajax.reload();
                $('.tab-pane #example2').DataTable().ajax.reload();
            }
        });
        $("#datepicker2").datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function (selected) {
                var dt = new Date(selected);
                dt.setDate(dt.getDate() - 1);
                $("#datepicker1").datepicker("option", "maxDate", dt);
                $('#datepicker2').val(selected);
                filter2 = $('#datepicker2').val();
                $('.tab-pane #example1').DataTable().ajax.reload();
                $('.tab-pane #example2').DataTable().ajax.reload();
            }
        });

        $('#datepicker1,#datepicker2').keyup(function(){
            filter1 = '';
            filter2 = '';
            $('.tab-pane #example1').DataTable().ajax.reload();
            $('.tab-pane #example2').DataTable().ajax.reload();
        });

        $('#transact-date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

		$('#inspection-record').DataTable({
			"bFilter": false,
			"bInfo": false,
//			"bPaginate" : false,
			"processing": true,
			"serverSide": true,
			//"oSearch": {"sSearch": filter},
			"aaSorting": [[0, 'desc']],
			"columnDefs": [
				{
					"targets": [0],
					"visible": true,
					"searchable": false,
					"sortable": true,
					"width": "10%"

				},
				{
					"targets": [1],
					"visible": true,
					"searchable": true,
					"sortable": false,
					"width": "20%"

				},
				{
					"targets": [2],
					"visible": true,
					"searchable": true,
					"sortable": false,
					"width": "20%"

				},
				{
					"targets": [3],
					"visible": true,
					"type": "numeric",
					"searchable": false,
					"sortable": false,
					"width": "10%"

				},
				{
					"targets": [4],
					"visible": true,
					"searchable": false,
					"sortable": false,
					"width": "10%"

				}
			],
			"ajax": {
				url: '<?php echo base_url(); ?>admin/get_driver_inspection_record', // json datasource
				type: "post",  // method  , by default get
				data: function(d){
					d.data_id =  filter;
//					d.min_date = filter1;
//					d.max_date = filter2;
				},
				error: function () {  // error handling
					$(".booking-grid-error").html("");
					$("#inspection-record").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
					$("#booking-grid_processing").css("display", "none");
				}
			}
		});

        $('.tab-pane #example1').DataTable({
            "processing": true,
            "serverSide": true,
            //"oSearch": {"sSearch": filter},
            "aaSorting": [[0, 'desc']],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": true,
                    "searchable": false,
                    "sortable": true,
                    "width": "10%"

                },
                {
                    "targets": [1],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "20%"

                },
                {
                    "targets": [2],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "20%"

                },
                {
                    "targets": [3],
                    "visible": true,
                    "type": "numeric",
                    "searchable": false,
                    "sortable": false,
                    "width": "10%"

                },
                {
                    "targets": [4],
                    "visible": true,
                    "searchable": false,
                    "sortable": true,
                    "width": "10%"

                },
                {
                    "targets": [5],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "10%"

                },
                {
                    "targets": [6],
                    "visible": true,
                    "searchable": false,
                    "sortable": false,
                    "width": "10%"

                }
            ],
            "ajax": {
                url: '<?php echo base_url(); ?>admin/get_driver_earnings_data', // json datasource
                type: "post",  // method  , by default get
                data: function(d){
                    d.data_id =  filter;
                    d.min_date = filter1;
                    d.max_date = filter2;
                },
                error: function () {  // error handling
                    $(".booking-grid-error").html("");
                    $("#example1").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#booking-grid_processing").css("display", "none");
                }
            }
        });


        $('.tab-pane #example2').DataTable({
            "processing": true,
            "serverSide": true,
            //"oSearch": {"sSearch": filter},
            "aaSorting": [[0, 'desc']],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": true,
                    "searchable": false,
                    "sortable": true,
                    "width": "10%"

                },
                {
                    "targets": [1],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "20%"

                },
                {
                    "targets": [2],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "20%"

                },
                {
                    "targets": [3],
                    "visible": true,
                    "type": "numeric",
                    "searchable": false,
                    "sortable": false,
                    "width": "10%"

                },
                {
                    "targets": [4],
                    "visible": true,
                    "searchable": false,
                    "sortable": true,
                    "width": "10%"

                },
                {
                    "targets": [5],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "10%"

                },
                {
                    "targets": [6],
                    "visible": true,
                    "searchable": true,
                    "sortable": false,
                    "width": "10%"

                }
            ],
            "ajax": {
                url: '<?php echo base_url(); ?>admin/get_transaction_history_data', // json datasource
                type: "post",  // method  , by default get
                data: function(d){
                    d.data_id =  filter;
                    d.min_date = filter1;
                    d.max_date = filter2;
                },
                error: function () {  // error handling
                    $(".booking-grid-error").html("");
                    $("#example2").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#booking-grid_processing").css("display", "none");
                }
            }
        });

        $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });

        $('#btn-save-transact').click(function () {
			$.ajax({
				url: '<?php echo base_url()?>admin/add_transact',
				data: {
					driverId: $('#transact-driverId').val(),
					transact_mode: $('#transact-mode').val(),
					transact_date:$('#transact-date').val(),
					transact_amount:$('#transact-amount').val(),
					transact_description:$('#transact-description').val(),
					transact_comment:$('#transact-comment').val()
				},
				type: 'post',
				success: function(output) {
					$('.tab-pane #example2').DataTable().ajax.reload();
					$('#myModal').modal('hide');
					window.location.reload();
				},
				error: function(e){
					alert('Something went wrong');
				}
			});
		});

		var appoint_id = <?php echo $appoint_id ;?>;
		if(appoint_id > 0) $('#inspect_appoint').attr('checked', true);

			$('#inspect_appoint').click(function () {
				var val = $('#inspect_appoint').prop('checked');
				$.ajax({
					url: '<?php echo base_url()?>admin/add_inspect_appoint',
					data: {
						inspect_date: $('#inspect_date').val(),
						inspect_time: $('#inspect_time').val(),
						inspector: $('#inspector').val(),
						location:$('#location').val(),
						driver_id: <?php echo $id; ?>,
						inspect_checked: val
					},
					type: 'post',
					dataType: 'json',	
					success: function(output) {
						if(val == false) {
							$('#inspect_date').val('');
							$('#inspect_time').val('');
							$('#inspect').val('');
							$('#inspection-appointment select[name="inspector"]').val('');
							$('#location').val('');
						}
					},
					error: function(e){
						alert('Something went wrong');
					}
				});
			});

			$('#create_accurate').click(function () {

				$('#accrate_loading').css('display','block');
					$.ajax({
					url: '<?php echo base_url()?>admin/add_accurate',
					data: {
						driver_id: '<?php  echo $id ; ?>',
						id :  '<?php echo $ac_create_id;?>', //accurate_id
						firstName: $('#driverName').val(),
						lastName:  $('#driverName').val(),
						email:	   $('#driver_email').val(),
						phone:     $('#driver_phone').val(),
						address :  $('#driver_address').val(),
						dateOfBirth : $('#driver_date_birth').val(),
						phone : $('#driver_phone').val(),
						ssn : $('#driver_ssn').val(),
						alias_firstName : '',
						alias_lastName : '',
						alias_middleName : '',
						governmentId_country : 'US', //US
						governmentId_type: 'SpyCard', //SpyCard
						governmentId_number : '', //ABC12345
						city : 'Irvine',
						region : 'CA',
						country : 'US',
						postalCode: '91234',
						prevEmployed :'',
						employments_employer : '',
						employments_country : '',
						employments_region : '',
						employments_city : '',
						employments_startDate : '',
						employments_endDate : '',
						employments_presentlyEmployed : '',
						employments_okToCall : '',
						educations_school : '',
						educations_country: '',
						educations_region : '',
						educations_city : '',
						educations_degree : '',
						educations_major : '',
						educations_startDate : '',
						educations_endDate : '',
						educations_graduated : '',
						educations_presentlyEnrolled : '',
						licenses_category : '',
						licenses_type : '',
						licenses_number: '',
						licenses_issuingAuthority : '',
						licenses_country : '' ,
						licenses_region : '',
						licenses_city: '',
						references_name: '',
						references_relationship : '',
						references_phone : '',
						references_email: '',
						references_country: '',
						references_region : '',
						references_city : '',
						references_postalCode : ''
					},
					type: 'post',
					success: function(outdata) {
						output = JSON.parse(outdata);
						$('#accrate_loading').css('display','none');
						location.reload();
					},
					error: function(e){
						alert('Something went wrong');
					}
				});
			});
			// check order status
			$('#order_accurate').click(function () {
				$('#accrate_loading').css('display','block');
				var order_id = '<?php echo $ac_order_id;?>';
				if(order_id == null || order_id == '')  return false;
				$.ajax({
					url: '<?php echo base_url()?>admin/check_order_accurate',
					data: {
						driver_id: '<?php  echo $id ; ?>',
						order_id :  '<?php echo $ac_order_id;?>', //order_id
					},
					type: 'post',
					success: function(outdata) {
						output = JSON.parse(outdata);
						$('#accrate_loading').css('display','none');
						location.reload();
					},
					error: function(e){
						alert('Something went wrong');
					}
				});
			});
    });
</script>
</body>
</html>
