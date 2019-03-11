<?php

include('language.php');
//$this->session->set_userdata('username','');
$this->session->sess_destroy();
$this->session->sess_create();
$arr = array('username-admin', 'username', 'staff-type', 'log-name', 'staff-id', 'role-admin','permission','permission_page');

foreach($arr as $h)
	if (!isset($_SESSION[$h]))
		$this->session->set_userdata($h, '');

if(isset($_POST['sublog'])) {
	$username = $_POST['email'];
	$password = md5($_POST['password']);
	$remember = '';
	if (isset($_POST['rememberme'])) {
		$remember = $_POST['rememberme'];
	}
	// Prep the query

	// Run the query
	$query = $this->db->query("select * from adminlogin where binary username ='$username' and binary password = '$password'");

	
	// Let's check if there are any results
	if ($query->num_rows == 1) {
		// If there is a user, then create session data
		//$row = $query->result_array();
		if ($remember == 'on' && $remember != '') {

			$cookie = array(
				'name' => 'username-admin',
				'value' => $username,
				'expire' => 86500
			);
			//  $this->ci->db->insert("UserCookies", array("CookieUserEmail"=>$userEmail, "CookieRandom"=>$randomString));
			$this->input->set_cookie($cookie);

			$this->input->cookie('username-admin', false);


		}


		$this->session->set_userdata('username-admin', $_POST['email']);
		$_SESSION['username-admin']= $_POST['email'];
		$this->session->set_userdata('username','admin');
		$_SESSION['username']= 'admin';
		$this->session->set_userdata('staff-type', 'admin');
		$_SESSION['staff-type'] = 'admin';
		$user = $this->session->userdata('username-admin');
		$this->session->set_userdata('log-name', $username);
		$_SESSION['log-name'] = $username;

		foreach ($query->result_array() as $row) {
			$this->session->set_userdata('role-admin', $row['role']);
			$_SESSION['role-admin'] = $row['role'];
			$this->session->set_userdata('staff-id', $row['id']);
			$_SESSION['staff-id'] = $row['id'];
		}
		$user1 = $this->session->userdata('role-admin');

		$this->db->select('B.rolename as rolename,A.role_id,A.page_id as pages');
		$this->db->from('role B');// I use aliasing make joins easier
		$this->db->join('role_permission A', ' B.r_id = A.role_id');
		$this->db->where('B.rolename', $user1);


		$query1 = $this->db->get();
		foreach ($query1->result_array() as $row1) {

			$this->session->set_userdata('permission', $row1['pages']);
			$_SESSION['permission'] = $row1['pages'];
		}
		$user2 = $this->session->userdata('permission');
		//return $row;
		
		if ($user2) {
			redirect(BASE_URL . "admin/dashboard");
		}


	}
}
	// If the previous process did not validate
	// then return false.
	
	///////////////staff loagin

