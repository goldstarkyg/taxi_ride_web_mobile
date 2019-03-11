<?php
include ('language.php');
echo isset($_POST['update']);
if(isset($_POST['save']))
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = md5($_POST['password']);
	$access_page = $_POST['access_page'];

	$sql = "insert into staffdetails(username,email,mobile,password,access_page) values ('$username','$email','$mobile','$password','$access_page')";

	if($this-> db-> query($sql))
	{
		redirect(base_url()."admin/add_staff?flag=yes");
	}

	// $sql = "SELECT DISTINCT *,Round(((ACOS(SIN('$latitude' * PI() / 180) * SIN(latitude * PI() / 180) + COS('$latitude' * PI() / 180) * COS(latitude * PI() / 180) * COS(('$longitude'-longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515),(2)) AS distance FROM tp_artist Having distance <= $miles";

}

if(isset($_POST['update']))
{
	$username = $_POST['username'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$password = md5($_POST['password']);
	$access_page = $_POST['access_page'];
	$id= $_POST['id'];
	$edit_qry = "UPDATE `staffdetails` SET `username`='".$username."',`email`='".$email."',`password`='".$password."',`access_page`='".$access_page."' WHERE `id`=".$id;

	if($this-> db-> query($edit_qry))
	{
		redirect(base_url()."admin/add_staff?flag=yes");
	}


}
$username = '';
$email ='';
$mobile='';
$access_pages = array();

if(isset($_GET['id']))
{
	$id= $_GET['id'];
	$this->db->select('*');
	$this->db->from('staffdetails');
	$this->db->where('id', $id );
	$query = $this->db->get();

	if ( $query->num_rows() > 0 )
	{
		$row = $query->row_array();
		$username = $row['username'];
		$email = $row['email'];
		$mobile= $row['mobile'];
		$access_page = $row['access_page'];
		$access_pages = explode(',', $access_page);
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Add Staff - <?php echo $header_title; ?></title>

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
	<link href="<?php echo base_url();?>application/views/css/alerts-popup/pixel-admin.min.css" rel="stylesheet" type="text/css">

	<!-- Favicon -->
	<link type="image/x-icon" href="<?php echo base_url();?>upload/favicon.png" rel="shortcut icon" />

	<!-- google font libraries -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

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

	<style>
	div.col-lg-11{
    display:inline-block
}

	</style>




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

						<!-- CONTEST Popup -------------------------------------------------------------------------------------------------------------------->
						<div class="col-lg-12">
							<!-- Single Delete -->
							<div class="modal modal-alert modal-danger fade" id="uidemo-modals-alerts-delete-user">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<i style="font-size:35px;" class="glyphicon glyphicon-trash"></i>
										</div>
										<div class="modal-title"><?php echo $single_delete_alert_lng; ?></div>
										<div class="modal-body"></div>
										<div class="modal-footer">
											<button id="confirm-delete-button" onclick="delete_single_user_action()" data-dismiss="modal" class="btn btn-primary" type="button">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $OK_lng; ?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<input type="hidden" value="" id="bookedid" name="bookedid">
											<button id="cancel-delete-button" data-dismiss="modal" class="btn btn-primary" type="button"><?php echo $CANCEL_lng; ?></button>
										</div>
									</div> <!-- / .modal-content -->
								</div> <!-- / .modal-dialog -->
							</div> <!-- / .modal -->
							<!-- / Single Delete -->
							<!-- Multipal Delete -->
							<div class="modal modal-alert modal-danger fade" id="uidemo-modals-alerts-delete-multipaluser">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<i style="font-size:35px;" class="glyphicon glyphicon-trash"></i>
										</div>
										<div class="modal-title"><?php echo $single_delete_alert_lng; ?></div>
										<div class="modal-body"></div>
										<div class="modal-footer">
											<button onclick="delete_user()" data-dismiss="modal" class="btn btn-primary" type="button">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $OK_lng; ?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
											<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<button data-dismiss="modal" class="btn btn-primary" type="button"><?php echo $CANCEL_lng; ?></button>
										</div>
									</div> <!-- / .modal-content -->
								</div> <!-- / .modal-dialog -->
							</div> <!-- / .modal -->
							<!-- / Multipal Delete -->
						</div>
						<!-- CONTEST Popup -------------------------------------------------------------------------------------------------------------------->
							<div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix" >
										<div class="panel">
											<div class="panel-body">
												<h2 class="pull-left"><?php echo $Add_staff; ?></h2>
											</div>
										</div>

										<form  method="post" class="form-horizontal" id="staff_form" name="staff_form" role="form">
										<div class="main-box-body clearfix"  >
											<div class="form-group">
												<label class="col-lg-2" for="staff_name">UserName</label>
												<div  class="col-lg-10">
													<input type="text"   name="username" id="username" class="form-control"  value="<?php echo $username; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-2" for="staff_email">Email </label>
												<div  class="col-lg-10">
													<input type="text"  name="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-2 " for="staff_phone">Phone</label>
												<div  class="col-lg-10">
													<input type="text"  name="mobile" id="mobile" class="form-control"  value="<?php echo $mobile; ?>" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-2 " for="staff_phone">Password</label>
												<div  class="col-lg-10">
												<input type="password"   name="password" id="password" class="form-control"  value="" required>
												</div>
											</div>
											<div class="form-group">
												<label class="col-lg-2 " for="staff_phone">Confirm Password</label>
												<div  class="col-lg-10">
												<input type="password" name="conf_password" id="conf_password" class="form-control"  value="" required>
												</div>
											</div>
											<h2>Grant Access</h2>
												<br/>
											<div class="form-group" >
												<!--first  section-->
												<div class="col-lg-3" style="vertical-align: top;">
													<div>
														<label class="checkbox-inline">
															<input type="checkbox" value="<?php echo DASHBOARD ; ?>"  >Dashboard
														</label>
													</div>
													<div>
													<label class="checkbox-inline">
														<input type="checkbox"  value="<?php echo REAL_TIME_MAPPING ; ?>">Real Time Mapping
													</label>
													</div>
													<div>
													<label class="checkbox-inline">
														<input type="checkbox"  value="<?php echo DAILY_DRIVER_EARNINGS ; ?>">Daily driver Earning
													</label>
													</div>
													<!--manage user-->
													<div>
														<div>
															<label class="checkbox-inline">
																<input type="checkbox" value="<?php echo MANAGEUSER ; ?>" name="manageruser" onclick="confirmCheck('manageruser')">Manage User
															</label>
														</div>
														<div style="margin-left: 20px;" id="manageruser">
															<!--all usre-->
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" name='manageruser_alluser' value="<?php echo MANAGEUSER_ALLUSER ; ?>" onclick="confirmCheck('manageruser_alluser')">All User
																</label>
																<!--see details-->
																<div style="margin-left: 20px;" id="manageruser_alluser">
																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="manageruser_alluser_seedetail" value="<?php echo MANAGEUSER_ALLUSER_SEEDETAIL ; ?>" onclick="confirmCheck('manageruser_alluser_seedetail')">See Detail
																		</label>
																		<div style="margin-left: 20px;" id="manageruser_alluser_seedetail">
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEUSER_ALLUSER_SEEDETAIL_CHANGEPASSWORD ; ?>">Change Password
																			</label>
																		</div>
																	</div>
																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" value="<?php echo MANAGEUSER_ALLUSER_DELETE ; ?>">Delete
																		</label>
																	</div>
																</div>
																<!---->
															</div>
															<!--Flagged User-->
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEUSER_FLAGGEDUSER ; ?>">Flagged User
																</label>
															</div>
														</div>
													</div>
													<!--manage booking-->
													<div>
														<label class="checkbox-inline">
															<input type="checkbox" name="managebooking" value="<?php echo MANAGEBOOKING ; ?>" onclick="confirmCheck('managebooking')">Manage Booking
														</label>
													</div>
													<div style="margin-left: 20px;" id="managebooking">
														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="managebooking_allbooking" value="<?php echo MANAGEBOOKING_ALLBOOKING ; ?>" onclick="confirmCheck('managebooking_allbooking')" >All Booking
															</label>
														</div>
														<div style="margin-left: 20px;" id="managebooking_allbooking">
															<div>
																<div>
																	<label class="checkbox-inline">
																		<input type="checkbox" name="managebooking_allbooking_edit" value="<?php echo MANAGEBOOKING_ALLBOOKING_EDIT ; ?>" onclick="confirmCheck('managebooking_allbooking_edit')">Edit
																	</label>
																</div>
																<div style="margin-left: 20px;">
																	<label class="checkbox-inline" id="managebooking_allbooking_edit">
																		<input type="checkbox" value="<?php echo MANAGEBOOKING_ALLBOOKING_EDIT_EDITDRIVER ; ?>">Edit Driver
																	</label>
																</div>
															</div>
															<div
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEBOOKING_ALLBOOKING_DELETE ; ?>">Delete
																</label>
															</div>
														</div>


														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="managebooking_pendingbooking" value="<?php echo MANAGEBOOKING_PENDNINGBOOKING ; ?>" onclick="confirmCheck('managebooking_pendingbooking')" >Pending Booking
															</label>
														</div>
														<div style="margin-left: 20px;" id="managebooking_pendingbooking">
															<div>
																<div>
																	<label class="checkbox-inline">
																		<input type="checkbox" name="managebooking_pendingbooking_eidt" value="<?php echo MANAGEBOOKING_PENDNINGBOOKING_EDIT ; ?>" onclick="confirmCheck('managebooking_pendingbooking_eidt')">Edit
																	</label>
																</div>
																<div style="margin-left: 20px;" id="managebooking_pendingbooking_eidt">
																	<label class="checkbox-inline">
																		<input type="checkbox" value="<?php echo MANAGEBOOKING_PENDNINGBOOKING_EDIT_EDITDRIVER ; ?>">Edit Driver
																	</label>
																</div>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEBOOKING_PENDNINGBOOKING_DELETE ; ?>">Delete
																</label>
															</div>
														</div>


														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="managebooking_usercacelbooking" value="<?php echo MANAGEBOOKING_USERCANCELBOOKING ; ?>" onclick="confirmCheck('managebooking_usercacelbooking')" >User Canceled Booking
															</label>
														</div>
														<div style="margin-left: 20px;" id="managebooking_usercacelbooking">
															<div>
																<div>
																	<label class="checkbox-inline">
																		<input type="checkbox" name="managebooking_usercacelbooking_edit" value="<?php echo MANAGEBOOKING_USERCANCELBOOKING_EDIT ; ?>" onclick="confirmCheck('managebooking_usercacelbooking_edit')">Edit
																	</label>
																</div>
																<div style="margin-left: 20px;" id="managebooking_usercacelbooking_edit">
																	<label class="checkbox-inline">
																		<input type="checkbox" value="<?php echo MANAGEBOOKING_USERCANCELBOOKING_EDIT_EDITDRIVER ; ?>">Edit Driver
																	</label>
																</div>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEBOOKING_USERCANCELBOOKING_DELETE ; ?>">Delete
																</label>
															</div>
														</div>

														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="managebooking_drivercancelbooking" value="<?php echo MANAGEBOOKING_DRIVERCANCELBOOKING ; ?>" onclick="confirmCheck('managebooking_drivercancelbooking')">Driver Cancelled Booking
															</label>
														</div>
														<div style="margin-left: 20px;" name="managebooking_drivercancelbooking" >
															<div>
																<div>
																	<label class="checkbox-inline">
																		<input type="checkbox" name="managebooking_drivercancelbooking_edit" value="<?php echo MANAGEBOOKING_DRIVERCANCELBOOKING_EDIT ; ?>" onclick="confirmCheck('managebooking_drivercancelbooking_edit')" >Edit
																	</label>
																</div>
																<div style="margin-left: 20px;" id="managebooking_drivercancelbooking_edit">
																	<label class="checkbox-inline">
																		<input type="checkbox" value="<?php echo MANAGEBOOKING_DRIVERCANCELBOOKING_EDIT_EDITDRIVER ; ?>">Edit Driver
																	</label>
																</div>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEBOOKING_DRIVERCANCELBOOKING_DELETE ; ?>">Delete
																</label>
															</div>
														</div>
													</div>
												</div>
												<!---second section--->
												<div  class="col-lg-3" style="vertical-align: top;">
													<div>
														<label class="checkbox-inline">
															<input type="checkbox" name="managedriver" value="<?php echo MANAGEDRIVER ; ?>" onclick="confirmCheck('managedriver')">Manage Driver
														</label>
													</div>
													<div style="margin-left: 20px;" id="managedriver">
														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="managedriver_alldriver" value="<?php echo MANAGEDRIVER_ALLDRIVER ; ?>" onclick="confirmCheck('managedriver_alldriver')" >All Driver
															</label>
														</div>
														<div style="margin-left: 20px;" id="managedriver_alldriver" >
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_STATUS ; ?>">Status
																</label>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DELETE ; ?>">Delete
																</label>
															</div>
															<div>
																<div>
																	<label class="checkbox-inline">
																		<input type="checkbox" name="managedriver_alldriver_detail"  value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL ; ?>" onclick="confirmCheck('managedriver_alldriver_detail')" >Detail
																	</label>
																</div>
																<div style="margin-left: 20px;" id="managedriver_alldriver_detail" >
																	<div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" name="managedriver_alldriver_detail_general" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_general')" >General
																			</label>
																		</div>
																		<div style="margin-left: 20px;" id="managedriver_alldriver_detail_general">
																			<div>
																				<label class="checkbox-inline" >
																					<input type="checkbox"  name="managedriver_alldriver_detail_general_view" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_VIEW ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_general_view')" >View
																				</label>
																				<div style="margin-left: 20px;" id="managedriver_alldriver_detail_general_view">
																					<label class="checkbox-inline" >
																						<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_VIEW_SSN ; ?>">SSN
																					</label>
																				</div>
																			</div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_EDIT ; ?>">Edit
																				</label>
																			</div>
																		</div>
																	</div>


																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_alldriver_detail_changepass" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_changepass')">Change Password
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_alldriver_detail_changepass">
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS_VIEW ; ?>">View
																			</label>
																		</div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS_EDIT ; ?>">Edit
																			</label>
																		</div>
																	</div>

																	<div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" name="managedriver_alldriver_detail_cardetail" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_cardetail')">Car Details
																			</label>
																		</div>
																		<div style="margin-left: 20px;" id="managedriver_alldriver_detail_cardetail" >
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL_VIEW ; ?>" >View
																				</label>
																			</div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL_EDIT ; ?>">Edit
																				</label>
																			</div>
																		</div>
																	</div>

																	<div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" name="managedriver_alldriver_detail_inspection" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_inspection')">Inspection
																			</label>
																		</div>
																		<div style="margin-left: 20px;" id="managedriver_alldriver_detail_inspection" >
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_CREATE ; ?>" >Create
																				</label>
																			</div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_EDITAPPOINTMENT ; ?>">Edit Appointment
																				</label>
																			</div>
																		</div>
																	</div>



																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_alldriver_detail_bankdetail" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_bankdetail')">Bank Detail
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_alldriver_detail_bankdetail">
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_VIEW ; ?>">View
																			</label>
																		</div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_EDIT ; ?>">Edit
																			</label>
																		</div>
																	</div>

																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_alldriver_detail_paymentdetail" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL ; ?>" onclick="confirmCheck('managedriver_alldriver_detail_paymentdetail')" >Payment Detail
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_alldriver_detail_paymentdetail">
																		<div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL_VIEW ; ?>">View
																				</label>
																			</div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_EDIT ; ?>">Edit
																				</label>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>


														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="managedriver_flagdriver" value="<?php echo MANAGEDRIVER_FLAGDRIVER ; ?>" onclick="confirmCheck('managedriver_flagdriver')">Flagged Driver
															</label>
														</div>
														<div style="margin-left: 20px;" id="managedriver_flagdriver">
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_STATUS ; ?>">Status
																</label>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_DELETE ; ?>">Delete
																</label>
															</div>
															<div>
																<div>
																	<label class="checkbox-inline">
																		<input type="checkbox" name="managedriver_flagdriver_detail" value="<?php echo MANAGEDRIVER_FLAGDRIVER_DETAIL ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail')">Detail
																	</label>
																</div>
																<div style="margin-left: 20px;" id="managedriver_flagdriver_detail">
																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_flagdriver_detail_general" value="<?php echo MANAGEDRIVER_FLAGDRIVER_GENERAL ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail_general')" >General
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_flagdriver_detail_general">
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_GENERAL_VIEW ; ?>">View
																			</label>
																		</div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_GENERAL_EDIT ; ?>">Edit
																			</label>
																		</div>
																	</div>


																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_flagdriver_detail_changepass" value="<?php echo MANAGEDRIVER_FLAGDRIVER_CHANGEEPASS ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail_changepass')">Change Password
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_flagdriver_detail_changepass" >
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_CHANGEPASS_VIEW ; ?>">View
																			</label>
																		</div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_CHANGEPASS_EDIT ; ?>">Edit
																			</label>
																		</div>
																	</div>

																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_flagdriver_detail_cardetail" value="<?php echo MANAGEDRIVER_FLAGDRIVER_CARDETAIL ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail_cardetail')">Car details
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_flagdriver_detail_cardetail">
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_CARDETAIL_VIEW ; ?>">View
																			</label>
																		</div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_CARDETAIL_EDIT ; ?>">Edit
																			</label>
																		</div>
																	</div>

																	<div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" name="managedriver_flagdriver_detail_inspection" value="<?php echo MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail_inspection')">Inspection
																			</label>
																		</div>
																		<div style="margin-left: 20px;" id="managedriver_flagdriver_detail_inspection" >
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_CREATE ; ?>" >Create
																				</label>
																			</div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_EDITAPPOINTMENT ; ?>">Edit Appointment
																				</label>
																			</div>
																		</div>
																	</div>

																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_flagdriver_detail_bankdetail" value="<?php echo MANAGEDRIVER_FLAGDRIVER_BANKDETAIL ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail_bankdetail')">Bank Detail
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_flagdriver_detail_bankdetail">
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_BANKDETAIL_VIEW ; ?>">View
																			</label>
																		</div>
																		<div>
																			<label class="checkbox-inline">
																				<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_BANKDETAIL_EDIT ; ?>">Edit
																			</label>
																		</div>
																	</div>

																	<div>
																		<label class="checkbox-inline">
																			<input type="checkbox" name="managedriver_flagdriver_detail_paymentdetail" value="<?php echo MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL ; ?>" onclick="confirmCheck('managedriver_flagdriver_detail_paymentdetail')">Payment Detail
																		</label>
																	</div>
																	<div style="margin-left: 20px;" id="managedriver_flagdriver_detail_paymentdetail">
																		<div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL_VIEW ; ?>">View
																				</label>
																			</div>
																			<div>
																				<label class="checkbox-inline">
																					<input type="checkbox" value="<?php echo MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL_EDIT ; ?>">Edit
																				</label>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-------third section------>
												<div class="col-lg-3" style="vertical-align: top;">
													<div>
														<label class="checkbox-inline">
															<input type="checkbox" value="<?php echo MANAGECARTYPE ; ?>">Manage Car Type
														</label>
													</div>
													<div>
														<label class="checkbox-inline">
															<input type="checkbox" value="<?php echo MANAGEDELAYREASON ; ?>">Manage Delay Reason
														</label>
													</div>
													<div>
														<label class="checkbox-inline">
															<input type="checkbox" value="<?php echo CASHOUT ; ?>">Cashout
														</label>
													</div>
													<div>
														<div>
															<label class="checkbox-inline">
																<input type="checkbox" name="settings" value="<?php echo SETTINGS ; ?>" onclick="confirmCheck('settings')">Settings
															</label>
														</div>
														<div style="margin-left: 20px;" id="settings">
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo SETTINGS_UPDATESETTING ; ?>">Update Settings
																</label>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo SETTINGS_FIXPRICEAREA ; ?>">Fixed Price Area
																</label>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo SETTINGS_MANAGEDAYTIME ; ?>">Manage Day Time
																</label>
															</div>
															<div>
																<label class="checkbox-inline">
																	<input type="checkbox" value="<?php echo SETTINGS_COMMISIONSETTING ; ?>">Commision Settings
																</label>
															</div>
														</div>
													</div>
												</div>
												<!--four-->
												<input type="hidden" name="access_page" value=""/>
												<div class="col-lg-3">
													<?php if(isset($_GET['id'])){ ?>
														<button style="display:block;" class="btn btn-success"  name="update" id="staff_update" type="text"  onclick="sendSubmit()">
															<span id="category_button" class="content">Update</span>
														</button>
														<input type="hidden" name="id" value="<?=$id?>">
													<?php }else{?>
														<button style="display:block;" class="btn btn-success"  name="save" id="staff_save" type="text"  onclick="sendSubmit()">
															<span id="category_button" class="content">Save</span>
														</button>
													<?php } ?>
												</div>
											    <!---->
											 </div>
										</div>
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
<!--<script src="--><?php //echo base_url();?><!--application/views/js/jquery.dataTables.js"></script>-->
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

<!--<script src="--><?php //echo base_url();?><!--assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>-->
<!--<script src="--><?php //echo base_url();?><!--assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>-->
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
</script>
<script type="text/javascript" language="javascript" >

	function confirmCheck(divid){
		var current_check =  $('input[name="' + divid + '"]').prop("checked");
		if (current_check == true) 	checkAll(divid);
		else uncheckAll(divid);
	}
	//option all check
	function checkAll(divid) {
		$('#' + divid + ' :checkbox:enabled').prop('checked', true);
	}
	//option all uncheck
	function uncheckAll(divid) {
		$('#' + divid + ' :checkbox:enabled').prop('checked', false);
	}

	function sendSubmit() {

		var username= $('#staff_form input[name="username"]').val();
		if(username == '') {
			alert('Please check password.');
			return ;
		}
		var password= $('#staff_form input[name="password"]').val();
		var conf_password = $('#staff_form input[name="conf_password"]').val();
		if(password != conf_password || password == '') {
			alert('Please check password.');
			return ;
		}
		var email= $('#staff_form input[name="email"]').val();
		var email_chk = validateEmail(email);
		if(email_chk == false) {
			alert("Please check email.");
			return ;
		}
		var mobile= $('#staff_form input[name="mobile"]').val();
		if(mobile == '') {
			alert('Please check phone.');
			return ;
		}

		var values = '';
		$(':checkbox:checked').each(function(i){
			if($(this).val() !='on') values += $(this).val()+',';
		});
		values = values.substr(0, values.length-1);
		$('input[name="access_page"]').val(values);
		$( "#staff_form" ).submit();
	}

	function validateEmail(email) {
		var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return re.test(email);
	}

	var access_page_vals = <?php echo json_encode($access_pages); ?>;
	get_access_page();
	function get_access_page(){
		if(access_page_vals.length > 0) {
			$(':checkbox').each(function(i){
				var current_val = $(this).val();
				if ( $.inArray( current_val, access_page_vals ) > -1 ) {
					$(this).prop('checked', true);
				}else {
					$(this).prop('checked', false);
				}
			});
		}
	}



</script>
</body>
</html>
