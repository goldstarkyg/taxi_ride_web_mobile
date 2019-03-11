<?php
//if(isset($_POST['save']))
//{
//    $reasonTitle=$_POST['reasonTitle'];
//    $reasonText=$_POST['reasonText'];
//
//    $sql = "insert into delay_reasons (reason_title,reason_text) values ('$reasonTitle','$reasonText')";
//
//    if($this-> db-> query($sql))
//    {
//        redirect("http://$_SERVER[HTTP_HOST]/WebApp/Source/admin/manage_delay_reasons");
//    }
//
//}
if(isset($_POST['save']))
{
    $areaTitle = $_POST['areaTitle'];
    //$areaPincode = $_POST['areaPincode'];
    $areaRange = $_POST['areaRange'];
    $areaPrice = $_POST['areaPrice'];
    $car_type = $_POST['car_type'];
    $car_tmp = explode('~#-',$car_type);
    $car_type_name = $car_tmp[0];
    $car_type_id = $car_tmp[1];
    $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($areaTitle).'&sensor=false');
    $geo = json_decode($geo, true);
    if ($geo['status'] = 'OK')
    {
         $latitude = $geo['results'][0]['geometry']['location']['lat'];
         $longitude = $geo['results'][0]['geometry']['location']['lng'];
    }
    $sql = "insert into fix_price_area(area_title,area_range,price,car_type_id,car_type_name,latitude,longitude) values ('$areaTitle','$areaRange','$areaPrice','$car_type_id','$car_type_name','$latitude','$longitude')";

    if($this-> db-> query($sql))
    {
        redirect(base_url()."admin/manage_fix_price_area");
    }

   // $sql = "SELECT DISTINCT *,Round(((ACOS(SIN('$latitude' * PI() / 180) * SIN(latitude * PI() / 180) + COS('$latitude' * PI() / 180) * COS(latitude * PI() / 180) * COS(('$longitude'-longitude) * PI() / 180)) * 180 / PI()) * 60 * 1.1515),(2)) AS distance FROM tp_artist Having distance <= $miles";

}

if(isset($_POST['update']))
{
    $areaTitle = $_POST['areaTitle'];
    //$areaPincode = $_POST['areaPincode'];
    $areaRange = $_POST['areaRange'];
    $areaPrice = $_POST['areaPrice'];
    $car_type = $_POST['car_type'];
    $car_tmp = explode('~#-',$car_type);
    $car_type_name = $car_tmp[0];
    $car_type_id = $car_tmp[1];
    $id= $_POST['id'];
    $geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($areaTitle).'&sensor=false');
    $geo = json_decode($geo, true);
    if ($geo['status'] = 'OK')
    {
        $latitude = $geo['results'][0]['geometry']['location']['lat'];
        $longitude = $geo['results'][0]['geometry']['location']['lng'];
    }
   $edit_qry = "UPDATE `fix_price_area` SET `area_title`='".$areaTitle."',`area_range`=".$areaRange.",`price`=".$areaPrice.",`car_type_id`=".$car_type_id.",`car_type_name`='".$car_type_name."',`latitude`=".$latitude.",`longitude`=".$longitude." WHERE `area_id`=".$id;

    if($this-> db-> query($edit_qry))
    {
        redirect(base_url()."admin/manage_fix_price_area");
    }


}
$areaTitle = '';
//$areaPincode='';
$areaPrice ='';
$areaRange='';