if(isset($_POST['sublog']))
{
	$username = $_POST['email'];
	$password = md5($_POST['password']);
	$remember='';
	if(isset($_POST['rememberme'])){
		$remember = $_POST['rememberme'];
	}
	// Prep the query

	$query = $this->db->query("select * from staffdetails where binary username ='$username' and binary password = '$password'");

	// Let's check if there are any results
	if($query->num_rows == 1){
		// If there is a user, then create session data
		//$row = $query->result_array();
		$row_page = $query->row_array();
		$access_page = $row_page['access_page'];
		$access_pages = explode(',', $access_page);
		$this->session->set_userdata('permission_page', $access_pages);
		$_SESSION['permission_page'] = $access_pages;
		$this->session->set_userdata('staff-type','staff');
		$_SESSION['staff-type'] = 'staff';
		$this->session->set_userdata('staff-id',$row_page['id']);
		$_SESSION['staff-id'] = $row_page['id'];
		$this->session->set_userdata('log-name',$username);
		$_SESSION['log-name'] = $username;

		if($remember=='on' && $remember!=''){

			$cookie = array(
				'name'   => 'username-admin',
				'value'  => $username,
				'expire' => 86500
			);
			//  $this->ci->db->insert("UserCookies", array("CookieUserEmail"=>$userEmail, "CookieRandom"=>$randomString));
			$this->input->set_cookie($cookie);

			$this->input->cookie('username-admin', false);



		}


		$this->session->set_userdata('username-admin',$_POST['email']);
		$_SESSION['username-admin'] = $_POST['email'];
		$user = $this->session->userdata('username-admin');
		$this->session->set_userdata('username','staff');
		$_SESSION['username'] = 'staff';

		foreach($query->result_array() as $row){
			//$this->session->set_userdata('role-admin',$row['role']);
			$this->session->set_userdata('role-admin','admin');
			$_SESSION['role-admin'] = 'admin';
		}
		$user1 = $this->session->userdata('role-admin');

		$this->db->select('B.rolename as rolename,A.role_id,A.page_id as pages');
		$this->db->from('role B');// I use aliasing make joins easier
		$this->db->join('role_permission A', ' B.r_id = A.role_id');
		$this->db->where('B.rolename',$user1);


		$query1 = $this->db->get();
		foreach($query1->result_array() as $row1){

			$this->session->set_userdata('permission',$row1['pages']);
			$_SESSION['permission'] = $row1['pages'];
		}
		$user2 = $this->session->userdata('permission');

		//return $row;
		//echo $user1;
		if($user2)
		{
			redirect(BASE_URL."admin/dashboard");

		}
	}

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title><?php echo $header_title; ?></title>

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

	<!-- google font libraries -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
	<link type="image/x-icon" href="<?php echo base_url();?>upload/ocrides.png" rel="shortcut icon"/>

	<!--[if lt IE 9]>
	<script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
	<script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
	<![endif]-->
</head>
<body id="login-page-full">
<div id="login-full-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="login-box">
					<div id="login-box-holder">
						<div class="row">
							<div class="col-xs-12">
								<header id="login-header">
									<div id="login-logo">
										<img src="<?php echo base_url();?>upload/ocrides.png" alt="" height="100" />
									</div>
								</header>
								<div id="login-box-inner">
									<form role="form" id="adminlog" method="post">
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-user"></i></span>
											<input class="form-control" type="text" placeholder="Email address" autofocus name="email">
										</div>
										<div class="input-group">
											<span class="input-group-addon"><i class="fa fa-key"></i></span>
											<input type="password" class="form-control" placeholder="Password" name="password">
										</div>
										<div id="remember-me-wrapper">
											<div class="row">
												<div class="col-xs-6">
													<div class="checkbox-nice">
														<input type="checkbox" id="remember-me" name="rememberme" />
														<label for="remember-me">
															Remember me
														</label>
													</div>
												</div>

											</div>
										</div>
										<div class="row">
											<div class="col-xs-12">
												<button type="submit" id="sublog" name="sublog" class="btn btn-success col-xs-12">Login</button>
												<?php
												if(isset($_POST['sublog']))
												{
												if($query->num_rows == 0) {
													?>
													<p style="color: red; font-size: small;;">Wrong Username OR
														Password</p>
													<?php
												}
												}
												?>
											</div>

										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="config-tool" class="closed">
	<a id="config-tool-cog">
		<i class="fa fa-cog"></i>
	</a>

	<div id="config-tool-options">
		<h4>Layout Options</h4>
		<ul>
			<li>
				<div class="checkbox-nice">
					<input type="checkbox" id="config-fixed-header" />
					<label for="config-fixed-header">
						Fixed Header
					</label>
				</div>
			</li>
			<li>
				<div class="checkbox-nice">
					<input type="checkbox" id="config-fixed-sidebar" />
					<label for="config-fixed-sidebar">
						Fixed Left Menu
					</label>
				</div>
			</li>
			<li>
				<div class="checkbox-nice">
					<input type="checkbox" id="config-fixed-footer" />
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

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url();?>assets/adminlte/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/adminlte/plugins/iCheck/icheck.min.js"></script>

<!-- theme scripts -->
<script src="<?php echo base_url();?>application/views/js/scripts.js"></script>

<!-- this page specific inline scripts -->

</body>
</html>
