<?php
include ('language.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Manage Booking - <?php echo $header_title; ?></title>

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
                                        <h1><?php echo $Manage_Booking_lng;?></h1>
                                    </div>
                                    <div class="pull-right">
                                        <ol class="breadcrumb">
                                            <li><a href="#"><?php echo $home_lng; ?></a></li>
                                            <li class="active"><span><?php echo $Manage_Booking_lng;?></span></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- CONTEST Popup -------------------------------------------------------------------------------------------------------------------->
                        <div class="col-lg-12">
                            <!-- Single Delete -->
                            <div class="modal modal-alert modal-danger fade" id="uidemo-modals-alerts-delete-user">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <i style="font-size:35px;" class="glyphicon glyphicon-trash"></i>
                                        </div>
                                        <div class="modal-title"><?php echo $single_delete_alert_lng;?></div>
                                        <div class="modal-body"></div>
                                        <div class="modal-footer">
                                            <button id="confirm-delete-button" onclick="delete_single_booking_action()" data-dismiss="modal" class="btn btn-primary" type="button">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $OK_lng;?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <input type="hidden" value="" id="bookedid" name="bookedid">
                                            <button id="cancel-delete-button" data-dismiss="modal" class="btn btn-primary" type="button"><?php echo $CANCEL_lng;?></button>
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
                                        <div class="modal-title"><?php echo $single_delete_alert_lng;?></div>
                                        <div class="modal-body"></div>
                                        <div class="modal-footer">
                                            <button onclick="delete_booking()" data-dismiss="modal" class="btn btn-primary" type="button">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $OK_lng;?>&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                            <button data-dismiss="modal" class="btn btn-primary" type="button"><?php echo $CANCEL_lng;?></button>
                                        </div>
                                    </div> <!-- / .modal-content -->
                                </div> <!-- / .modal-dialog -->
                            </div> <!-- / .modal -->
                            <!-- / Multipal Delete -->
                        </div>
                        <!-- CONTEST Popup -------------------------------------------------------------------------------------------------------------------->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-box clearfix">
                                    <div class="panel">
                                        <div class="panel-body">
                                            <h2 class="pull-left"><?php echo $Manage_Booking_lng;?></h2>
                                            <!--<div class="filter-block pull-right">

                                                <a class="btn btn-primary pull-right" href="javascript:void(0)" onclick="window.location.href='booking-details.html'">
                                                    <i class="fa fa-plus-circle fa-lg"></i> Add
                                                </a>
                                                <span>&nbsp;</span>
                                                <div style="margin:0px !important;" class="form-group pull-right">
                                                    <input type="text" placeholder="Search..." class="form-control">
                                                    <i class="fa fa-search search-icon"></i>
                                                </div>
                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="main-box-body clearfix">
                                        <div class="table-responsive">
                                            <table id="example" class="table user-list">
                                                <thead>
                                                <tr>
                                                    <th><input type="checkbox" name="allcheck" id="allcheck"></th>
                                                    <th><a href="javascript:void(0);"><?php echo $User_Name_lng;?></a></th>
                                                    <th><a href="javascript:void(0);"><?php echo $User_ID_lng;?></a></th>
                                                    <th><a href="javascript:void(0);"><?php echo $Booking_ID_lng;?></a></th>
                                                    <th><a href="javascript:void(0);"><?php echo $Taxi_Type_lng;?></a></th>
                                                    <th class="text-center"><a href="javascript:void(0);"><?php echo $From_lng;?></a></th>
                                                    <th class="text-center"><a href="javascript:void(0);"><?php echo $To_lng;?></a></th>
                                                    <th class="text-center"><a href="#" class="desc"><?php echo $Date_lng;?></a></th>
                                                    <th class="text-center"><?php echo $Status_lng;?></th>
                                                    <th class="text-center"><?php echo $Action_lng;?></th>
                                                </tr>
                                                </thead>
                                            </table>
                                        </div>
					<?php
                                        $permission_page = $this->session->userdata('permission_page');
                                        $permission_name = $this->session->userdata('username');
                                        $permission = true;
                                        $status_code = '' ;
                                        if(!empty($_GET['status_code'])) $status_code = $_GET['status_code'];
                                        $property = "";
                                        if ($status_code == '') $property = MANAGEBOOKING_ALLBOOKING_DELETE;
                                        if ($status_code == 'pending') $property = MANAGEBOOKING_PENDNINGBOOKING_DELETE;
                                        if ($status_code == 'user-cancelled') $property = MANAGEBOOKING_USERCANCELBOOKING_DELETE;
                                        if ($status_code == 'driver-unavailable') $property = MANAGEBOOKING_DRIVERCANCELBOOKING_DELETE;

                                        if($permission_name == 'staff' )  {
                                            if (!in_array($property, $permission_page)) {
                                                $permission = false;
                                            }
                                        }

                                        if($permission == true) {
                                        ?>
                                        <button style="margin:6px 0px;" class="btn btn-primary pull-left" data-toggle="modal" data-target="#uidemo-modals-alerts-delete-multipaluser" id="multi"><?php echo $Multiple_Delete_lng;?></button>
                                        <!--<ul class="pagination pull-right">
                                            <li><a href="javascript:void(0);"><i class="fa fa-chevron-left"></i></a></li>
                                            <li><a href="javascript:void(0);">1</a></li>
                                            <li><a href="javascript:void(0);">2</a></li>
                                            <li><a href="javascript:void(0);">3</a></li>
                                            <li><a href="javascript:void(0);">4</a></li>
                                            <li><a href="javascript:void(0);">5</a></li>
                                            <li><a href="javascript:void(0);"><i class="fa fa-chevron-right"></i></a></li>
                                        </ul>-->
					 <?php } ?>
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
                <input type="hidden" name="filter_col" id="filter_col" value="<?php echo $query; ?>"/>
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
<script src="<?php echo base_url();?>application/views/js/jquery.dataTables.js"></script>
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
    $(document).ready(function() {
        $.urlParam=function(name) {
            var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
            if (!results)
            {
                return '';
            }
            return results[1] || '';
        };
        if($('#filter_col').val()=='user_id')
        {
            var filter=$.urlParam('user_id');
        }
        else if($('#filter_col').val()=='status_code')
        {
            var filter=$.urlParam('status_code');
        }
        if(filter && filter.match('pending')){
            var dataTable = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            //"oSearch": {"sSearch": filter},
            "order": [[ 3, "desc" ]],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": true,
                    "width": "1%",
                    "searchable": false,
                    "sortable": false

                },
                {
                    "targets": [1],
                    "visible": true,
                    "width": "12%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [2],
                    "visible": true,
                    "width": "10%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [3],
                    "visible": true,
                    "width": "12%",
                    "type": "numeric",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [4],
                    "visible": true,
                    "width": "11%",
                    "searchable": true,
                    "sortable": true   
                },
                {
                    "targets": [5],
                    "visible": true,
                    "width": "12%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [6],
                    "visible": true,
                    "width": "12%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [7],
                    "visible": true,
                    "width": "10%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [8],
                    "visible": true,
                    "width": "10%",
                    "searchable": false,
                    "sortable": false

                },
                {
                    "targets": [9],
                    "visible": true,
                    "width": "10%",
                    "searchable": false,
                    "sortable": false

                }
            ],
            "ajax": {
                url: '<?php echo base_url(); ?>admin/get_nondisp_booking_data', // json datasource
                type: "post",  // method  , by default get
                //data: {data_id: filter},
                error: function () {  // error handling
                    $(".booking-grid-error").html("");
                    $("#example").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#booking-grid_processing").css("display", "none");
                }
            }
        });
        }
        else{
            if(!filter){
                filter='';
            }
        var dataTable = $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            //"oSearch": {"sSearch": filter},
            "order": [[ 3, "desc" ]],
            "columnDefs": [
                {
                    "targets": [0],
                    "visible": true,
                    "width": "1%",
                    "searchable": false,
                    "sortable": false

                },
                {
                    "targets": [1],
                    "visible": true,
                    "width": "12%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [2],
                    "visible": true,
                    "width": "10%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [3],
                    "visible": true,
                    "width": "12%",
                    "type": "numeric",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [4],
                    "visible": true,
                    "width": "11%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [5],
                    "visible": true,
                    "width": "12%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [6],
                    "visible": true,
                    "width": "12%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [7],
                    "visible": true,
                    "width": "10%",
                    "searchable": true,
                    "sortable": true

                },
                {
                    "targets": [8],
                    "visible": true,
                    "width": "10%",
                    "searchable": false,
                    "sortable": false

                },
                {
                    "targets": [9],
                    "visible": true,
                    "width": "10%",
                    "searchable": false,
                    "sortable": false

                }
            ],
            "ajax": {
                url: '<?php echo base_url(); ?>admin/get_booking_data', // json datasource
                type: "post",  // method  , by default get
                data: {data_id: filter},
                error: function () {  // error handling
                    $(".booking-grid-error").html("");
                    $("#example").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#booking-grid_processing").css("display", "none");
                }
            }
        });
}
        $("#allcheck").on('click',function() { // bulk checked
            var status = this.checked;
            $(".deleteRow").each( function() {
                $(this).prop("checked",status);
            });
        });
    } );
    function delete_booking(){
        if( $('.deleteRow:checked').length > 0 ){  // at-least one checkbox checked
            var ids = [];
            $('.deleteRow').each(function(){
                if($(this).is(':checked')) {
                    ids.push($(this).val());
                }
            });
            var ids_string = ids.toString();  // array to string conversion
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/delete_booking_data",
                data: {data_ids:ids_string},
                success: function(result) {
                    var oTable1 = $('#example').DataTable();
                    oTable1.ajax.reload(null, false);
                },
                async:false
            });
        }
    }
    function delete_single_booking(single_id){
            $('#bookedid').val(single_id);
    }
    function delete_single_booking_action()
    {
       var single_id = $('#bookedid').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/delete_single_booking_data",
            data: {data_id: single_id},
            success: function (result) {
                var oTable1 = $('#example').DataTable();
                oTable1.ajax.reload(null, false);
            },
            async: false
        });
    }
</script>
</body>
</html>
