<?php
include ('language.php');
?>
    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>Add Car -
            <?php echo $header_title; ?>
        </title>

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
        <script src="<?php echo base_url();?>/application/views/test.js" type="text/javascript"></script>
        <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->

        <style type="text/css">
            .modal-open .modal {
                background: url(<?php echo base_url();
                ?>application/views/img/transpharant.png) top left repeat;
            }
        </style>
        <style>
            .goog-te-banner-frame.skiptranslate {
                display: none !important;
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
        <script>
            window.jQuery || document.write('<script src="<?php echo base_url();?>application/views/js/vendor/jquery-1.9.1.min.js"><\/script>')
        </script>
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
                                                        <h1><?php echo $Add_Car_Type_lag;?></h1>
                                                    </div>
                                                    <div class="pull-right">
                                                        <ol class="breadcrumb">
                                                            <li>
                                                                <a href="#">
                                                                    <?php echo $HOME_lag;?>
                                                                </a>
                                                            </li>
                                                            <li class="active"><span><?php echo $Add_Car_Type_lag;?></span></li>
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
                                                            <h2><?php echo $Add_Car_Type_lag;?></h2>
                                                        </div>
                                                    </div>

                                                    <div class="main-box-body clearfix">
                                                        <!--<form  enctype="multipart/form-data" method="post" class="form-horizontal" id="formAddUser" name="add_user" role="form"  action="<?php echo base_url()?>admin/insert_car" onsubmit="return validate()">-->
                                                        <?php echo form_open_multipart('admin/insert_car',array('id' => 'formAddUser','class' => 'form-horizontal','role' => 'from', 'onsubmit' => 'return validate()')); ?>
                                                            <?php if($this->session->flashdata('error_msg')) {
                                            echo $this->session->flashdata('error_msg');
                                            }
                                        ?>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="inputImgCar">
                                                                        <?php echo $Car_Image_lag;?>
                                                                    </label>
                                                                    <div id="inputImgCar" class="col-lg-10">
                                                                        <input type="file" required name="uploadImageFile" id="uploadImageFile" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Car_Type_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_Car_Types_lag;?>" name="cartype" id="cartype" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <!--
						  <div class="form-group">
                                            <label class="col-lg-2 control-label" for="cartype"><?php echo $Car_Types_Arabic_lag;?></label>
                                            <div id="inputCarType" class="col-lg-10">
                                                <input type="text" required  placeholder="<?php echo $Enter_Car_Types_Arabic_lag;?>" name="cartype_arabic" id="cartype_arabic" class="form-control" lang="en">
                                            </div>
                                        </div>
-->
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Transfer_Type_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" placeholder="<?php echo $Enter_Transfer_Types_lag;?>" name="transfertype" id="transfertype" class="form-control" required>
                                                                    </div>
                                                                </div>
                                                                <!--
						 <div class="form-group">
                                            <label class="col-lg-2 control-label" for="cartype"><?php echo $Transfer_Types_Arabic_lag;?></label>
                                            <div id="inputCarType" class="col-lg-10">
                                                <input type="text"  placeholder="<?php echo $Enter_Transfer_Types_Arabic_lag;?>" name="transfertype_arabic" id="transfertype_arabic" class="form-control" required lang="en">
                                            </div>
                                        </div>
-->
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Initial_KM_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Initial_KM_lag;?>" name="intialkm" id="intialkm" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="carrate">
                                                                        <?php echo $Car_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarRate" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_car_rate_lag;?>" name="carrate" id="carrate" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Night_Initial_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_Night_Initial_Rate_lag;?>" name="night_intailrate" id="night_intailrate" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $From_Initial_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_From_Initial_KM_lag;?>" name="fromintialkm" id="fromintialkm" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $From_Initial_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_From_Initial_Rate_lag;?>" name="night_fromintailrate" id="night_fromintailrate" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Night_From_Initial_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Night_From_Initial_Rate_lag;?>" name="fromintailrate" id="fromintailrate" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Ride_Time_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_Ride_From_Time_Rate_lag;?>" name="ride_time_rate" id="ride_time_rate" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Night_Ride_Time_Rate_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_Night_Ride_From_Time_Rate_lag;?>" name="night_ride_time_rate" id="night_ride_time_rate" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Time_Type_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_Time_Type_lag;?>" name="timetype" id="timetype" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="cartype">
                                                                        <?php echo $Description_lag;?>
                                                                    </label>
                                                                    <div id="inputCarType" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Enter_Description_lag;?>" name="description" id="description" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <!--
						 <div class="form-group">
                                            <label class="col-lg-2 control-label" for="cartype"><?php echo $Description_Arabic_lag;?></label>
                                            <div id="inputCarType" class="col-lg-10">
                                                <input type="text"  placeholder="<?php echo $Enter_Description_lag;?>" name="description_arabic" id="description_arabic" class="form-control" required lang="en">
                                            </div>
                                        </div>
-->
                                                                <div class="form-group">
                                                                    <label class="col-lg-2 control-label" for="seatingcapecity">
                                                                        <?php echo $Loading_Capacity_lag;?>
                                                                    </label>
                                                                    <div id="inputSeatingCapecity" class="col-lg-10">
                                                                        <input type="text" required placeholder="<?php echo $Loading_Capacity_lag;?>" name="seating_capacity" id="seating_capacity" class="form-control">
                                                                        <!--                        	<select class="form-control" id="seatingCapecity">-->
                                                                        <!--                          	<option>Select Capecity</option>-->
                                                                        <!--														<option>1</option>-->
                                                                        <!--														<option>2</option>-->
                                                                        <!--														<option>3</option>-->
                                                                        <!--														<option>4</option>-->
                                                                        <!--														<option>5</option>-->
                                                                        <!--													</select>-->
                                                                        <!--
                                                    <input type="text" onkeydown="errorValidUser();" placeholder="Enter seating capecity" name="seatingcapecity" id="seatingCapecity" class="form-control">
                                                    -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <div class="col-lg-offset-1 col-lg-10">
                                                                        <button style="display:block;" class="btn btn-success" name="save" id="notification-trigger-bouncyflip" type="submit">
                                                                            <span id="category_button" class="content"><?php echo $SUBMIT_lag;?></span>
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
                new google.translate.TranslateElement({
                    pageLanguage: "en"
                }, "google_translate_element");
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
        <script src="<?php echo base_url();?>application/views/js/demo-skin-changer.js"></script>
        <!-- only for demo -->

        <script src="<?php echo base_url();?>application/views/js/jquery.js"></script>
        <script src="<?php echo base_url();?>application/views/js/bootstrap.js"></script>
        <script src="<?php echo base_url();?>application/views/js/jquery.nanoscroller.min.js"></script>

        <script src="<?php echo base_url();?>application/views/js/demo.js"></script>
        <!-- only for demo -->

        <!-- this page specific scripts -->
        <script src="<?php echo base_url();?>application/views/js/moment.min.js"></script>
        <script src="<?php echo base_url();?>application/views/js/gdp-data.js"></script>

        <!-- theme scripts -->
        <script src="<?php echo base_url();?>application/views/js/scripts.js"></script>
        <script src="<?php echo base_url();?>application/views/js/pace.min.js"></script>

        <!-- this page specific inline scripts -->
        <script type="text/javascript">
            $(window).load(function () {
                $(".cover").fadeOut(2000);
            });
            $(document).ready(function () {
                //CHARTS
                function gd(year, day, month) {
                    return new Date(year, month - 1, day).getTime();
                }
            });
        </script>
        <!--	<script>-->
        <!--		function validate() {-->
        <!--			var x = document.forms["add_user"]["cartype"].value;-->
        <!--			var car_rate = document.forms["add_user"]["carrate"].value;-->
        <!--			var seating_capacity = document.forms["add_user"]["seating_capacity"].value;-->
        <!--			var filename=document.getElementById('uploadImageFile').value;-->
        <!--			var extension=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();-->
        <!--			var image=filename.substr(filename.lastIndexOf('.')+1).toLowerCase();-->
        <!--			//alert(extension);-->
        <!--		 if(image=='')-->
        <!--			{-->
        <!--				alert('car Image must be filled out');-->
        <!--				return false;-->
        <!--			}-->
        <!--//		 else if(extension=='jpg' || extension=='gif' || extension=='jpeg' || extension=='png' ) {-->
        <!--//				return true;-->
        <!--//			}-->
        <!--//-->
        <!--//		 else-->
        <!--//		 {-->
        <!--//			 alert('Not Allowed Extension!');-->
        <!--//			 return false;-->
        <!--//		 }-->
        <!--		else if (x == null || x == "") {-->
        <!--				alert("Car Type must be filled out");-->
        <!--				return false;-->
        <!--			}-->
        <!--			 else if (car_rate == null || car_rate == "") {-->
        <!--			 alert("car rate must be filled out");-->
        <!--			 return false;-->
        <!--		 	}-->
        <!--		 else if (seating_capacity == null || seating_capacity == "") {-->
        <!--			 alert("seating capacity must be filled out");-->
        <!--			 return false;-->
        <!--		 }-->
        <!---->
        <!--		}-->
        <!--	</script>-->
    </body>

    </html>