if(isset($_GET['id']))
{
    $id= $_GET['id'];
    $this->db->select('*');
    $this->db->from('fix_price_area');
    $this->db->where('area_id', $id );
    $query = $this->db->get();

    if ( $query->num_rows() > 0 )
    {
        $row = $query->row_array();
        //print_r($row);
        $areaTitle = $row['area_title'];
        //$areaPincode=$row['pincode'];
        $areaPrice = $row['price'];
        $areaRange=$row['area_range'];
        $car_type_id = $row['car_type_id'];
        $car_type_name = $row['car_type_name'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Add Fix Price Area - OK Switzerland</title>

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

    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">.modal-open .modal{ background:url(img/transpharant.png) top left repeat;}</style>

    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyC-VZsY8ztn407YgD7FJ5S224ocWmvQV3c&amp;sensor=false&amp;libraries=places" type="text/javascript"></script>
    <script type="text/javascript">
        function initialize() {
            var input = document.getElementById('areaTitle');
            var autocomplete = new google.maps.places.Autocomplete(input);
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
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
                                        <h1>Add Area</h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#">Home</a></li>
                                            <li class="active"><span>Add Area</span></li>
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
                                            <h2>Add Area</h2>
                                        </div>
                                    </div>
                                    <div class="main-box-body clearfix">
                                        <form  enctype="multipart/form-data" method="post" class="form-horizontal" id="formAddUser" name="add_reason" role="form">
                                            <h3><span>Add Area</span></h3>
                                            <br />

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="reasontitle">Pick Area</label>
                                                <div id="inputReasonTitle" class="col-lg-10">
                                                    <input type="text" autocomplete="on" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();" placeholder="Type Pick Area" value="<?=$areaTitle?>" name="areaTitle" id="areaTitle" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="reasontitle">Area Range</label>
                                                <div id="inputReasonTitle" class="col-lg-10">
                                                    <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();" placeholder="Enter Range in KM (eg. 123)" value="<?=$areaRange?>" name="areaRange" id="areaRange" class="form-control" required>
                                                </div>
                                            </div>
<!--                                            <div class="form-group">-->
<!--                                                <label class="col-lg-2 control-label" for="drivername">Pick Area</label>-->
<!--                                                <div id="inputReasonText" class="col-lg-10">-->
<!--                                                    <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();" placeholder="Enter Pincode of Area" value="--><?//=$areaPincode?><!--" name="areaPincode" id="areaPincode" class="form-control" required>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="drivername">Area Price</label>
                                                <div id="inputReasonText" class="col-lg-10">
                                                    <input type="text" onkeyup="javascript:capitalize(this.id, this.value);" onkeydown="errorValidUser();" placeholder="Enter Price of Area (eg. 123)" value="<?=$areaPrice?>" name="areaPrice" id="areaPrice" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-lg-2 control-label" for="drivercartype">Truck Type</label>
                                                <div id="inputDriverCarType" class="col-lg-10">
                                                    <?php
                                                    //$query1 = $this->db->query("SELECT * FROM `bookingdetails` ORDER by id DESC LIMIT 10");
                                                    $query1 = $this->db->query("SELECT * FROM cabdetails ORDER  by cab_id DESC ");
                                                    //echo $car_type_id;
                                                    ?>

                                                    <select name="car_type" id="car_type" class="form-control" required>
                                                        <?php
                                                        $i=0;
                                                        foreach($query1->result_array('cartype') as $row1)
                                                        {
                                                            echo "<option ";
                                                        if(isset($_GET['id'])) {
                                                            if ($row1['cab_id'] == $car_type_id)
                                                                echo 'selected="selected"';
                                                        }
                                                            echo "value='".$row1['cartype']."~#-".$row1['cab_id']."' >".$row1['cartype']."</option>";
                                                            $i++;
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <?php if(isset($_GET['id'])){ ?>
                                                        <button style="display:block;" class="btn btn-success"  name="update" id="notification-trigger-bouncyflip" type="submit">
                                                            <span id="category_button" class="content">UPDATE</span>
                                                        </button>
                                                        <input type="hidden" name="id" value="<?=$id?>">
                                                    <?php }else{?>
                                                    <button style="display:block;" class="btn btn-success"  name="save" id="notification-trigger-bouncyflip" type="submit">
                                                        <span id="category_button" class="content">SUBMIT</span>
                                                    </button>
                                                    <?php } ?>
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
                        Powered by OK Switzerland.
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
