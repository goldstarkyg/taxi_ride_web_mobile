<?php
include ('language.php');
?>
<!DOCTYPE html>
<?php
     $id = 0;
    if(!empty($_GET['id']))   $id = $_GET['id'];
    $driver_id = $_GET['driver_id'];
    $query=$this->db->query("SELECT * FROM `driver_inspection_record`  WHERE id = $id");
    $row = $query->row('driver_inspection_record');
?>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Add Inspection - <?php echo $header_title; ?></title>

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

    <style type="text/css">.modal-open .modal{ background:url(<?php echo base_url();?>application/views/img/transpharant.png) top left repeat;}</style>
    <style>
        .goog-te-banner-frame.skiptranslate {
            display: none !important;
        }
        body {
            top: 0px !important;
        }
        .topline {
            border-top: 1px solid #c2c2c4;
        }
        .bottomline {
            border-bottom: 1px solid #c2c2c4;
        }
        .form-group {
            margin-bottom: 7px !important;
            margin-left: -10px !important;
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
<?php
$staff_type = $this->session->userdata('staff-type');
$staff_id = $this->session->userdata('staff-id');

$head_lights = '';
$tail_lights = '';
$turn_indicator_lights = '';
$stop_lights = '';
$brake_pad = '';
$min_per_manufacture = '';
$right_front_measurements = '';
$left_front_measurements = '';
$right_rear_measurements = '';
$left_rear_measurements = '';
$parking_brake = '';
$steering_mechanism = '';
$ball_joints = '';
$tie_rods = '';
$rack_pinion = '';
$bushings = '';
$windshield = '';
$large_crack = '';
$small_crack = '';
$other_glass = '';
$windshield_wipers = '';
$front_seat_adjustment = '';
$doors = '';
$horn = '';
$speedometer = '';
$bumper = '';
$exhaust_system = '';
$tread_depth = '';
$right_front = '';
$left_front = '';
$right_rear = '';
$left_rear = '';
$mirrops = '';
$passenger = '';
$inspect_date = '';
$inspect_result = '';
$vehicle_mileage = '';
$license_plate = '';
$vin = '';
$vehicle_make = '';
$vehicle_model = '';
$model_year = '';
$of_doors = '';
$inspector_name = '';
$inspection_address = '';
if(count($row) > 0) {
    $head_lights = $row->head_lights;
    $tail_lights = $row->tail_lights;
    $turn_indicator_lights = $row->turn_indicator_lights;
    $stop_lights = $row->stop_lights;
    $brake_pad = $row->brake_pad;
    $min_per_manufacture = $row->min_per_manufacture;
    $right_front_measurements = $row->right_front_measurements;
    $left_front_measurements = $row->left_front_measurements;
    $right_rear_measurements = $row->right_rear_measurements;
    $left_rear_measurements = $row->left_rear_measurements;
    $parking_brake = $row->parking_brake;
    $steering_mechanism = $row->steering_mechanism;
    $ball_joints = $row->ball_joints;
    $tie_rods = $row->tie_rods;
    $rack_pinion = $row->rack_pinion;
    $bushings = $row->bushings;
    $windshield = $row->windshield;
    $large_crack = $row->large_crack;
    $small_crack = $row->small_crack;
    $other_glass = $row->other_glass;
    $windshield_wipers = $row->windshield_wipers;
    $front_seat_adjustment = $row->front_seat_adjustment;
    $doors = $row->doors;
    $horn = $row->horn;
    $speedometer = $row->speedometer;
    $bumper = $row->bumper;
    $exhaust_system = $row->exhaust_system;
    $tread_depth = $row->tread_depth;
    $right_front = $row->right_front;
    $left_front = $row->left_front;
    $right_rear = $row->right_rear;
    $left_rear = $row->left_rear;
    $mirrops = $row->mirrops;
    $passenger = $row->passenger;
    $inspect_date = $row->inspect_date;
    $inspect_result = $row->inspect_result;
    $vehicle_mileage = $row->vehicle_mileage;
    $license_plate = $row->license_plate;
    $vin = $row->vin;
    $vehicle_make = $row->vehicle_make;
    $vehicle_model = $row->vehicle_model;
    $model_year = $row->model_year;
    $of_doors = $row->of_doors;
    $inspector_name = $row->inspector_name;
    $inspection_address = $row->inspection_address;
}




?>
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
                                        <h1><?php echo $Add_Insection_point;?></h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#"><?php echo $HOME_lag;?></a></li>
                                            <li class="active"><span><?php echo $Add_Insection_point;?></span></li>
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
                                            <h2>DRIVER VEHICLE INFORMATON</h2>
                                        </div>
                                    </div>

                                    <div class="main-box-body clearfix">
                                       <form  method="post" class="form-horizontal" id="inspectform"  action="<?php echo base_url()?>admin/insert_inspection" onsubmit="return validate();" >
                                           <input type="hidden" name="driver_id"  value="<?php echo $_REQUEST['driver_id'] ?>" />
                                           <input type="hidden" name="staff_id"  value="<?php echo $staff_id ; ?>" />
                                           <input type="hidden" name="staff_type"  value="<?php echo $staff_type; ?>" />

                                           <!--///////////third section///////////-->
                                           <div>
                                               <!--=====first column-->
                                               <div class="col-lg-6">
                                                 <div style="margin-right: 40px;">
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> INSPECTION POINT</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <label class="control-label"> PASS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <label class="control-label"> FAIL </label>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label">HEADLIGHTS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="head_lights" value="PASS" <?php echo input_check($head_lights, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="head_lights" value="FAIL" <?php echo input_check($head_lights, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> TAIL LIGHTS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="tail_lights" value="PASS" <?php echo input_check($tail_lights, 'PASS') ;?>   />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="tail_lights" value="FAIL" <?php echo input_check($tail_lights, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> TURN INDICATOR LIGHTS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="turn_indicator_lights" value="PASS" <?php echo input_check($turn_indicator_lights, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="turn_indicator_lights" value="FAIL" <?php echo input_check($turn_indicator_lights, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> STOP LIGHTS </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="stop_lights" value="PASS" <?php echo input_check($stop_lights, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="stop_lights" value="FAIL" <?php echo input_check($stop_lights, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> BRAKE PAD/SHOES THICKNESS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="brake_pad" value="PASS" <?php echo input_check($brake_pad, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="brake_pad" value="FAIL" <?php echo input_check($brake_pad, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-lg-4 pull-left">
                                                          <label class="control-label" >Min Per Manufacture</label>
                                                       </div>
                                                       <div  class="col-lg-6">
                                                           <input type="text" name="min_per_manufacture"  class="form-control" value="<?php echo $min_per_manufacture;?>"  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                      <div class="col-lg-4 pull-left">     
                                                         <label class="control-label" >Right Front Measuremesnts</label>
                                                      </div>
                                                      <div class="col-lg-6">
                                                           <input type="text"  name="right_front_measurements"  class="form-control" value="<?php echo $right_front_measurements;?>" />
                                                      </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-lg-4 pull-left">     
                                                          <label class="control-label" >Left Front Measurements</label>
                                                       </div>
                                                       <div class="col-lg-6">
                                                           <input type="text"  name="left_front_measurements"  class="form-control" value="<?php echo $left_front_measurements;?>" />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-lg-4 pull-left">     
                                                          <label class="control-label" >Right Rear Measuremesnts</label>
                                                       </div>
                                                       <div class="col-lg-6">
                                                           <input type="text"  name="right_rear_measurements"  class="form-control" value="<?php echo $right_rear_measurements;?>" >
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-lg-4 pull-left">     
                                                          <label class="control-label" >Left Rear Measuremesnts</label>
                                                       </div>
                                                       <div class="col-lg-6">
                                                           <input type="text"  name="left_rear_measurements"  class="form-control" value="<?php echo $left_rear_measurements;?>" >
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> EMERGENCY/PARKING BRAKE </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="parking_brake" value="PASS" <?php echo input_check($parking_brake, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="parking_brake" value="FAIL"  <?php echo input_check($parking_brake, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label"> STEERING MECHANISM </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="steering_mechanism" value="PASS" <?php echo input_check($steering_mechanism, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="steering_mechanism" value="FAIL" <?php echo input_check($steering_mechanism, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" style="margin-left: 30px;">Ball Joints</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="ball_joints" value="PASS" <?php echo input_check($ball_joints, 'PASS') ;?>   />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="ball_joints" value="FAIL" <?php echo input_check($ball_joints, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" style="margin-left: 30px;">Tie Rods</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="tie_rods" value="PASS" <?php echo input_check($tie_rods, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="tie_rods" value="FAIL" <?php echo input_check($tie_rods, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" style="margin-left: 30px;">Rack & Pinion</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="rack_pinion" value="PASS" <?php echo input_check($rack_pinion, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="rack_pinion" value="FAIL" <?php echo input_check($rack_pinion, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" style="margin-left: 30px;">Bushings</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="bushings" value="PASS" <?php echo input_check($bushings, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="bushings" value="FAIL" <?php echo input_check($bushings, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" >WINDSHIELD</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="windshield" value="PASS" <?php echo input_check($windshield, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="windshield" value="FAIL" <?php echo input_check($windshield, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" style="margin-left: 30px;" >Large crack</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="large_crack" value="PASS" <?php echo input_check($large_crack, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="large_crack" value="FAIL" <?php echo input_check($large_crack, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" style="margin-left: 30px;" >Small crack</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="small_crack" value="PASS" <?php echo input_check($small_crack, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="small_crack" value="FAIL" <?php echo input_check($small_crack, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" >PEAR WINDOW AND OTHER GLASS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="other_glass" value="PASS" <?php echo input_check($other_glass, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="other_glass" value="FAIL" <?php echo input_check($other_glass, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8" >
                                                           <label class="control-label" >WINDSHIELD WIPERS</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="windshield_wipers" value="PASS" <?php echo input_check($windshield_wipers, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="windshield_wipers" value="FAIL" <?php echo input_check($windshield_wipers, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                  </div>
                                               </div>
                                               <!--=====second column=======-->
                                               <div class="col-lg-6">                                                
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > INSPECTION POINT </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <label class="control-label" >  PASS </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <label class="control-label" > FAIL </label>
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > FRONT SEAT ADJUSTMENT </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="front_seat_adjustment" value="PASS" <?php echo input_check($front_seat_adjustment, 'PASS') ;?>   />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="front_seat_adjustment" value="FAIL" <?php echo input_check($front_seat_adjustment, 'FAIL') ;?>   />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > DOORS (Open/Closr/Lock) </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="doors" value="PASS" <?php echo input_check($doors, 'PASS') ;?>   />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="doors" value="FAIL" <?php echo input_check($doors, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" >  HORN </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="horn" value="PASS" <?php echo input_check($horn, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="horn" value="FAIL" <?php echo input_check($horn, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > SPEEDOMETER </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="speedometer" value="PASS" <?php echo input_check($speedometer, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="speedometer" value="FAIL" <?php echo input_check($speedometer, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > BUMPERS </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="bumper" value="PASS" <?php echo input_check($bumper, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="bumper" value="FAIL" <?php echo input_check($bumper, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > MUFFLER AND EXHAUST SYSTEM </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="exhaust_system" value="PASS" <?php echo input_check($exhaust_system, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="exhaust_system" value="FAIL" <?php echo input_check($exhaust_system, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > TIRES INCL TREAD DEPTH </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="tread_depth" value="PASS" <?php echo input_check($tread_depth, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="tread_depth" value="FAIL" <?php echo input_check($tread_depth, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" style="margin-left: 30px;">Right Front</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="right_front" value="PASS" <?php echo input_check($right_front, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="right_front" value="FAIL" <?php echo input_check($right_front, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" style="margin-left: 30px;">Left Front</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="left_front" value="PASS" <?php echo input_check($left_front, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="left_front" value="FAIL" <?php echo input_check($left_front, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" style="margin-left: 30px;">Right Rear</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="right_rear" value="PASS" <?php echo input_check($right_rear, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="right_rear" value="FAIL" <?php echo input_check($right_rear, 'FAIL') ;?>  />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" style="margin-left: 30px;">Left Rear</label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="left_rear" value="PASS" <?php echo input_check($left_rear, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="left_rear" value="FAIL"  <?php echo input_check($left_rear, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > INTERIOR AND EXTERIOR PEAR VIEW MIRROPS </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="mirrops" value="PASS" <?php echo input_check($mirrops, 'PASS') ;?>  />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="mirrops" value="FAIL" <?php echo input_check($mirrops, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                       <div class="col-xs-8">
                                                           <label class="control-label" > SAFETY BELTS FOR DRIVER AND EACH PASSENGER </label>
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="passenger" value="PASS" <?php echo input_check($passenger, 'PASS') ;?> />
                                                       </div>
                                                       <div class="col-xs-2">
                                                           <input type="checkbox" name="passenger" value="FAIL" <?php echo input_check($passenger, 'FAIL') ;?> />
                                                       </div>
                                                   </div>
                                                   <div class="form-group">
                                                      <div class="col-xs-8 col-offset-xs-2" style="height:180px;border: 1px solid #c2c2c4; margin: 15px 10px 5px 10px">
                                                        <p style="margin-bottom:50px; text-align: center;"> VEHICLE INSPECTION RESULT</p>
                                                        <div  style="margin-left: 20px;font-size: 30px; font-weight: bold">
                                                           <div class="col-xs-6">
                                                               <input type="radio" name="inspect_result" value="PASS" <?php echo input_check($inspect_result, 'PASS') ;?> onclick="checkOption()" /> PASS</div>
                                                           <div class="col-xs-6">
                                                               <input type="radio" name="inspect_result" value="FAIL" <?php echo input_check($inspect_result, 'FAIL') ;?> onclick="checkOption()" /> FAIL</div>
                                                        </div>                                                        
                                                      </div>
                                                   </div>                                                 
                                              </div>
                                           </div>
                                           <!--//////////////four section///////////////-->
                                           <div>
                                              <div class="form-group">
                                                     <p> &nbsp; </p>
                                              </div>
                                               <div class="form-group">
                                                   <div class="col-lg-8">
<!--                                                       <p class="topline">&nbsp;</p>-->
                                                       <div class="col-lg-2"><label class="control-label pull-left" >VEHICLE MILEAGE#</label></div>
                                                       <div  class="col-lg-10">
                                                           <input type="number" name="vehicle_mileage"  class="form-control" value="<?php echo $vehicle_mileage ?>" />
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4">
                                                           <div class="col-lg-6"><label class="control-label pull-left" >LICENSE PLATE# </label></div>
                                                           <div class="col-lg-6">
                                                               <input type="text" name="license_plate"  class="form-control" value="<?php echo $license_plate ?>" />
                                                           </div>
                                                   </div>
                                               </div>
                                               <div class="form-group">
                                                   <div class="col-lg-8">
                                                       <div class="col-lg-2"><label class="control-label pull-left" >VIN#</label></div>
                                                       <div  class="col-lg-10">
                                                           <input type="text" name="vin"  class="form-control" value="<?php echo $vin ?>" />
                                                       </div>
                                                   </div>
                                                   <div class="col-lg-4">
                                                       <div class="col-lg-6"><label class="control-label pull-left" >VEHICLE MAKE</label></div>
                                                       <div class="col-lg-6">
                                                           <input type="text" name="vehicle_make"  class="form-control" value="<?php echo $vehicle_make ?>" />
                                                       </div>
                                                   </div>
                                               </div>
                                              <div class="form-group">
                                                 <div class="col-lg-4">
                                                     <div class="col-lg-4"><label class="control-label pull-left" >VEHICLE MODEL</label></div>
                                                     <div  class="col-lg-8">
                                                         <input type="text" name="vehicle_model"  class="form-control" value="<?php echo $vehicle_model ?>" />
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-4">
                                                     <div class="col-lg-6"><label class="control-label pull-left" >MODEL YEAR#</label></div>
                                                     <div  class="col-lg-6">
                                                         <input type="number" name="model_year"  class="form-control" value="<?php echo $model_year ?>" />
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-4">
                                                     <div class="col-lg-6"><label class="control-label pull-left" >OF DOORS#</label></div>
                                                     <div class="col-lg-6">
                                                         <input type="number" name="of_doors"  class="form-control" value="<?php echo $of_doors ?>" />
                                                     </div>
                                                 </div>
                                              </div>
                                              <div class="form-group">
                                                 <div class="col-lg-4">
                                                     <div class="col-lg-4"><label class="control-label pull-left" >INSPECTOR NAME</label></div>
                                                     <div  class="col-lg-8">
                                                         <input type="text" name="inspector_name"  class="form-control" value="<?php echo $inspector_name ?>" />
                                                     </div>
                                                 </div>
                                                 <div class="col-lg-8">
                                                     <div class="col-lg-3"><label class="control-label pull-left" >INSPECTION ADDRESS</label></div>
                                                     <div  class="col-lg-9">
                                                         <input type="text" name="inspection_address"  class="form-control" value="<?php echo $inspection_address ?>" />
                                                     </div>
                                                 </div>
                                              </div>
                                           </div>
                                           <!--//////////////four section end//////////-->
                                            <div class="form-group">
                                                <div class="col-lg-10">
                                                    <?php
                                                     if($id > 0) {
                                                         ?>
<!--                                                         <button style="display:block;" class="btn btn-success" name="update" id="notification-trigger-bouncyflip" type="submit">-->
<!--                                                             <span id="category_button" class="content">Update</span>-->
<!--                                                         </button>-->
                                                         <?php
                                                     }else {
                                                         ?>
                                                         <button style="display:block;" class="btn btn-success" name="save" id="insepction_submit" type="submit">
                                                             <span id="category_button" class="content">Submit</span>
                                                         </button>
                                                         <?php
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
	<script>
		function validate() {
            var inspection_result = $(':radio[name="inspect_result"]:checked').val();
            if(inspection_result == null) {
                alert("Please enter Inspection Result!");
                return false;
            }

            var check = true;
            $('#inspectform input').each(function () {
                if(this.type == 'checkbox') {
                    var check_val = $(':checkbox[name="'+this.name+'"]:checked').val();
                    var check_pass = false;
                    if(check_val == inspection_result) check_pass = true ;
                    if(inspection_result == 'PASS') {
                        if(check_pass == false) {
                            check = false;
                        }
                    }
                    if(inspection_result == 'FAIL' && check_pass == true) {
                        check = true;
                        return;
                    }
                }
            });

            if(check == false) {
                alert(' In order to '+inspection_result+' inspection all options should '+inspection_result+'.');
                return false;
            }
		}

        //check all option
        function checkOption() {
            var selected_checkbox = false;
            $('#inspectform input').each(function () {
                if(this.type == 'checkbox') {
                    var check_val = $(':checkbox[name="'+this.name+'"]:checked').val();
                    if(check_val == 'PASS' || check_val == 'FAIL') selected_checkbox = true ;
                }
            });
            if(selected_checkbox == false) {
                var radio_option =  $(':radio[name="inspect_result"]:checked').val();
                alert('In order to '+radio_option+' inspection one options should '+radio_option+'.');
                $(':radio[name="inspect_result"]').prop('checked', false);
                return false;
            }

            $('#inspectform input').each(function () {
                if(this.type == 'checkbox') {
                    var radio_option =  $(':radio[name="inspect_result"]:checked').val();
                    var check_val = $(':checkbox[name="'+this.name+'"]:checked').val();

                    if(radio_option != check_val && radio_option == 'PASS' ) {
                        alert('In order to PASS inspection all options should PASS.');
                        $(':radio[name="inspect_result"]').prop('checked', false);
                        return false;
                    }
                    if(radio_option == check_val && radio_option == 'FAIL') {
                        return ;
                    }
                }
                if(this.type == 'text') {
                    if(this.value == '') {
                        alert(' All text of input tag are empty. Please enter all text.');
                        $(':radio[name="inspect_result"]').prop('checked', false);
                        return false;
                    }
                }
            });
        }
	</script>
</body>
</html>
