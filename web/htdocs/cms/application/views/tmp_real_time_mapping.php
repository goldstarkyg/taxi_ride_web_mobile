<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="google-translate-customization" content="e6d13f48b4352bb5-f08d3373b31c17a6-g7407ad622769509b-12"></meta>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Real Time Mapping - NaqilCom</title>

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

    <!--[if lt IE 9]>
    <script src="<?php echo base_url();?>application/views/js/html5shiv.js"></script>
    <script src="<?php echo base_url();?>application/views/js/respond.min.js"></script>
    <![endif]-->
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
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="content-header" class="clearfix">
                                    <div class="pull-left">
                                        <ol class="breadcrumb">
                                            <li><a href="#">Home</a></li>
                                            <li class="active"><span>Real Time Mapping</span></li>
                                        </ol>
                                        <h1>Real Time Mapping</h1>
                                    </div>

                                    <div class="pull-right hidden-xs">
                                        <div class="xs-graph pull-left">
                                            <div class="graph-label">
                                                <?php
                                                $query = $this->db->query("Select count(id) as count From `bookingdetails` where status=9");
                                                $row = $query->row('bookigndetails');
                                                ?>
                                                <b><i class="fa fa-car"></i> <?php echo $row->count; ?></b> Rides
                                            </div>
                                            <div class="graph-content spark-orders"></div>
                                        </div>

                                        <div class="xs-graph pull-left mrg-l-lg mrg-r-sm">
                                            <div class="graph-label">
                                                <?php
                                                $query = $this->db->query("SELECT SUM(final_amount) as sum FROM `bookingdetails`");
                                                $row = $query->row('bookingdetails');
                                                if($row->sum) {
                                                    ?>
                                                    <b>ريال <?php echo $row->sum; ?></b> Earnings <!--Revenues-->
                                                    <?php
                                                }else{
                                                    ?>
                                                    <b>&dollar; 0</b> Earnings <!--Revenues-->
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                            <div class="graph-content spark-revenues"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <style>
                        /* Always set the map height explicitly to define the size of the div
                         * element that contains the map. */
                        #map {
                            height: 100%;
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
                    <div class="col-lg-9">
                        <input id="pac-input" class="controls" type="text"
                               placeholder="Enter a location">
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
                        <div id="map" style="height: 500px">
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <u>Driver Status:</u><br />
                        <img alt="" src="http://maps.google.com/mapfiles/ms/icons/green.png" />
                        Online<br />
                        <img alt="" src="http://maps.google.com/mapfiles/ms/icons/red.png" />
                        Offline<br />
                        <img alt="" src="http://maps.google.com/mapfiles/ms/icons/grey.png" />
                        Busy<br />
                    </div>
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
                        // This example requires the Places library. Include the libraries=places
                        // parameter when you first load the API. For example:
                        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
                        var jsonArray = [];
                        function initMap() {
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: {lat: 22.2779282, lng: 70.7856665},
                                zoom: 13
                            });
                            var input = /** @type {!HTMLInputElement} */(
                                document.getElementById('pac-input'));

                            //var types = document.getElementById('type-selector');
                            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
                            //map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);

                            var autocomplete = new google.maps.places.Autocomplete(input);
                            autocomplete.bindTo('bounds', map);

                            var infowindow = new google.maps.InfoWindow();
                            var marker = new google.maps.Marker({
                                map: map,
                                anchorPoint: new google.maps.Point(0, -29)
                            });

                            autocomplete.addListener('place_changed', function() {
                                infowindow.close();
                                marker.setVisible(false);
                                var place = autocomplete.getPlace();
                                var lat = place.geometry.location.lat();
                                var lng = place.geometry.location.lng();
                                $.ajax({
                                    url: '<?php echo base_url() ?>admin/find_markers',
                                    type:'POST',
                                    dataType: 'html',
                                    crossDomain : true,
                                    data: {
                                        "lat" : lat,
                                        "lng": lng
                                    },
                                    success: function(res) {
                                        alert(res);
                                        var response = JSON.parse(res);
                                        if(response.data!=''){
                                            var i=0;
                                            $.each(response.data, function(key,value){
                                                var latitude = value.loc[0];
                                                var longitude = value.loc[1];
                                                var driver_id = value.driver_id;
                                                var driver_name = value.driver_name;
                                                var car_type = value.car_type;
                                                i++;
                                                jsonArray[i][Dlat]=latitude;
                                                jsonArray[i][Dlng]=longitude;
                                                jsonArray[i][Dtitle]=driver_name;
                                                jsonArray[i][Dtitle]=driver_name;
                                                jsonArray[i][Ddescription]='';
                                            });
                                        }
                                        else{
                                            alert('No Data');
                                        }
                                    }
                                });
                                if (!place.geometry) {
                                    // User entered the name of a Place that was not suggested and
                                    // pressed the Enter key, or the Place Details request failed.
                                    window.alert("No details available for input: '" + place.name + "'");
                                    return;
                                }

                                // If the place has a geometry, then present it on a map.
                                if (place.geometry.viewport) {
                                    map.fitBounds(place.geometry.viewport);
                                } else {
                                    map.setCenter(place.geometry.location);
                                    map.setZoom(17);  // Why 17? Because it looks good.
                                }
                                marker.setIcon(/** @type {google.maps.Icon} */({
                                    url: place.icon,
                                    size: new google.maps.Size(71, 71),
                                    origin: new google.maps.Point(0, 0),
                                    anchor: new google.maps.Point(17, 34),
                                    scaledSize: new google.maps.Size(35, 35)
                                }));
                                marker.setPosition(place.geometry.location);
                                marker.setVisible(true);

                                var address = '';
                                if (place.address_components) {
                                    address = [
                                        (place.address_components[0] && place.address_components[0].short_name || ''),
                                        (place.address_components[1] && place.address_components[1].short_name || ''),
                                        (place.address_components[2] && place.address_components[2].short_name || '')
                                    ].join(' ');
                                }

                                infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
                                infowindow.open(map, marker);
                            });

                            // Sets a listener on a radio button to change the filter type on Places
                            // Autocomplete.
                            /*function setupClickListener(id, types) {
                             var radioButton = document.getElementById(id);
                             radioButton.addEventListener('click', function() {
                             autocomplete.setTypes(types);
                             });
                             }*/

                            //setupClickListener('changetype-all', []);
                            //setupClickListener('changetype-address', ['address']);
                            //setupClickListener('changetype-establishment', ['establishment']);
                            //setupClickListener('changetype-geocode', ['geocode']);
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5WgfHn67qGhlT_qAZOBiU5zMXz67qhE&libraries=places&callback=initMap"
                            async defer></script>
                </div>

                <footer id="footer-bar" class="row">
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

<?php
$query = $this->db->query("SELECT YEAR(book_create_date_time) AS y, MONTH(book_create_date_time) AS m, count(id) AS count FROM `bookingdetails` WHERE status=9 AND YEAR(book_create_date_time) = YEAR(CURDATE()) GROUP BY y,m");
if($query){
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
$push_ride_per_month=implode(',',$ride_per_month);

$query1 = $this->db->query("SELECT YEAR(book_create_date_time) AS y, MONTH(book_create_date_time) AS m, sum(final_amount) AS sum FROM `bookingdetails` WHERE status=9 AND YEAR(book_create_date_time) = YEAR(CURDATE()) GROUP BY y,m");
if($query1){
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
$push_earning_per_month=implode(',',$earning_per_month);
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

    });
</script>

</body>
</html>