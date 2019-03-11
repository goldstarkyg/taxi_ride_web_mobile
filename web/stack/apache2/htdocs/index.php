<?php 
require('include/connect.php');
require('cms/application/config/constants.php');
$timezone = CUSTOM_ZONE_NAME;
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<link rel="shortcut icon" href="images/favicon.png">

	<title>Top Ridez</title>
	<!-- Bootstrap Core CSS -->

	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<link href="vendor/fontawesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">

	<link href="vendor/animateit/animate.min.css" rel="stylesheet">
	<!-- Vendor css -->

	<link href="vendor/owlcarousel/owl.carousel.css" rel="stylesheet">

	<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
	<!-- Template base -->

	<link href="css/theme-base.css" rel="stylesheet">
	<!-- Template elements -->

	<link href="css/theme-elements.css" rel="stylesheet">

	<!-- this page specific styles -->
	<link rel="stylesheet" type="text/css" href="css/nifty-component.css"/>

	<!-- Responsive classes -->

	<link href="css/responsive.css" rel="stylesheet">
	<!--[if lt IE 9]>

		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

	<![endif]-->


	<!-- Template color -->

	<link href="css/color-variations/blue.css" rel="stylesheet" type="text/css" media="screen" title="blue">
	<!-- LOAD GOOGLE FONTS -->

	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,800,700,600%7CRaleway:100,300,600,700,800%7CSource+Sans+Pro:400,300,800,700,600" rel="stylesheet" type="text/css" />
	<!-- SLIDER REVOLUTION 5.x CSS SETTINGS -->

	<link rel="stylesheet" property="stylesheet" href="vendor/rs-plugin/css/settings.css" type="text/css" media="all" />

	<link rel="stylesheet" href="css/rs-plugin-styles.css" type="text/css" />
	<!-- CSS CUSTOM STYLE -->

	<link rel="stylesheet" type="text/css" href="css/liquid-slider.css" media="screen" />

    <link rel="stylesheet" type="text/css" href="css/custom.css" media="screen" />
    <!--VENDOR SCRIPT-->

    <script src="vendor/jquery/jquery-1.11.2.min.js"></script>

    <script src="vendor/plugins-compressed.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.4.1/moment-timezone-with-data-2010-2020.min.js"></script>

	<!-- booking code start-->
			<!-- jquery framework start-->
         	<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
			<!--<script src="vendor/datetimepicker/jquery.datetimepicker.full.js"></script>-->
			<script src="js/jquery.datetimepicker.full.js"></script>
			<link rel="stylesheet" type="text/css" href="vendor/sweetalert/sweetalert.min.css">
			<script src="vendor/sweetalert/sweetalert.min.js"></script>
			<link rel="stylesheet" href="vendor/tel_country_flag/css/intlTelInput.css">
  			<script src="vendor/tel_country_flag/js/intlTelInput.js"></script>
         	<!-- jquery framework over-->

         	<link type="text/css" rel="stylesheet" href="css/booking_style.css" />
			<script type="text/javascript" src="js/booking.js"></script>
         	<!-- start google place api -->
         	<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
	        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places&key=AIzaSyDo_HarmIoIN_Ieae55vEIQ-Fkd2rYHP6I"></script>
	        <script>
	            var search_from,search_to;
	            function initialize() {
	              search_from = new google.maps.places.Autocomplete(
	                  /** @type {HTMLInputElement} */(document.getElementById('search_from')),
	                  {types: ['geocode'] });
	              google.maps.event.addListener(search_from, 'place_changed', function() {
	              });
	              search_to = new google.maps.places.Autocomplete(
	                  /** @type {HTMLInputElement} */(document.getElementById('search_to')),
	                  { types: ['geocode'] });
	              google.maps.event.addListener(search_to, 'place_changed', function() {
	              });
	            }
	        </script>
	        <!-- modify google place api css -->
	        <style>
	        	.pac-container 
	        	{
	        		margin-top: 2px;
	        		margin-left: -22px;
    				width: 240px !important;
				}
	        </style>
         	<!-- over google place api  -->
	<!-- booking code over-->
<!--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5WgfHn67qGhlT_qAZOBiU5zMXz67qh"></script>-->
 <script type="https://maps.googleapis.com/maps/api/js?&sensor=false"></script>		
<script type="text/javascript">
jQuery(document).ready(function(){
	if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        alert("Geolocation is not supported by this browser.");
    }
});
function showPosition(position) {
    	var geocoder = new google.maps.Geocoder();
    	var lat = parseFloat(position.coords.latitude);
		var lng = parseFloat(position.coords.longitude);
		var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'latLng': latlng }, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        //alert("Location: " + results[1].formatted_address);
                        jQuery('#search_from').val(results[1].formatted_address);
                    }
                }
            });
}
</script>	
</head>
<body class="wide" onload="initialize()">

<!-- display car type detail start-->
<div class="modal fade" id="cartype_detail_main" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 400px; margin: 125px auto;">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Car Details</h4>
    </div>
    <div class="modal-body car_detail">
    </div>
    <div class="modal-footer text-center" style="border-top: 1px solid #e5e5e5 !important; padding-bottom: 6px !important;">
     <button data-dismiss="modal" type="button" class="btn btn-primary no-margin">OK / DONE</button>
    </div>
   </div>
  </div>
 </div>
<!-- display car type detail over-->
<!-- display boking start -->
 <!--<div class="modal fade" id="verification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="max-width: 375px;">
   <div class="modal-content">
    <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
     <h4 class="modal-title">Verify OTP</h4>
    </div>
    <div class="modal-body">
         <div class="form-group">
      	 	<label for="exampleInputPhoneNumber">Name :</label>
         	<input type="text" id="txt_name" name="txt_name" placeholder="Enter Name" class="form-control">	
      	 	<label for="exampleInputPhoneNumber">Email :</label>
         	<input type="text" id="txt_email" name="txt_email" placeholder="Enter Email" class="form-control">	
      	 	<label for="exampleInputPhoneNumber">Verification code :</label>
         	<input type="text" id="txt_otp" name="txt_otp" placeholder="Enter OTP number" class="form-control">	
      </div>
    </div>
    <div class="modal-footer">
        <input data-dismiss="" type="button" id="btn_submit" name="btn_submit" value="Verify" class="btn btn-primary">
        <button id="buttonreplacement2" class="btn buttonreplacement2">
			<img src="images/loading3.gif" alt="loading...">
		</button>
    </div>
   </div>
  </div>
 </div>
