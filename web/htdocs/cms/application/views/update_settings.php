<?php
include ('language.php');
$query1 = $this->db->query(" SELECT * FROM `settings` order by id DESC ");
$row11 = $query1->row('settings');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Update Settings - <?php echo $header_title; ?></title>

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
    <!--language translate-->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>application/views/dist/jquery.localizationTool.css">
    <!-- 5. Add jQuery -->
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

    <!-- 6. Add localizationTool.js after jQuery -->
    <script src="<?php echo base_url();?>application/views/src/jquery.localizationTool.js"></script>
    <!--end-->
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
                                        <h1><?php echo $setting_lng; ?></h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#">
                                                    <?php
                                                  echo $home_lng;
                                                    ?>
                                                </a></li>
                                            <li class="active"><span>
                                                    <?php echo $setting_lng; ?>
                                                </span></li>
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
                                            <h2>
                                                <?php echo $setting_lng; ?></h2>
                                        </div>
                                    </div>
                                    <?php

                                    if(isset($_REQUEST["save"]))
                                    {
                                        $country = $_REQUEST['country'];
                                        $currency= $_REQUEST['currency'];
                                        $language=$_REQUEST['language'];
                                        $driver_status=$_REQUEST["driver_status"];


                                            $upcar = "UPDATE settings SET country='$country',currency='$currency',languagetr='$language',driver_status='$driver_status' WHERE id='1'";
                                            $qr = mysql_query($upcar);
                                            if ($qr) {
                                                redirect('admin/dashboard');
                                            }
                                    }
                                    ?>
                                    <div class="main-box-body clearfix">
                                        <form onsubmit="return validateForm()"  enctype="multipart/form-data" method="post" class="form-horizontal" id="formAddUser" name="change_password" role="form">

                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">
                                                    <?php
                                                   echo $country_lng;
                                                    ?></label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <input type="text"  placeholder="Enter country" name="country" id="country" class="form-control" value="<?php echo $row11->country; ?>" >
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;"><?php
                                                   echo $currency_lng;
                                                    ?></label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <input type="text"  placeholder="Enter currency" name="currency" id="currency" class="form-control" value="<?php echo $row11->currency;?>">
                                                </div>
                                            </div>
						                    <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">
                                                    <?php
                                                        echo $Language_lng;
                                                    ?></label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%; height: 100" >
<!--                                                    <div id="google_translate_element" ></div>-->
                                                   <select name="language">
                                                       <option value="1" <?php if($row11->languagetr=='1'){ echo 'selected'; } ?>>English</option>
                                                       <option value="2" <?php if($row11->languagetr=='2'){ echo 'selected'; } ?>>German</option>
                                                       <option value="3" <?php if($row11->languagetr=='3'){ echo 'selected'; } ?>>Italian</option>
                                                       <option value="4" <?php if($row11->languagetr=='4'){ echo 'selected'; } ?>>Russian</option>
                                                       <option value="5" <?php if($row11->languagetr=='5'){ echo 'selected'; } ?>>French</option>
                                                       <option value="6" <?php if($row11->languagetr=='6'){ echo 'selected'; } ?>>Bulgarian</option>
                                                   </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-1 control-label" for="name" style="width: 15%;">Default Driver Status</label>
                                                <div id="inputUserName" class="col-lg-11" style="width: 85%;">
                                                    <?php
                                                    $driver_default_status=$row11->driver_status;
                                                        ?>
                                                        <input type="radio" name="driver_status" id="driver_status" value="Active"
                                                        <?php
                                                        if($driver_default_status == 'Active')
                                                        {
                                                          ?>
                                                            checked
                                                            <?php
                                                        }
                                                        ?>
                                                        > &nbsp; Active &nbsp;
                                                        <input type="radio" name="driver_status" id="driver_status" value="Inactive"
                                                            <?php
                                                            if($driver_default_status == 'Inactive')
                                                            {
                                                                ?>
                                                            checked
                                                            <?php
                                                            }
                                                            ?>
                                                        > &nbsp; Inactive

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-1 col-lg-10">
                                                    <button style="display:block;" class="btn btn-success" name="save" id="notification-trigger-bouncyflip" type="submit">
                                                        <span id="category_button" class="content">
                                                             <?php echo $SUBMIT_lng; ?></span>
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
<script type="text/javascript">
    function validateForm() {
        var np = document.forms["change_password"]["new_password"].value;
        var cp = document.forms["change_password"]["confirm_password"].value;
        if (np == null || np == "") {
            alert("New Password must be filled out");
            return false;
        }
        else if(cp == null || cp=="")
        {
            alert("confirm password must be filled out");
            return false;
        }
    }
</script>
<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyBpivqAk4r1gHXm6Xdbf8bA12hn8G1-4zY&libraries=places" type="text/javascript"></script>
<script type="text/javascript">
    function initialize() {
        var options = {
            types: ['(regions)']
        };
        var input = document.getElementById('country');
        var autocomplete = new google.maps.places.Autocomplete(input , options);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>

</body>
</html>
