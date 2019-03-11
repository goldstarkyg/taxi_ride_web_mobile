<?php
include ('language.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>User Profile - <?php echo $header_title; ?></title>
	
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
  
  <style type="text/css">.modal-open .modal{ background:url(<?php echo base_url();?>application/views/img/transpharant.png) top left repeat;}</style>
<style>
		.goog-te-banner-frame.skiptranslate {
			display: none !important;
		}
		.goog-logo-link
        	{
         	   display: none !important;
       		 }
		.goog-te-gadget
       		 {
          	  color: #F2822E;
        	}
		body {
			top: 0px !important;
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
											<h1><?php echo $Admin_Profile_lng?></h1>
										</div>
                    <div class="pull-right">
                    	<ol class="breadcrumb">
												<li><a href="#"><?php echo $Home_lng;?></a></li>
												<li class="active"><span><?php echo $Admin_Profile_lng;?></span></li>
											</ol>
                    </div>
									</div>
								</div>
							</div>
              <div class="row">
								<div class="col-lg-12">
									<div class="main-box clearfix">
                  	<div class="panel">
                      <div class="panel-body">
                        <h2><?php echo $Admin_Profile_lng;?></h2>
                      </div>
                  	</div>
										<?php
										$sql="SELECT * FROM `adminlogin` WHERE role='admin'";
										$qry=mysql_query($sql);
										$data=mysql_fetch_array($qry);
										if(isset($_REQUEST["save"]))
										{
											$name = $_REQUEST['name'];
											$userName = $_REQUEST['userName'];
											$emailaddress = $_REQUEST['emailaddress'];
											$contactnumber = $_REQUEST['contactnumber'];
											if(empty($_FILES['userimage']['name']))
											{
												$image=$_REQUEST["himg"];

											}
											else
											{
												$image =  "adminimage/{$_FILES['userimage']['name']}";

												$result = move_uploaded_file($_FILES['userimage']['tmp_name'], $image);
											}
											$upcar = "UPDATE adminlogin SET name='$name',image='$image',username='$userName',email='$emailaddress',mobile='$contactnumber' WHERE role='admin'";
											$qr=mysql_query($upcar);
											if($qr)
											{
												redirect('admin/dashboard');
											}
										}

										?>
										<div class="main-box-body clearfix">
											<form  enctype="multipart/form-data" method="post" class="form-horizontal" id="formAddUser" name="add_user" role="form">
						<div class="form-group">
						<label class="col-lg-1 control-label" for="userimage"><?php echo $Image_lng;?></label>
						<div id="inputUserImg" class="col-lg-11">
							<img src="<?php echo base_url().$data['image']; ?>" alt="" href="100" width="100"/>
						<input type="file" name="userimage" id="userimage" class="form-control">
						<input type="hidden" value="<?php echo $data['image']; ?>" name="himg">
						</div>
						</div>
                      <div class="form-group">
                        <label class="col-lg-1 control-label" for="name"><?php echo $Name_lng;?></label>
                        <div id="inputUserName" class="col-lg-11">
                          <input type="text"  placeholder="<?php echo $Enter_name_lng;?>" name="name" id="name" class="form-control" value="<?php echo $data['name'];?>">
                        </div>
                      </div>
					  <div class="form-group">
					  <label class="col-lg-1 control-label" for="name"><?php echo $User_Name_lng;?></label>
					  <div id="inputUserName" class="col-lg-11">
					  <input type="text"  placeholder="<?php echo $Enter_userName_lng;?>" name="userName" id="userName" class="form-control" value="<?php echo $data['username']; ?>">
					  </div>
					  </div>
                      <div class="form-group">
                        <label class="col-lg-1 control-label" for="emailaddress"><?php echo $Email_lng;?></label>
                        <div id="inputEmailAddress" class="col-lg-11">
                          <input type="text"  placeholder="<?php echo $Enter_email_address_lng;?>" name="emailaddress" id="emailaddress" class="form-control" value="<?php echo $data['email'] ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="col-lg-1 control-label" for="contactnumber"><?php echo $Contact_No_lng;?></label>
                        <div id="inputContactNo" class="col-lg-11">
                          <input type="text"  placeholder="<?php echo $Enter_contact_number_lng;?>" name="contactnumber" id="contactnumber" class="form-control" value="<?php echo $data['mobile']; ?>" >
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-1 control-label" for="userroll"><?php echo $Role_lng;?></label>
                        <div id="inputUserRoll" class="col-lg-11">
                          <input type="text"  placeholder="Enter user roll" name="userroll" id="userRoll" class="form-control" readonly value="<?php echo $data['role']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-lg-offset-1 col-lg-10">
                          <button style="display:block;" class="btn btn-success" name="save" id="notification-trigger-bouncyflip" type="submit">
                            <span id="category_button" class="content"><?php echo $SUBMIT_lng;?></span>
                          </button>
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
							<?php echo $footer;?>
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
	
</body>
</html>
