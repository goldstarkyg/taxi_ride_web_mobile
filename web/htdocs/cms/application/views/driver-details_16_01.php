<!DOCTYPE html>
<?php
include ('language.php');
$id=$_GET['id'];
$query=$this->db->query("SELECT * FROM `driver_details` INNER JOIN `cabdetails` ON cabdetails.cab_id=driver_details.car_type WHERE driver_details.id=$id");
$row = $query->row('driver_details');

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
	if($query4->num_rows() > 0){
		$paid = $query4->row();
		if($paid->paid_amount!=NULL || $paid->paid_amount!='') {
			$paid_balance = $paid->paid_amount;
		}
		else{
			$paid_balance = 0;
		}
	}
	else{
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
?>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Driver Details - NaqilCom</title>
	
	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/bootstrap/bootstrap.min.css" />
	
	<!-- RTL support - for demo only -->
	<script src="js/demo-rtl.js"></script>	
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
											<form action="javascript:void(0);" enctype="multipart/form-data" method="post" class="form-horizontal" id="formAddUser" name="add_user" role="form">
                      <h3><span><?php echo $Driver_Details_lng; ?></span></h3>
                      <br />
												<div class="form-group">
													<label class="col-lg-2 control-label" for="drivername"><?php echo $profile_picture_lng; ?></label>
													<div id="inputDriverName" class="col-lg-10">
														<?php
														if($row->image) {
															?>
															<img  src="<?php echo base_url().'driverimages/'.$row->image; ?>" height="100" width="100">
															<?php
														}
														else{
															?>
															<img  src="<?php echo base_url() ?>upload/no-image-icon.png" height="100" width="100">
															<?php
														}
														?>
													</div>
												</div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="drivername"><?php echo $Name_lng; ?></label>
                        <div id="inputDriverName" class="col-lg-10">
                          <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->name;?>" readonly>
                        </div>
                      </div>
						<div class="form-group">
					   <label class="col-lg-2 control-label" for="drivername"><?php echo $Username_lng; ?></label>
					   <div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();" name="drivename" id="driverName" class="form-control" value="<?php echo $row->user_name;?>" readonly>
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivername"><?php echo $Email_lng; ?></label>
						<div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->email;?>" readonly>
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivername"><?php echo $Gender_lng; ?></label>
						<div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->gender;?>" readonly>
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivername"><?php echo $Date_Of_Birth_lng; ?></label>
						<div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->dob;?>" readonly>
						</div>
						</div>

                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="driveraddress"><?php echo $Address_lng; ?></label>
                        <div id="inputDriverAddress" class="col-lg-10">
                          <textarea rows="3" id="driverAddress" class="form-control"  readonly><?php echo $row->address;?></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="driverphone"><?php echo $Phone_NO_lng; ?></label>
                        <div id="inputDriverPhone" class="col-lg-10">
                          <div class="input-group">
														<span class="input-group-addon"><i class="fa fa-phone" ></i></span>
														<input type="text" id="driverPhone" class="form-control"  value="<?php echo $row->phone;?>" readonly>
													</div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="driveremail"><?php echo $Email_Address_lng; ?></label>
                        <div id="inputDriverEmail" class="col-lg-10">
                          <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="droparea" id="dropArea" class="form-control" value="<?php echo $row->email;?>" readonly>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="driverlicenseno"><?php echo $License_NO_lng; ?></label>
                        <div id="inputDriverLicenseNo" class="col-lg-10">
                          <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser(); name="licenseno" id="DriverLicenseNo" class="form-control" value="<?php echo $row->license_no;?>" readonly>
                        </div>
                      </div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivername"><?php echo $License_Expiry_Date_lng; ?></label>
						<div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->Lieasence_Expiry_Date;?>" readonly>
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivername"><?php echo $License_Plate_lng; ?></label>
						<div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->license_plate;?>" readonly>
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivername"><?php echo $Insurance_lng; ?></label>
						<div id="inputDriverName" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="drivename" id="driverName" class="form-control" value="<?php echo $row->Insurance;?>" readonly>
						</div>
						</div>
			<div class="form-group">
								<label class="col-lg-2 control-label" for="drivername"><?php echo $Change_Password_lng; ?></label>
								<div id="inputDriverName" class="col-lg-2">
									<a class="btn-primary form-control text-center" href="<?php echo base_url();?>admin/driver_change_password?id=<?php echo $id; ?>" ><?php echo $Change_Password_lng; ?></a>
								</div>
						</div>
                      <h3><span><?php echo $Car_Details_lng; ?></span></h3>
                      <br />
                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="drivercartype"><?php echo $Car_Type_lng; ?></label>
                        <div id="inputDriverCarType" class="col-lg-10">
                          <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="cartype" id="DriverCarType" class="form-control" readonly value="<?php echo $row->cartype; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 control-label" for="drivercarno"><?php echo  $Car_No_lng; ?></label>
                        <div id="inputDriverCarNo" class="col-lg-10">
                          <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="carno" id="CarLicenseNo" class="form-control" readonly value="<?php echo $row->car_no;?>">
                        </div>
                      </div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivercarno"><?php echo $Car_Model_lng; ?></label>
						<div id="inputDriverCarNo" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="carno" id="CarLicenseNo" class="form-control" readonly value="<?php echo $row->Car_Model;?>">
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivercarno"><?php echo $Car_Make_lng; ?></label>
						<div id="inputDriverCarNo" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="carno" id="CarLicenseNo" class="form-control" readonly value="<?php echo $row->Car_Make;?>">
						</div>
						</div>
						<div class="form-group">
						<label class="col-lg-2 control-label" for="drivercarno"><?php echo $Loading_Capacity_lng; ?></label>
						<div id="inputDriverCarNo" class="col-lg-10">
						<input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();"  name="carno" id="CarLicenseNo" class="form-control" readonly value="<?php echo $row->Seating_Capacity;?>">
						</div>
						</div>
                      <!--<div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                          <button style="display:block;" class="btn btn-success" onclick="return check_User();" id="notification-trigger-bouncyflip" type="submit">
                            <span id="category_button" class="content">SUBMIT</span>
                          </button>
                        </div>
                      </div>-->
                    </form>
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
                                                                        <h4 class="modal-title" id="myModalLabel"><?php echo Add_New_Transaction_lng; ?></h4>
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
    });
</script>
</body>
</html>