</form>-->
<!-- over car type detal -->
<!-- display booking detail start-->
<div class="md-modal md-effect-8 booking-details" id="booking_detail">
	<div class="md-content">
		<div class="modal-body">
			<div class="row">
				<div class="col-lg-12">
			 		<div class="car-type-lbl" id="floatingElement">
						<?php echo '<img src="'.BASE_URL.'car_image/'.$_SESSION['car_image'].'" width="40px"> &nbsp;'.$_SESSION['booking_cartype']; ?>
					</div>
					<button onclick="close_modal()" class="md-close close popup-close">&times;</button>
					<div class="liquid-slider" id="slider-4">
						<div id="slide-1" style="min-height: 400px;">
						</div>
						<div id="slide-2">
							<br />
							<div class="text-center">
								<img src="images/mobile-image.png" alt="" width="75px" style="padding-bottom: 10px; opacity: 0.8">
								<span class="help-block">We will send you a One time <br />SMS message.</span>
							</div>
							<br />
							<div class="form-group col-md-2 col-md-offset-2">
								<div class="input-group">
									<input id="txt_countrycode" name="txt_countrycode" class="form-control" type="tel" autocomplete="off" value="+41" />
								</div>
							</div>
							<div class="form-group col-md-6">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span>
									<input id="txt_phoneno" name="txt_phoneno" class="form-control" type="text" placeholder="Mobile number">
								</div>
							</div>
							<br />
						</div>
						<div id="slide-3">
							<br />
							<div class="text-center">
								<img src="images/done1.png" alt="" width="75px" style="padding-bottom: 10px; opacity: 0.8">
								<h3 style="padding-bottom: 12px;">Verification Code</h3>
								<span class="help-block1"></span>
							</div>
							<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4">
	<input id="txt_name" name="txt_name" class="form-control text-center" type="text" placeholder="Enter Name">
								</div>
							</div>
							<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4">
	<input id="txt_email" name="txt_email" class="form-control text-center" type="text" placeholder="Enter Email"/>
								</div>
							</div>
							<div class="form-group">
								<div class="input-group col-md-4 col-md-offset-4">
	<input id="txt_otp" name="txt_otp" class="form-control text-center" type="text" placeholder="Enter OTP"/>
								</div>
							</div>
						</div>
				    </div>	
				</div>
			</div>
		</div>		
		<div class="modal-footer">
			<button type="button" class="btn btn-link resend-button" id="resendButton">Resend</button>
			<button type="button" id="verifyOTP" class="btn btn-primary">VERIFY</button>
			<button id="buttonreplacement2" class="btn buttonreplacement2">
				<img src="images/loading3.gif" alt="loading...">
			</button>
			<button type="button" id="sendOTP" class="btn btn-primary">SEND OTP</button>
			<button type="button" id="confirmBooking" class="btn btn-primary" onclick="api2.setNextPanel(1);api2.updateClass($(this)), confirmbooking()">CONFIRM</button><!---->
			<!--<button id="btn_save" data-dismiss="modal" type="button" class="btn btn-primary no-margin" style="width:110px;">cancel</button> -->
			<!--<input type="button" id="btn_next" name="btn_next" value="Confirm" class="btn btn-primary" style="width:120px;">
    	 	<input type="button" id="btn_send" name="btn_send" value="Send Code" class="btn btn-primary" style="width:120px;display: none;">-->
    	 	<button id="buttonreplacement1" class="btn buttonreplacement1">
				<img src="images/loading3.gif" alt="loading...">
			</button>
		</div>
	</div>
