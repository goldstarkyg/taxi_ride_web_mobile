<?php
include ('language.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="google-translate-customization" content="e6d13f48b4352bb5-f08d3373b31c17a6-g7407ad622769509b-12"></meta>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Real Time Mapping - OK Switzerland</title>

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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>application/views/css/libs/timeline.css">

    <!-- Favicon -->
    <link type="image/x-icon" href="<?php echo base_url();?>upload/favicon.png" rel="shortcut icon" />

    <!-- google font libraries -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>

    <link href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css" rel="stylesheet" type="text/css"/>

    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
    <![endif]-->
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
               

                <div class="row">
                    <style>
                        /* Always set the map height explicitly to define the size of the div
                         * element that contains the map. */
                        #map {
                            width:100%;
                            height:97%;
                            position: absolute;
                            top: 0px;
                            left: 0px;
                        }
                        .controls {
                            margin-top: 10px;
                            border: 1px solid transparent;
                            border-radius: 2px 0 0 2px;
                            box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            height: 32px;
                            outline: none;
                            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
                        }

                        #pac-input {
                            background-color: #fff;
                            font-family: Roboto;
                            font-size: 15px;
                            font-weight: 300;
                            margin-left: 12px;
                            padding: 0 11px 0 13px;
                            text-overflow: ellipsis;
                            width: 300px;
                        }

                        #pac-input:focus {
                            border-color: #4d90fe;
                        }

                        .pac-container {
                            font-family: Roboto;
                        }

                        #type-selector {
                            color: #fff;
                            background-color: #4d90fe;
                            padding: 5px 11px 0px 11px;
                        }

                        #type-selector label {
                            font-family: Roboto;
                            font-size: 13px;
                            font-weight: 300;
                        }
                    </style>
                    <!--<div class="col-lg-12">-->
                        <input id="pac-input" class="controls" type="text"
                               placeholder="<?php echo $Enter_a_location_lng; ?>">
                        <!--<div id="type-selector" class="controls">
                            <input type="radio" name="type" id="changetype-all" checked="checked">
                            <label for="changetype-all">All</label>

                            <input type="radio" name="type" id="changetype-establishment">
                            <label for="changetype-establishment">Establishments</label>

                            <input type="radio" name="type" id="changetype-address">
                            <label for="changetype-address">Addresses</label>

                            <input type="radio" name="type" id="changetype-geocode">
                            <label for="changetype-geocode">Geocodes</label>
                        </div>-->
                        <div id="loader-div" style="display:none;"><img src="<?php echo base_url().'upload/loader.gif'?>"/></div>
                        <div id="map"></div>
                    </div>
                    <!--<div class="col-lg-12">
                        <u><?php echo $Driver_Status_lng; ?>:</u><br />
                        <img alt="" src="http://maps.google.com/mapfiles/ms/icons/green.png" />
                        <?php echo $Online_lng; ?><br />
                        <img alt="" src="http://maps.google.com/mapfiles/ms/icons/red.png" />
                        <?php echo $Offline_lng; ?><br />
                        <img alt="" src="http://maps.google.com/mapfiles/ms/icons/grey.png" />
                        <?php echo $Busy_lng; ?><br />
                    </div>-->
                    <?php
                    /*foreach($query1 as $row1){
                        $marker_array['title'] = $row1['name'];
                        if($row1['pickup_lat']==null || $row1['pickup_long']==null){
                            $marker_array['lat'] = '22.280456';
                            $marker_array['lng'] = '70.775735';
                        }
                        else{
                            $marker_array['lat'] = $row1['pickup_lat'];
                            $marker_array['lng'] = $row1['pickup_long'];
                        }
                        $marker_array['description'] = $row1['name'];
                        if($row1['status']=='1' && $row1['socket_status']=='1'){
                            if(isset($row1['driver_flag'])){
                                if($row1['driver_flag']=='2' || $row1['driver_flag']=='3'){
                                    $marker_array['type'] = 'Online';
                                }
                                else{
                                    $marker_array['type'] = 'Busy';
                                }
                            }
                            else{
                                $marker_array['type'] = 'Online';
                            }
                        }
                        else{
                            $marker_array['type'] = 'Offline';
                        }
                        $json_array[] = $marker_array;
                    }*/
                    ?>
                    <script type="text/javascript">
                        var markers = [];
                        var markersToRemove = [];
                        var map = '';
                        var lat = '';
                        var lng = '';
                        var infowindow = '';
                        var latlngbounds = '';
                        var marker = '';
                        var place = '';
                        //var marker1 = '';
                        function initMap() {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: 47.376887, lng: 8.541694},
                                zoom: 13
                            });

                            var input = /** @type {!HTMLInputElement} */(
                                document.getElementById('pac-input'));

                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                            var autocomplete = new google.maps.places.Autocomplete(input);
                            autocomplete.bindTo('bounds', map);

                            infowindow = new google.maps.InfoWindow({maxWidth: 500});
                            latlngbounds = new google.maps.LatLngBounds();

                            marker = new google.maps.Marker({
                                map: map,
                                anchorPoint: new google.maps.Point(0, -29)
                            });

                            /*marker1 = new google.maps.Marker({
                                draggable: true,
                                position: map.getCenter(),
                                map: map,
                                title: "Your Center"
                            });*/

                            autocomplete.addListener('place_changed', function() {
                                removeMarkers();
                                markersToRemove = [];
                                infowindow.close();
                                place = autocomplete.getPlace();
                                if (!place.geometry) {
                                    // User entered the name of a Place that was not suggested and
                                    // pressed the Enter key, or the Place Details request failed.
                                    window.alert("No details available for input: '" + place.name + "'");
                                    return;
                                }

                                // If the place has a geometry, then present it on a map.
                                if (place.geometry.viewport) {
                                     map.fitBounds(place.geometry.viewport);
                                     lat = map.getCenter().lat();
                                     lng = map.getCenter().lng();
                                     //alert('On Address change Lat:'+lat);
                                     //alert('On Address change Lng:'+lng);
                                     find_markers(lat,lng);
                                     //marker1.setPosition(map.getCenter());
                                } else {
                                    alert('Currently there is no driver available for this location');
                                    //map.setCenter(place.geometry.location);
                                    //map.setZoom(13);  // Why 17? Because it looks good.
                                }

                                var address = '';
                                if (place.address_components) {
                                    address = [
                                        (place.address_components[0] && place.address_components[0].short_name || ''),
                                        (place.address_components[1] && place.address_components[1].short_name || ''),
                                        (place.address_components[2] && place.address_components[2].short_name || '')
                                    ].join(' ');
                                }
                            });

                            //Retrive the center location
                            /*google.maps.event.addListener(map, "center_changed", function() {
                                infowindow.setContent(map.getCenter().toUrlValue());
                                infowindow.setPosition(map.getCenter());
                                infowindow.open(map);
                                alert('On Center change Lat:'+lat);
                                alert('On Center change Lng:'+lng);
                                lat = map.getCenter().lat();
                                lng = map.getCenter().lng();
                            });*/

                            google.maps.event.addListener(map, "dragend",function(){
                                lat = map.getCenter().lat();
                                lng = map.getCenter().lng();
                                //alert('On DragEnd Lat:'+lat);
                                //alert('On DragEnd Lng:'+lng);
                                find_markers(lat,lng);
                                //map.setCenter(latlngbounds.getCenter());
                                //map.fitBounds(latlngbounds);
                                //map.setZoom(17);
                                //marker1.setPosition(map.getCenter());
                                //infowindow.setContent(map.getCenter().toUrlValue());
                                //infowindow.setPosition(map.getCenter());
                                //infowindow.open(map);
                            });
                        }

                        function find_markers(lat,lng){
                            //alert('Lat:'+lat);
                            //alert('Lng:'+lng);
                            removeMarkers();
                            markersToRemove = [];
                            //alert("Calling API");
                            $.ajax({
                                url: '<?php echo base_url() ?>admin/find_markers',
                                type: 'POST',
                                dataType: 'json',
                                crossDomain: true,
                                data: {
                                    "lat": lat,
                                    "lng": lng
                                },
                                beforeSend: function () {
                                    // SHOW DIV
                                    $('#loader-div').css('display', 'block');
                                },
                                success: function (res) {
                                    //alert('success');
                                    if (res.length != 0) {
                                        //markers = res;
                                        //var i = 0;
                                        var bounds = new google.maps.LatLngBounds();

                                        for (i = 0; i < res.length; i++) {
                                            var data = res[i];
                                            marker = new google.maps.Marker({
                                                position: new google.maps.LatLng(data.lat, data.lng),
                                                map: map
                                            });
                                        }
                                        bounds.extend(marker.position);
                                        map.fitBounds(bounds);

                                        /*var interval = setInterval(function () {
                                            var data = markers[i];
                                            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
                                            var icon = "";
                                            switch (data.type) {
                                                case "Online":
                                                    icon = "green";
                                                    break;
                                                case "Offline":
                                                    icon = "red";
                                                    break;
                                                case "Busy":
                                                    icon = "grey";
                                                    break;
                                            }
                                            icon = "http://maps.google.com/mapfiles/ms/icons/" + icon + ".png";
                                            var marker = new google.maps.Marker({
                                                position: myLatlng,
                                                map: map,
                                                title: data.title,
                                                animation: google.maps.Animation.DROP,
                                                icon: new google.maps.MarkerImage(icon)
                                            });
                                            markersToRemove.push(marker);
                                            (function (marker, data) {
                                                google.maps.event.addListener(marker, "click", function (e) {
                                                    $('#clicked-driver-id').val(data.driver_id);
                                                    $('#clicked-driver-cartype').val(data.car_type);
                                                    infowindow.setContent(data.description);
                                                    infowindow.open(map, marker);
                                                });
                                            })(marker, data);
                                            latlngbounds.extend(marker.position);
                                            i++;
                                            if (i == markers.length) {
                                                clearInterval(interval);
                                                var bounds = new google.maps.LatLngBounds();
                                                map.setCenter(latlngbounds.getCenter());
                                                map.fitBounds(latlngbounds);
                                                //map.setZoom(17);
                                            }
                                        }, 80);*/
                                    } else {
                                        marker.setVisible(false);
                                        //map.setCenter(map.getCenter());
                                        //map.setZoom(13);  // Why 17? Because it looks good.
                                        alert('Currently there is no driver available for this location');
                                    }
                                },
                                complete: function () {
                                    // Hide loading DIV
                                    $('#loader-div').css('display', 'none');
                                },
                                error: function (e) {
                                    marker.setVisible(false);
                                    alert('Something went wrong! Please try again.');
                                }
                            });
                        }

                        function removeMarkers() {
                            for(var i = 0; i < markersToRemove.length; i++) {
                                markersToRemove[i].setMap(null);
                            }
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5WgfHn67qGhlT_qAZOBiU5zMXz67qhE&libraries=places&callback=initMap"
                            async defer></script>
                <!--</div>-->

                <footer id="footer-bar" class="row">
                    <p id="footer-copyright" class="col-xs-12">
                        Powered by OK Switzerland.
                    </p>
                </footer>
                <input type="hidden" id="clicked-driver-id" name="clicked-driver-id"/>
                <input type="hidden" id="clicked-driver-cartype" name="clicked-driver-cartype"/>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Pending Booking List</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example" class="table user-list" style="width:100%">
                        <thead>
                        <tr>
                            <th></th>
                            <th><a href="javascript:void(0);">Booking ID</a></th>
                            <th><a href="javascript:void(0);">User Name</a></th>
                            <th><a href="javascript:void(0);">User ID</a></th>
                            <th><a href="javascript:void(0);">Taxi Type</a></th>
                            <th><a href="javascript:void(0);">From</a></th>
                            <th><a href="javascript:void(0);">To</a></th>
                            <th><a href="#" class="desc">Date</a></th>
                            <th>Status</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="assign-booking" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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

<!-- global scripts -->
<script src="<?php echo base_url();?>application/views/js/demo-skin-changer.js"></script> <!-- only for demo -->

<script src="<?php echo base_url();?>application/views/js/jquery.js"></script>
<script src="<?php echo base_url();?>application/views/js/bootstrap.js"></script>
<script src="<?php echo base_url();?>application/views/js/jquery.nanoscroller.min.js"></script>

<script src="<?php echo base_url();?>application/views/js/demo.js"></script> <!-- only for demo -->

<!-- this page specific scripts -->
<script src="<?php echo base_url();?>application/views/js/moment.min.js"></script>
<script src="<?php echo base_url();?>application/views/js/gdp-data.js"></script>
<script src="<?php echo base_url();?>application/views/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url();?>application/views/js/modernizr.js"></script>
<script src="<?php echo base_url();?>application/views/js/timeline.js"></script>

<!-- theme scripts -->
<script src="<?php echo base_url();?>application/views/js/scripts.js"></script>
<script src="<?php echo base_url();?>application/views/js/pace.min.js"></script>


<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/adminlte/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>

<?php
$query = $this->db->query("SELECT YEAR(book_create_date_time) AS y, MONTH(book_create_date_time) AS m, count(id) AS count FROM `bookingdetails` WHERE status=9 AND YEAR(book_create_date_time) = YEAR(CURDATE()) GROUP BY y,m");
if($query->num_rows() > 0){
    foreach($query->result() as $row)
    {
        for($i=1;$i<=12;$i++){
            if($row->m==$i)
            {
                if($row->count!=0 || $row->count!=NULL){
                    $ride_per_month[$i]=$row->count;
                }
                else{
                    $ride_per_month[$i]=0;
                }
            }
            else{
                $ride_per_month[$i]=0;
            }
        }
    }
}
else{
    $ride_per_month = 0;
}
if($ride_per_month!=0){
    $push_ride_per_month=implode(',',$ride_per_month);
}
else{
    $push_ride_per_month = 0;
}
$query1 = $this->db->query("SELECT YEAR(book_create_date_time) AS y, MONTH(book_create_date_time) AS m, sum(final_amount) AS sum FROM `bookingdetails` WHERE status=9 AND YEAR(book_create_date_time) = YEAR(CURDATE()) GROUP BY y,m");
if($query1->num_rows() > 0){
    foreach($query1->result() as $row1)
    {
        for($i=1;$i<=12;$i++){
            if($row1->m==$i)
            {
                if($row1->sum!=0 || $row1->sum!=NULL){
                    $earning_per_month[$i]=$row1->sum;
                }
                else{
                    $earning_per_month[$i]=0;
                }
            }
            else{
                if(!isset($earning_per_month[$i]))
                {
                    $earning_per_month[$i]=0;
                }
            }
        }
    }
}
else{
    $earning_per_month = 0;
}
if($earning_per_month!=0){
    $push_earning_per_month=implode(',',$earning_per_month);
}
else{
    $push_earning_per_month = 0;
}
?>

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
        /* SPARKLINE - graph in header */
        //var orderValues = [10,8,5,7,4,4,3,8,0,7,10,6];
        var orderValues = [<?php echo $push_ride_per_month; ?>];
        $('.spark-orders').sparkline(orderValues, {
            type: 'bar',
            barColor: '#ced9e2',
            height: 25,
            barWidth: 6
        });

        //var revenuesValues = [8,3,2,6,4,9,1,10,8,2,5,8];
        var revenuesValues = [<?php echo $push_earning_per_month; ?>];
        $('.spark-revenues').sparkline(revenuesValues, {
            type: 'bar',
            barColor: '#ced9e2',
            height: 25,
            barWidth: 6
        });

        $('#myModal').on('shown.bs.modal', function () {
            $.urlParam=function(name) {
                var results = new RegExp('[\\?&]' + name + '=([^&#]*)').exec(window.location.href);
                if (!results)
                {
                    return '';
                }
                return results[1] || '';
            };

            var filter='pending';

            if(filter && filter.match('pending')){
                var dataTable = $('#example').DataTable({
                    "processing": true,
                    "serverSide": true,
                    //"lengthMenu": [[5, 10, 20, -1], [5, 10, 20, "All"]],
		   "order": [[ 0, "desc" ]],
                    "columnDefs": [
                        {
                            orderable: false,
                            className: 'select-checkbox',
                            targets:   0
                        },
                        {
                            "targets": [ 1 ],
                            "visible": true,
                            "searchable": true,
                            "sortable" :true
                        },
                        {
                            "targets": [ 2 ],
                            "visible": true,
                            "searchable": true,
                            "sortable" :true
                        },
                        {
                            "targets": [ 3 ],
                            "visible": true,
                            "searchable": true,
                            "sortable" :true
                        },
                        {
                            "targets": [ 4 ],
                            "visible": true,
                            "searchable": true,
                            "sortable" :true
                        },
                        {
                            "targets": [ 5 ],
                            "visible": true,
                            "width": "20%",
                            "searchable": true,
                            "sortable" :true
                        },
                        {
                            "targets": [ 6 ],
                            "visible": true,
                            "width": "20%",
                            "searchable": true,
                            "sortable" :true
                        },
                        {
                            "targets": [ 7 ],
                            "visible": true,
                            "searchable": false,
                            "sortable" :false
                        },
                        {
                            "targets": [ 8 ],
                            "visible": true,
                            "searchable": false,
                            "sortable" :false
                        }
                    ],
                    select: {
                        style:    'os',
                        selector: 'td:first-child'
                    },
                    destroy: true,
                    "ajax": {
                        url: '<?php echo base_url(); ?>admin/get_select_booking_data', // json datasource
                        type: "post",  // method  , by default get
                        data: {
                            driver_id:parseInt($('#clicked-driver-id').val()),
                            car_type:parseInt($('#clicked-driver-cartype').val())
                        },
                        error: function () {  // error handling
                            $(".booking-grid-error").html("");
                            $("#example").append('<tbody class="booking-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                            $("#booking-grid_processing").css("display", "none");
                        }
                    }
                });
            }
            $(this).find('.modal-dialog').css({width:'auto', height:'100%', 'max-height':'100%'});
            $(this).find('.modal-content').css({height:'auto', 'min-height':'100%'});
        });

        $('#assign-booking').click(function(){
            $('#example tr').each(function() {
                if($(this).hasClass('selected'))
                {
                    var sel_id=$(this).find('td:nth-child(2)').html();
                    if(sel_id=='' || sel_id==null){
                        sel_id=null;
                    }
                }
                else
                {
                    sel_id=null;
                }
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>admin/update_driver_data",
                    data: {driver_id:parseInt($('#clicked-driver-id').val()),data_id: sel_id},
                    success: function (result) {
                        if(result == 0){
                            $(".taxi").html('<p class="error">Error</p>');
                            setTimeout(function(){$(".taxi").hide(); }, 3000);
                        }
                        else{
                            location.reload();
                            //$(".taxi").html('<p class="success">Booking Details Saved Successfully</p>');
                            //setTimeout(function(){$(".taxi").hide(); }, 1500);
                        }
                    },
                    async: false
                });
            });
        });
    });
</script>

</body>
</html>