</div>
<!-- display booking detail over-->
<!-- BOKKING HTML CODE OVER  -->

	<!--SITE LOADER-->

	<div class="loader-wrapper">

		<div class="loader"> <img width="40" src="images/svg-loaders/puff.svg" alt=""> <span class="loader-title">Page is loading, just a sec...</span> </div>

	</div>

	<!--END: SITE LOADER-->
	<!--WRAPPER-->

	<div class="wrapper">

		<!-- HEADER -->

		<header id="header" class="header-dark header-transparent header-navigation-light">

			<div id="header-wrap">

				<div class="container">
					<!--LOGO-->

					<div id="logo">

						<a href="index.php" class="logo" data-dark-logo="images/ocrides.png">

							<img src="images/ocrides.png" alt="OC-Rides">

						</a>

					</div>

					<!--END: LOGO-->
					<!--MOBILE MENU -->

					<div class="nav-main-menu-responsive">

						<button class="lines-button x">

							<span class="lines"></span>

						</button>

					</div>

					<!--END: MOBILE MENU -->
					<!--NAVIGATION-->

					<div class="navbar-collapse collapse main-menu-collapse navigation-wrap">

						<div class="container">

							<nav id="mainMenu" class="main-menu mega-menu">

								<ul class="main-menu nav nav-pills">

									<li><a href="#"><i class="fa fa-home"></i></a>

									</li>

									<li><a href="#service">Services</a></li>

									<li><a href="#features">App</a></li>

									<li><a href="#howtouse">How to use</a></li>

									<li><a href="#simplicity">Driver Partner</a></li>
									
									<li><a href="#jobs">Jobs</a></li>

								</ul>

							</nav>

						</div>

					</div>

					<!--END: NAVIGATION-->

				</div>

			</div>

		</header>

		<!-- END: HEADER -->


		<!-- REVOLUTION SLIDER -->

		<div id="slider" class=" hidden-sm hidden-xs">
					<!--New Form Design-->
				     <div class="booking-form">
				     <div class="booking-form-in">
				      <div class="row">
				       <div class="col-md-3">
				        <div class="form-group">
				         <label class="upper" for="name">From Address</label>
				         <div class="input-group">
				          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
				            <div id="locationField">
								  <input id="search_from" name="search_from" onFocus="geolocate()" class="form-control required"  placeholder="From airport,hotel or location"  type="text">
						 	</div>
				         </div>
				        </div>
				       </div>
				       <div class="col-md-3">
				        <div class="form-group">
				         <label class="upper" for="email">To Address</label>
				         <div class="input-group">
				          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
				         	<div id="locationField">
				         		<input id="search_to" name="search_to" onFocus="geolocate()"  class="form-control required email"  placeholder="To hotel, airport or location"  type="text">
							</div>
				         </div>
				        </div>
				       </div>
				       <div class="col-md-2">
				        <div class="form-group">
				         <label class="upper" for="bookingDateTime">Date & Time</label>
				         <div class="input-group">
				          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				          	<input id="booking_datetime" name="booking_datetime" class="form-control datetime1"  placeholder="Date/Time"  type="text">
				         </div>
				        </div>
				       </div>
				       <div class="col-md-2">
				        <div class="form-group" id="booking_pessenger_div">
				         <label class="upper" for="phone">No Of Members</label>
				         <div class="input-group">
				          <span class="input-group-addon"><i class="fa fa-users"></i></span>
				          		<input id="booking_pessenger" name="booking_pessenger" value="0" class="form-control required" placeholder="Pessengers" type="text" readonly="readonly">
				         </div>
				        		<div class="booking_display_pessengere">
									<div class="row">
								        <div class="col-lg-6">
								          	<div class="input-group agewise-members-count">
									           	<span class="input-group-addon no-padding">
										            <button id="passenger_add1" class="btn no-margin btn-increse">+</button>
									           	</span>
									           		<input id="passenger_no1" class="form-control members-count text-center" type="text" value="0" readonly>
												<span class="input-group-addon no-padding">
													<button id="passenger_sub1" class="btn no-margin btn-decrese">-</button>
												</span>
											</div>
										</div>
										<div class="col-lg-6 text-left count-label">
											Adult (13+)
										</div>
									</div>
									<hr />
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group agewise-members-count">
												<span class="input-group-addon no-padding">
													<button id="passenger_add2"  class="btn no-margin btn-increse">+</button>
												</span>
													<input id="passenger_no2" readonly value="0" class="form-control members-count text-center" type="text">
												<span class="input-group-addon no-padding">
													<button id="passenger_sub2" class="btn no-margin btn-decrese">-</button>
												</span>
											</div>
										</div>
										<div class="col-lg-6 text-left count-label">
											Child (&lt;13)
										</div>
									</div>
									<hr />
                                    <div class="row">
										<div class="col-lg-6">
											<div class="input-group agewise-members-count">
												<span class="input-group-addon no-padding">
													<button id="passenger_add3"  class="btn no-margin btn-increse">+</button>
												</span>
													<input id="passenger_no3" readonly value="0" class="form-control members-count text-center" type="text">
												<span class="input-group-addon no-padding">
													<button id="passenger_sub3" class="btn no-margin btn-decrese">-</button>
												</span>
											</div>
										</div>
										<div class="col-lg-6 text-left count-label">
											Child (&lt;7)
										</div>
									</div>
									<hr />
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group agewise-members-count">
												<span class="input-group-addon no-padding">
													<button id="passenger_add4" class="btn no-margin btn-increse">+</button>
												</span>
													<input id="passenger_no4" value="0" readonly class="form-control members-count text-center" type="text">
												<span class="input-group-addon no-padding">
													 <button id="passenger_sub4" class="btn no-margin btn-decrese">-</button>
												</span>	
											</div>
										</div>
										<div class="col-lg-6 text-left count-label">
											Infant (&lt;1)
										</div>
									</div>
								</div>
				        </div>
				       </div>
				       <div class="col-md-2">
				        <div class="form-group" id="booking_cartype_div">
				         <label class="upper" for="phone">Car Type</label>
				         <div class="input-group">
				          <span class="input-group-addon"><i class="fa fa-cab"></i></span>
				         		 <input id="booking_cartype" name="booking_cartype" class="form-control required" placeholder="Select Car"  type="text" readonly>
				         </div>
				        		<div class="booking_display_cartype">
				        			 <?php
										// call for get car type //
										$curl = curl_init();
										curl_setopt_array($curl, array(
											CURLOPT_RETURNTRANSFER => 1,
											CURLOPT_URL => BASEPATH.'/api/get_cartype.php',
											CURLOPT_USERAGENT => 'cURL Request',
											CURLOPT_POST => 1,
											CURLOPT_POSTFIELDS => array()
										));
										$resp = curl_exec($curl);
										curl_close($curl);
										$data=json_decode($resp,true);
										if($data['success'])
										{
											$i=0;
											$count=count($data["data"]["cab_id"]);
											while($i<$count)
											{
												?>	
						        			 	<div class="clearfix cartype-option">
						        			 		<div class="pull-left text-right cartype-opt-image">
						        			 			<a data="<?php echo $data["data"]["cab_id"][$i]["cab_id"];?>" class="list_img" data-toggle="modal" href="#cartype_detail_main">
															&nbsp;&nbsp;<img src="http://192.169.145.50/cms/car_image/<?php echo $data["data"]["icon"][$i]["icon"];?>" style="width:50px;height: 50px;">	&nbsp;	&nbsp;
														</a>
						        			 		</div>
						        			 		<div class="pull-left" style="line-height: 50px;">
						        			 			<div 
															class="list_div" 
															data="<?php echo $data["data"]["cab_id"][$i]["cab_id"];?>" 
															value="<?php echo $data["data"]["cartype"][$i]["cartype"];?>"
															>
																<?php echo $data["data"]["cartype"][$i]["cartype"];?>
														</div>
						        			 		</div>
						        			 		</div>
												<?php
													if($i<$count-1)
													{
														echo "<hr/>";
													}
													$i++;
											}
										}
									?>
								</div>
				        </div>
				       </div>
				      </div>

				      <div class="clearfix">
					       	<a id="btn_booking" name="btn_booking" value="Book" class="md-trigger btn btn-primary pull-right booking_submit">
					        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Book&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					        </a>
					        <input type="hidden" name="timezone" id="timezone" value="<?php echo $timezone; ?>" />
					        <div id="buttonreplacement" class="btn buttonreplacement pull-right booking_submit">
								<img src="images/loading3.gif" alt="loading...">
							</div>
				       	 	<a class="btn_hide" data-toggle="modal" href="" data-modal=""></a>
				      </div>
				      </div>
				     </div>
     				<!--New Form Design-->

<div id="rev_slider_6_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="OC-Rides App Showcase" style="margin:0px auto;background-color:#333;padding:0px;margin-top:0px;margin-bottom:0px;">

<!-- START REVOLUTION SLIDER 5.1 fullwidth mode -->

	<div id="rev_slider_6_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.1">

		<ul>	<!-- SLIDE  -->

			<li data-index="rs-21" data-transition="fade" data-slotamount="7" data-easein="default" data-easeout="default" data-masterspeed="600" data-rotate="0" data-saveperformance="on" data-title="Slide" data-description="">

				<!-- MAIN IMAGE -->

				<img src="images/okaytaxi_slides/traffic.jpg"  alt=""  width="1900" height="1200" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

				<!-- LAYERS -->
				<!-- LAYER NR. 1 -->

				<div class="tp-caption miami_title_60px   tp-resizeme" 

					 id="slide-21-layer-1" 

					 data-x="['center','center','center','center']" data-hoffset="['207','207','169','2']" 

					 data-y="['middle','middle','middle','middle']" data-voffset="['-92','-92','-174','55']" 

								data-fontsize="['60','60','50','50']"

					data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:-30;z:0;rX:90;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 

					 data-transform_out="opacity:0;s:240;s:240;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 5; white-space: nowrap;border-color:rgba(0, 0, 0, 1.00);">BEST IN SWITZERLAND

				</div>
				<!-- LAYER NR. 3 -->

				<div class="tp-caption Miami_nostyle   tp-resizeme" 

					 id="slide-21-layer-3" 

					 data-x="['left']" data-hoffset="['600']" 

					 data-y="['top']" data-voffset="['300']" 

								data-width=""

					data-height=""

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:300;e:Power3.easeInOut;" 

					 data-transform_out="auto:auto;s:260;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 7; min-width: px; max-width: px; max-width: px; max-width: px; white-space: nowrap;font-family:Arial;border-color:rgba(34, 34, 34, 1.00);">

						<a href="#" class="btn btn-warning rounded"><span><i class="fa fa-android"></i> Download</span></a> 

				</div>

				<!-- LAYER NR. 3 -->

				<div class="tp-caption Miami_nostyle   tp-resizeme" 

					 id="slide-21-layer-3" 

					 data-x="['left']" data-hoffset="['800']" 

					 data-y="['top']" data-voffset="['300']" 

								data-width=""

					data-height=""

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:300;e:Power3.easeInOut;" 

					 data-transform_out="auto:auto;s:260;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 7; min-width: px; max-width: px; max-width: px; max-width: px; white-space: nowrap;font-family:Arial;border-color:rgba(34, 34, 34, 1.00);">

						<a href="#" class="btn btn-warning rounded"><span><i class="fa fa-apple"></i> Download</span></a> 

				</div>
				<!-- LAYER NR. 4 -->

				<div class="tp-caption divideline4pxdark   tp-resizeme" 

					 id="slide-21-layer-4" 

					 data-x="['center','center','center','center']" data-hoffset="['32','32','26','-143']" 

					 data-y="['middle','middle','middle','middle']" data-voffset="['-133','-133','-212','21']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:25;z:0;rX:-70;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 

					 data-transform_out="opacity:0;s:300;s:300;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 8; white-space: nowrap;font-family:Arial;background-color:rgba(255, 255, 255, 100.00);border-color:rgba(255, 255, 255, 1.00);"> 

				</div>
				<!-- LAYER NR. 5 -->

				<div class="tp-caption   tp-resizeme" 

					 id="slide-21-layer-5" 

					 data-x="['left','left','left','left']" data-hoffset="['62','62','-8','7']" 

					 data-y="['top','top','top','top']" data-voffset="['213','213','186','6']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:5;sY:5;skX:0;skY:0;opacity:0;s:900;e:Power3.easeInOut;" 

					 data-transform_out="auto:auto;s:300;" 

					data-start="300" 

					data-responsive_offset="on" 
					

					style="z-index: 9;"><img src="images/okaytaxi_slides/app-1.png" alt="" width="428" height="470" data-ww="['428px','428px','428px','322px']" data-hh="['470px','470px','470px','354px']" data-no-retina> 

				</div>
				<!-- LAYER NR. 6 -->

				<div class="tp-caption   tp-resizeme" 

					 id="slide-21-layer-6" 

					 data-x="['left','left','left','left']" data-hoffset="['107','107','-19','50']" 

					 data-y="['top','top','top','top']" data-voffset="['184','184','144','-12']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:5;sY:5;skX:0;skY:0;opacity:0;s:900;e:Power3.easeInOut;" 

					 data-transform_out="auto:auto;s:300;" 

					data-start="800" 

					data-responsive_offset="on" 
					

					style="z-index: 10;"><img src="images/okaytaxi_slides/app-2.png" alt="" width="428" height="470" data-ww="['428px','428px','428px','356px']" data-hh="['470px','470px','470px','392px']" data-no-retina> 

				</div>
				<!-- LAYER NR. 7 -->

				<div class="tp-caption   tp-resizeme" 

					 id="slide-21-layer-7" 

					 data-x="['left','left','left','left']" data-hoffset="['163','163','-34','113']" 

					 data-y="['top','top','top','top']" data-voffset="['180','180','115','-12']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:0;z:0;rX:0;rY:0;rZ:0;sX:5;sY:5;skX:0;skY:0;opacity:0;s:900;e:Power3.easeInOut;" 

					 data-transform_out="auto:auto;s:300;" 

					data-start="1300" 

					data-responsive_offset="on" 
					

					style="z-index: 11;"><img src="images/okaytaxi_slides/app-3.png" alt="" width="428" height="470" data-ww="['428px','428px','428px','353px']" data-hh="['470px','470px','470px','389px']" data-no-retina> 

				</div>

			</li>

			<!-- SLIDE  -->

			<li data-index="rs-22" data-transition="fade" data-slotamount="7"  data-easein="default" data-easeout="default" data-masterspeed="600"  data-rotate="0"  data-saveperformance="on"  data-title="Slide" data-description="">

				<!-- MAIN IMAGE -->

				<img src="images/okaytaxi_slides/traffic_2.jpg"  alt=""  width="1900" height="1200" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

				<!-- LAYERS -->
				<!-- LAYER NR. 1 -->

				<div class="tp-caption miami_title_60px   tp-resizeme" 

					 id="slide-22-layer-1" 

					 data-x="['center','center','center','center']" data-hoffset="['-196','-230','-188','0']" 

					 data-y="['middle','middle','middle','middle']" data-voffset="['-63','-43','-137','-272']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:-30;z:0;rX:90;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 

					 data-transform_out="opacity:0;s:220;s:220;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 5; white-space: nowrap;border-color:rgba(0, 0, 0, 1.00);">Top Ridez

				</div>
				<!-- LAYER NR. 2 -->

				<div class="tp-caption miami_content_light   tp-resizeme" 

					 id="slide-22-layer-2" 

					 data-x="['center','center','center','center']" data-hoffset="['-250','-273','-203','-4']" 

					 data-y="['middle','middle','middle','middle']" data-voffset="['80','36','-29','-211']" 

								data-fontsize="['22','22','18','16']"

					data-width="['415','387','333','406']"

					data-height="['218','none','143','none']"

					data-whitespace="normal"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:25;z:0;rX:-70;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 

					 data-transform_out="opacity:0;s:280;s:280;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 6; min-width: 415px; max-width: 415px; max-width: 218px; max-width: 218px; white-space: normal; color: rgba(255, 255, 255, 1.00);text-align:right;border-color:rgba(0, 0, 0, 1.00);">Get a Taxi - Best price

				</div>
				<!-- LAYER NR. 3 -->

				<div class="tp-caption divideline4pxdark   tp-resizeme" 

					 id="slide-22-layer-3" 

					 data-x="['center','center','center','center']" data-hoffset="['-60','-94','-55','0']" 

					 data-y="['middle','middle','middle','middle']" data-voffset="['-106','-81','-173','-312']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="x:0;y:25;z:0;rX:-70;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:800;e:Power3.easeInOut;" 

					 data-transform_out="opacity:0;s:300;s:300;" 

					data-start="300" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 7; white-space: nowrap;font-family:Arial;background-color:rgba(255, 255, 255, 100.00);border-color:rgba(255, 255, 255, 1.00);"> 

				</div>
				<!-- LAYER NR. 4 -->

				<div class="tp-caption noshadow   tp-resizeme" 

					 id="slide-22-layer-4" 

					 data-x="['center','center','center','center']" data-hoffset="['-140','-163','-122','7']" 

					 data-y="['middle','middle','middle','middle']" data-voffset="['50','115','19','-151']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="y:50px;opacity:0;s:800;e:Power3.easeInOut;" 

					 data-transform_out="opacity:0;s:270;s:270;" 

					data-start="1000" 

					data-splitin="none" 

					data-splitout="none" 

					data-responsive_offset="on" 
					

					style="z-index: 8; white-space: nowrap;font-family:Arial;">

						<a href="#" class="btn btn-warning rounded"><span><i class="fa fa-download"></i> Download the app</span></a>

				</div>
				<!-- LAYER NR. 5 -->

				<div class="tp-caption   tp-resizeme" 

					 id="slide-22-layer-5" 

					 data-x="['right']" data-hoffset="['20']" 

					 data-y="['top']" data-voffset="['115']" 

								data-width="none"

					data-height="none"

					data-whitespace="nowrap"

					data-transform_idle="o:1;"

		 

					 data-transform_in="y:bottom;s:1500;e:Power3.easeInOut;" 

					 data-transform_out="auto:auto;s:300;" 

					data-start="0" 

					data-responsive_offset="on" 
					

					style="z-index: 9;"><img src="images/okaytaxi_slides/phone-hand.png" alt="" width="672" height="988" data-ww="['477px','477px','477px','421px']" data-hh="['701px','701px','701px','620px']" data-no-retina> 

				</div>

			</li>

		</ul>

		<div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>	

	</div>

		</div><!-- END REVOLUTION SLIDER -->

				

		</div>

		<!-- END REVOLUTION SLIDER -->

		<section id="service" class="background-dark m-b-10 p-b-10">

			<div class="container">

				<div class="row">

					<div class="col-md-12 text-center text-light"><h2>Services, which Top Ridez app offers, are a lot!</h2></div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-users fa-4x"></i></a> </div>

							<h3>Shuttle taxi</h3>

							<p>Taxi for big number of passengers 4, 6, 8 or more.</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-gift fa-4x"></i></a> </div>

							<h3>Taxi surprise</h3>

							<p>Surprise someone with our surprise service.</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-paw fa-4x"></i></a> </div>

							<h3>Zoo Taxi</h3>

							<p>Let us know if you want assist with cages, kennels etc.</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-plane fa-4x"></i></a> </div>

							<h3>Airport Taxi</h3>

							<p>Advanced airport transfers on the go.</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-cubes fa-4x"></i></a> </div>

							<h3>Courier Taxi</h3>

							<p>This is truly fast Taxi Courier. Just like the wind!</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-wheelchair fa-4x"></i></a> </div>

							<h3>Promobil Taxi</h3>

							<p>We have taxi services for all kinds of wheelchairs. You call, we help!</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-beer fa-4x"></i></a> </div>

							<h3>Drink & Drive Taxi</h3>

							<p>Night out? Specify your location and we are on our way!</p>

						</div>

					</div>

					<div class="col-md-3">

						<div class="icon-box box-type effect medium center process black-box" data-animation="fadeInUp" data-animation-delay="100">

							<div class="m-t-20 m-b-20"> <a href="#"><i class="fa fa-star fa-4x"></i></a> </div>

							<h3>Limo Taxi</h3>

							<p>For those who want to impress. Be a star and call Top Ridez!</p>

						</div>

					</div>

				</div>

			</div>

		</section>

		<!-- ABOUT APP -->

		<section class="background-grey">

			<div class="container">

				<p class="lead text-center">With this app, you will forget about waiting and wondering when you will go to your desired destination.</p>

			</div>

		</section>

		<!-- ABOUT APP -->

		<!-- FEATURES -->

		<section id="features" class="m-t-5 p-t-5">

			<div class="container">

				<div class="text-center m-b-60">

					<h1 class="text-medium">AMAZING FEATURES</h1>

					<p>Remember, the journey, not the destination!</p>

				</div>

				<div class="row">

					<div class="col-md-4 p-t-40">

						<div class="m-b-40 text-right effect medium border small" data-animation="fadeInLeft" data-animation-delay="200">

							<h3>Fast interface <i class="fa fa-bolt fa-2x"></i></h3>

							<p>The taxi booking app makes the difference in speed.</p>

						</div>

						<div class="m-b-40 text-right effect medium border small" data-animation="fadeInLeft" data-animation-delay="300">

							<h3>Easy to use <i class="fa fa-mobile fa-2x"></i></h3>

							<p>Easy to use Login / Register and Book a cab</p>

						</div>

						<div class="m-b-40 text-right effect medium border small" data-animation="fadeInLeft" data-animation-delay="400">

							<h3>Touch and go <i class="fa fa-hand-o-right fa-2x"></i></h3>

							<p>Few clicks away from wherever you want to be.</p>

						</div>

						<div class="m-b-40 text-right effect medium border small" data-animation="fadeInLeft" data-animation-delay="500">

							<h3>Future reservations <i class="fa fa-clock-o fa-2x"></i></h3>

							<p>Plan a trip, book a cab, do a job.</p>

						</div>

					</div>

					<div class="col-md-4 text-center" data-animation="fadeInUp" data-animation-delay="100">

						<img alt="img" class="img-responsive center-block" src="images/okaytaxi_slides/sony-android.png">

					</div>

					<div class="col-md-4 p-t-40">

						<div class="m-b-40 effect medium border small" data-animation="fadeInRight" data-animation-delay="200">

							<h3><i class="fa fa-thumbs-o-up fa-2x"></i> Slick design</h3>

							<p>You won't be bothered with unnecessary buttons</p>

						</div>

						<div class="m-b-40 effect medium border small" data-animation="fadeInRight" data-animation-delay="300">

							<h3><i class="fa fa-map-marker fa-2x"></i> Precise mapping</h3>

							<p>Accurate Taxi Cabs mapping with the help of GPS</p>

						</div>

						<div class="m-b-40 effect medium border small" data-animation="fadeInRight" data-animation-delay="400">

							<h3><i class="fa fa-location-arrow fa-2x"></i> Driver tracking</h3>

							<p>Wonder where the driver is at this current moment?</p>

						</div>

						<div class="m-b-40 effect medium border small" data-animation="fadeInRight" data-animation-delay="500">

							<h3><i class="fa fa-certificate fa-2x"></i> All kinds of services</h3>

							<p>As mentioned above, we do all kinds of pickups, not just ordinary.</p>

						</div>

					</div>

				</div>

			</div>

		</section>

		<!-- END: FEATURES -->
		<div class="seperator"><i class="fa fa-chevron-down"></i></div>

		<section id="howtouse">

			<div class="container">

				<div class="heading text-left">

					<h2>HOW TO USE</h2>

					<span class="lead">It's quite easy for you. Just a few clicks!</span>

				</div>

				<div class="row">

					<div class="col-md-3">

						<div class="text-box" data-animation="fadeInLeft" data-animation-delay="0">

							<h4>Choose pickup location</h4>

							<p>

								<span class="dropcap dropcap-circle dropcap-colored"> 1 </span>

								Choose your desired pickup location on the map.

							</p>

							<img src="images/screens/5.png" class="img-responsive img-thumbnail" alt="">

						</div>

					</div>

					<div class="col-md-3 col-md-offset-1">

						<div class="text-box" data-animation="fadeInDown" data-animation-delay="0">

							<h4>Choose drop location</h4>

							<p>

								<span class="dropcap dropcap-circle dropcap-colored"> 2 </span>

								Choose the preferred drop location on the map.

							</p>

							<img src="images/screens/6.png" class="img-responsive img-thumbnail" alt="">

						</div>

					</div>

					<div class="col-md-3 col-md-offset-1">

						<div class="text-box" data-animation="fadeInRight" data-animation-delay="0">

							<h4>Book taxi</h4>

							<p>

								<span class="dropcap dropcap-circle dropcap-colored"> 3 </span>

								You are now ready for booking and boarding the taxi.

							</p>

							<img src="images/screens/7.png" class="img-responsive img-thumbnail" alt="">

						</div>

					</div>

				</div>

			</div>

		</section>

		
		<div class="seperator"><i class="fa fa-chevron-down"></i></div>
		<!-- APP SCREENSHOTS -->

		<section>

			<div class="container" data-animation="fadeInUp" data-animation-delay="200">

				<div class="carousel" data-carousel-col="5" data-carousel-col-xs="2" data-lightbox-type="gallery">

					<div class="owl-item">

						<a href="images/screens/1.png" title="Your image title here!"><img src="images/screens/1.png" alt=""></a>

					</div>

					<div class="owl-item">

						<a href="images/screens/2.png" title="Your image title here!"><img src="images/screens/2.png" alt=""></a>

					</div>

					<div class="owl-item">

						<a href="images/screens/3.png" title="Your image title here!"><img src="images/screens/3.png" alt=""></a>

					</div>

					<div class="owl-item">

						<a href="images/screens/4.png" title="Your image title here!"><img src="images/screens/4.png" alt=""></a>

					</div>

					<div class="owl-item">

						<a href="images/screens/5.png" title="Your image title here!"><img src="images/screens/5.png" alt=""></a>

					</div>

					<div class="owl-item">

						<a href="images/screens/6.png" title="Your image title here!"><img src="images/screens/6.png" alt=""></a>

					</div>

					<div class="owl-item">

						<a href="images/screens/7.png" title="Your image title here!"><img src="images/screens/7.png" alt=""></a>

					</div>


				</div>
			</div>

		</section>

		<!-- END: APP SCREENSHOTS -->
		<div class="seperator"><i class="fa fa-chevron-down"></i></div>


		<!-- SIMPLE, IT'S GREAT APP -->

		<section id="simplicity">

			<div class="container">

				<div class="row">

					<div class="col-md-5 m-b-30" style="height:556px">

						<div class="image-absolute" data-animation="fadeInLeft" data-animation-delay="800">

							<img src="images/okaytaxi_slides/app-iphone-dark.png" alt="">

						</div>

						<div class="image-absolute" data-animation="fadeInLeft" data-animation-delay="400">

							<img src="images/okaytaxi_slides/app-iphone-white.png" alt="">

						</div>

					</div>

					<div class="col-md-7" data-animation="fadeInUp" data-animation-delay="1000">

						<div class="m-b-40">

							<h1 class="text-medium">SIMPLE, IT'S GREAT APP</h1>

							<span class="lead">Simplicity at its finest!</span>

							<p>

								When you make a reservation, all our drivers who are active will receive a notification from your booking and will answer your call.

							</p>

							<p>

								The clients happiness is number one here, so be sure that we will do anything to keep your ride pleasant!

							</p>

							<p>

								Whether you call the Shuttle taxi, Taxi surprise, Zoo Taxi, Top Ridez, Courier Taxi, Promobil Taxi, Drink & Drive Taxi, Limo Taxi and Airport Taxi you will always get upper class taxi servicing.

							</p>

							<p>

								You will be suprise of how quick and precise our services are, the best taxi services.

							</p>

						</div>

					</div>
				</div>

			</div>
		</section>

		<!-- SIMPLE, IT'S GREAT APP -->
		<!-- DOWNLOAD APP -->

		<section class="background-grey p-b-40">

			<div class="container">
				<div class="text-center m-b-60" data-animation="fadeInUp" data-animation-delay="100">

					<h1 class="text-medium"><strong>Download</strong> Top Ridez </h1>
					<h2><strong>Book</strong> a cab!</h1>

					

					<a data-animation="fadeInUp" data-animation-delay="200" href="#" class="button rounded icon-left"><span><i class="fa fa-apple"></i>App Store</span></a>

					<a data-animation="fadeInUp" data-animation-delay="300" href="#" class="button rounded icon-left"><span><i class="fa fa-android"></i>Play Store</span></a>

				</div>

			</div>
		</section>

		<!-- END: DOWNLOAD APP -->
		<!-- jobs  -->

		<section class="p-b-40" id="jobs">
			<div class="container">
				<div class="heading heading-center">
					<h2>Jobs</h2>
					<span class="lead">We are currently looking for new drivers!</span>
				</div>
				<div class="row">
					<div class="col-md-offset-2 col-md-8">
						<h3>We are looking for Taxi Drivers to work in Switzerland.</h3>
						<p class="lead">Your tasks will be:</p>
						<ul>
							<li>
								All known regular taxi cab tasks;
							</li>
							<li>
								Work in shifts. Cooperation and helping the other drivers in weekends and official holidays, whenever it is necessary;
							</li>
							<li>
								Responsibility for the vehicle, including maintenance and cleaning;
							</li>
							<li>
								Cooperation in advertising the company.
							</li>
						</ul>
						<p class="lead">Your profile has to be:</p>
						<ul>
							<li>
								Experienced driver with quick reaction time on the road;
							</li>
							<li>
								Driving license - category B;
							</li>
							<li>
								Neat, professional and modest appearance;
							</li>
							<li>
								Team player, reliable and polite person;
							</li>
							<li>
								Calm and safe driving;
							</li>
							<li>
								A high level of leeway, resistant to stress;
							</li>
							<li>
								Knowledge (conversational level) in German or another foreign language be considered as an advantage.
							</li>
						</ul>
						<p class="lead">What you get:</p>
						<ul>
							<li>
								Fair and secure income;
							</li>
							<li>
								Special Android & iOS App to assist in the overall performance of the drivers;
							</li>
							<li>
								Various and exciting work;
							</li>
							<li>
								Contacts with renowned regional and national companies, selected customers throughout Switzerland and abroad;
							</li>
							<li>
								Support and contact with your agent all the time.
							</li>
						</ul>
					</div>
				</div>
				<div class="hr-title hr-long center"><abbr>Apply for Taxi driver job</abbr> </div>
				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<form method="POST" action="mail.php">
							<div class="row">
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper" for="name">Your Name</label>
										<input type="text" class="form-control required" name="senderName" placeholder="Enter name" id="name" >
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper" for="email">Your Email</label>
										<input type="text" class="form-control required email" name="senderEmail" placeholder="Enter email" id="email">
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label class="upper" for="phone">Your Phone</label>
										<input type="text" class="form-control required" name="phone" placeholder="Enter phone" id="phone" >
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label class="upper" for="comment">About you</label>
										<textarea class="form-control required" name="comment" rows="9" placeholder="Tell us something about your professional driving skills." id="comment" ></textarea>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group text-center">
										<button class="btn btn-primary" type="submit" id="submitter"><i class="fa fa-paper-plane"></i>&nbsp;Apply for Job</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
		<script>
		jQuery(document).ready(function($){
			$("form").submit(function(e){
				e.preventDefault();
				
				var formData = {
					name              : $('input[name=senderName]').val(),
					email             : $('input[name=senderEmail]').val(),
					phone             : $('input[name=phone]').val(),
					comment             : $('textarea[name=comment]').val(),
				};
				$.ajax({
					type        : 'POST',
					url         : 'mail.php',
					data        : formData,
					dataType	: 'json',
					success: function(data){
						console.log(data);
					}
				});
				$("form").after('<h3>Thanks for your submittion. We will contact you in short period of time.</h3>').remove();
			});
		});
		</script>
		<!-- END: jobs -->

		<footer class="background-dark text-grey" id="footer">

			<div class="footer-content">

				<div class="container">

					<div class="row text-center">

						<img alt="" src="images/ocrides.png">

						<div class="copyright-text text-center"> © 2017 Top Ridez - Best Taxi Booking App in America. All Rights Reserved.

						</div>

						<div class="social-icons center">

							<ul>

								<li class="social-facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>

								<li class="social-twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>

								<li class="social-google"><a href="#"><i class="fa fa-google-plus"></i></a></li>

								<li class="social-pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>

								<li class="social-vimeo"><a href="#"><i class="fa fa-vimeo-square"></i></a></li>

								<li class="social-linkedin"><a href="#"><i class="fa fa-linkedin"></i></a></li>

							</ul>

						</div>

						<div class="copyright-text text-center"> Created by <a href="#" target="_blank">Top Ridez</a>

						</div>

					</div>

				</div>

			</div>

		</footer>

	</div>

	<!-- END: WRAPPER -->
	<!-- GO TOP BUTTON -->

	<a class="gototop gototop-button" href="#"><i class="fa fa-chevron-up"></i></a>

	<div class="md-overlay"></div><!-- the overlay element -->

	<!-- this page specific scripts -->
	<script src="js/classie.js"></script>
 	<script src="js/modalEffects.js"></script>


	<!-- SLIDER REVOLUTION 5.x SCRIPTS  -->

	<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.tools.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/jquery.themepunch.revolution.min.js"></script>

    

    <script type="text/javascript">

						var tpj=jQuery;

			tpj.noConflict();

			var revapi6;

			tpj(document).ready(function() {

				if(tpj("#rev_slider_6_1").revolution == undefined){

					revslider_showDoubleJqueryError("#rev_slider_6_1");

				}else{

					revapi6 = tpj("#rev_slider_6_1").show().revolution({

						sliderType:"standard",

jsFileLocation:"vendor/rs-plugin/js/",

						sliderLayout:"fullwidth",

						dottedOverlay:"none",

						delay:9000,

						navigation: {

							keyboardNavigation:"off",

							keyboard_direction: "horizontal",

							mouseScrollNavigation:"off",

							onHoverStop:"on",

							arrows: {

								style:"hades",

								enable:true,

								hide_onmobile:true,

								hide_under:0,

								hide_onleave:true,

								hide_delay:200,

								hide_delay_mobile:1200,

								tmp:'<div class="tp-arr-allwrapper">	<div class="tp-arr-imgholder"></div></div>',

								left: {

									h_align:"left",

									v_align:"center",

									h_offset:40,

									v_offset:0

								},

								right: {

									h_align:"right",

									v_align:"center",

									h_offset:40,

									v_offset:0

								}

							}

						},

						responsiveLevels:[1240,1024,778,480],

						visibilityLevels:[1240,1024,778,480],

						gridwidth:[1170,1024,778,480],

						gridheight:[700,768,960,720],

						lazyType:"none",

						shadow:0,

						spinner:"spinner2",

						stopLoop:"off",

						stopAfterLoops:-1,

						stopAtSlide:-1,

						shuffle:"off",

						autoHeight:"off",

						disableProgressBar:"on",

						hideThumbsOnMobile:"on",

						hideSliderAtLimit:0,

						hideCaptionAtLimit:481,

						hideAllCaptionAtLilmit:0,

						debugMode:false,

						fallbacks: {

							simplifyAll:"off",

							nextSlideOnWindowFocus:"off",

							disableFocusListener:false,

						}

					});

				}

			});	/*ready*/

		</script>
		<script type="text/javascript">
				var BASEPATH = '<?php echo BASEPATH; ?>';
		</script>
	<!-- Theme Base, Components and Settings -->

	<script src="js/theme-functions.js"></script>
	<!-- Custom js file -->

	<script src="js/custom.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.actions.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.carousel.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.kenburn.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.layeranimation.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.migration.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.navigation.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.parallax.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.slideanims.min.js"></script>

	<script type="text/javascript" src="vendor/rs-plugin/js/extensions/revolution.extension.video.min.js"></script>
	<script type="text/javascript">
	function bookingclick(){
		$("#fullsizebannervideo").css({"width":"200%"});
		$("#bannerVideoOverlay").css({"display":"none"});
		$("#resizeVideoDone").css({"display":"block"});
	}
	function bookingopen(){
		$("#fullsizebannervideo").css({"width":"100%"});
		$("#bannerVideoOverlay").css({"display":"block"});
		$("#resizeVideoDone").css({"display":"none"});
	}

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
<script src="js/jquery.liquid-slider.min.js"></script>
<script type="text/javascript">
	$('#slider-4').liquidSlider({
		//hashLinking:true,
		crossLinks:true,
		firstPanelToLoad:1,
		dynamicTabs : false,
		dynamicArrows: false
	});
	var api2 = $.data( $('#slider-4')[0], 'liquidSlider');
	$('	.enable-hash').on('click', function(e){
		e.preventDefault();
		api2.options.hashLinking = true;
		api2.buildHashTags();
		$(this).fadeOut();
	});
	$('.btn-hover').on('mouseover', function() {
		api2.setNextPanel(3);
	});
	$("#sendOTP").hide();
	$("#verifyOTP").hide();
	$("#resendButton").hide();
	function confirmbooking(){
		$("#confirmBooking").hide();
		$("#sendOTP").show();
		$("#floatingElement").html("");
		$('#floatingElement').append('<a onclick="api2.setNextPanel(0);api2.updateClass($(this)), bookingdetails()">BOOKING DETAILS</a>');
	};
	function bookingdetails(){
		$("#confirmBooking").show();
		$("#sendOTP").hide();
		$("#resendButton").hide();
		$("#floatingElement").html("");
		var img = '<?php echo BASE_URL."car_image/".$_SESSION['car_image']; ?>';
		$('#floatingElement').append('<img src="'+img+'" width="40px"> &nbsp;'+'<?php echo $_SESSION['booking_cartype']; ?>');
		$("#verifyOTP").hide();
	};
	/*function sendotp(){
		$("#verifyOTP").show();
		$("#sendOTP").hide();
		$("#floatingElement").html("");
		$("#resendButton").show();
		$('#floatingElement').append('<a onclick="api2.setNextPanel(1);api2.updateClass($(this)), editnumbers()">EDIT NUMBER</a>');
	};*/
	function editnumbers(){
		$("#verifyOTP").hide();
		$("#confirmBooking").hide();
		$("#sendOTP").show();
		$("#resendButton").hide();
		$("#floatingElement").html("");
		$('#floatingElement').append('<a onclick="api2.setNextPanel(0);api2.updateClass($(this)), bookingdetails()">BOOKING DETAILS</a>');
	};
</script>
</body>
</html>
<!--- other date -->
 <!-- display boking over -->