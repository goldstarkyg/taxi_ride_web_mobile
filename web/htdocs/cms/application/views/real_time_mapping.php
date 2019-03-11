<?php
include ('language.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="google-translate-customization" content="e6d13f48b4352bb5-f08d3373b31c17a6-g7407ad622769509b-12"></meta>

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>Real Time Mapping - <?php echo $header_title; ?></title>

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
    <!--<script src="https://maps.googleapis.com/maps/api/js?v=3&libraries=places&sensor=false"></script>-->
    <!--<link rel="stylesheet" href="<?php echo base_url();?>assets/leaflet/leaflet.css" />-->
    <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.4.4/leaflet.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.4.4/leaflet.ie.css" /><![endif]-->
    <script src="http://cdn.leafletjs.com/leaflet-0.4.4/leaflet.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr5WgfHn67qGhlT_qAZOBiU5zMXz67qhE&libraries=places"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/leaflet/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/leaflet/MarkerCluster.Default.css" />
    <script type='text/javascript' src='<?php echo base_url();?>assets/leaflet/leaflet.markercluster-src.js'></script>
    <script src="<?php echo base_url();?>assets/leaflet/leaflet-google-autocomplete.js"></script>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/leaflet/leaflet-google-autocomplete.css" />
    <!--<script src="<?php echo base_url();?>assets/leaflet/leaflet.js"></script> <!-- or use leaflet-src.js --!>
    <!-- end loader-->

    <style>
        #map {
        width: 100%;
        height: 97%;
        position: absolute;
        top: 0;
        left: 0;
        }
         .search-input {
      font-family: Courier
    }

    .search-input,
    .leaflet-control-search {
      max-width: 400px;
    }
    </style>
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
                    <div id="map"></div>
                    <script type="text/javascript">
                        var markersToRemove = [];
                        var url = "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
                        var buildMap = new L.TileLayer(url),
                        latlng = new L.LatLng(33.717471,-117.831143);
                        //latlng = new L.LatLng(22.2734719,70.7512553);
                        var map = new L.Map('map', {center:latlng, zoom: 13, layers: [buildMap]});

                        //var googleLayer = new L.Google('ROADMAP');
                        //map.addLayer(googleLayer);
                        //new L.Control.GoogleAutocomplete().addTo(map);

                        var geoSearchController = new L.Control.GeoSearch({
                            provider: new L.GeoSearch.Provider.Google()
                        }).addTo(map);

                        /*var GooglePlacesSearchBox = L.Control.extend({
                          onAdd: function() {
                            var element = document.createElement("input");
                            element.id = "searchBox";
                            return element;
                          }
                        });

                        (new GooglePlacesSearchBox).addTo(map);*/

                        var input = document.getElementById("leaflet-control-geosearch-qry");
                        var searchBox = new google.maps.places.SearchBox(input);

                        //var searchBox = $('#leaflet-control-googleautocomplete-qry').val();
                        $.ajax({
                            url: '<?php echo base_url() ?>admin/find_markers',
                            type: 'POST',
                            dataType: 'json',
                            crossDomain: true,
                            data: {
                                "lat": '36.7571291',
                                "lng": '-119.7737004'
                                //"lat": '22.2734719',
                                //"lng": '70.7512553'
                            },
                            beforeSend: function () {
                                // SHOW DIV
                                //$('#loader-div').css('display', 'block');
                            },
                            success: function (res) {
                                //alert('success');
                                if (res.length != 0)
                                {

                                    //var latlngArr = [];
                                    var markerClusters = new L.MarkerClusterGroup({ disableClusteringAtZoom: 17 });
                                    for (i = 0; i < res.length; i++)
                                    {
                                        var data = res[i];
                                        var custom_icon = "";
                                        switch (data.type) {
                                            case "Online":
                                                custom_icon = "green";
                                                break;
                                            case "Offline":
                                                custom_icon = "red";
                                                break;
                                            case "Busy":
                                                custom_icon = "grey";
                                                break;
                                        }
                                        custom_icon = "http://maps.google.com/mapfiles/ms/icons/" + custom_icon + ".png";
                                        var useIcon = L.icon({
                                            iconUrl: custom_icon,
                                            //shadowUrl: 'leaf-shadow.png',

                                            iconSize:     [24, 24], // size of the icon
                                            shadowSize:   [50, 64], // size of the shadow
                                            iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                                            shadowAnchor: [4, 62],  // the same for the shadow
                                            popupAnchor:  [-10, -96] // point from which the popup should open relative to the iconAnchor
                                        });
                                        //latlngArr.push([data.lat,data.lng]);
                                        //marker = new L.marker([data.lat,data.lng],{icon: useIcon}).bindPopup(data.description).addTo(map);
                                        var marker = new L.marker(new L.LatLng(data.lat,data.lng),{icon: useIcon});
                                        marker.bindPopup(data.description);
                                        markerClusters.addLayer( marker );
                                        //bounds.extend(marker.getLatLng());
                                        markersToRemove.push(marker);
                                    }
                                    map.addLayer( markerClusters );
                                    //var Points = [latlngArr];
                                    //var bounds = new L.LatLngBounds(Points);
                                    //map.fitBounds(bounds, {padding: [50, 50]});

                                } else {
                                    //marker.setVisible(false);
                                    //map.setCenter(map.getCenter());
                                    //map.setZoom(13);  // Why 17? Because it looks good.
                                    alert('Currently there is no driver available for this location');
                                }
                            },
                            complete: function () {
                                // Hide loading DIV
                                //$('#loader-div').css('display', 'none');
                            },
                            error: function (e) {
                                //marker.setVisible(false);
                                //alert('Something went wrong! Please try again.');
                            }
                        });

                        searchBox.addListener('places_changed', function()
                        {
                            var places = searchBox.getPlaces();
                            removeMarkers();
                            markersToRemove = [];
                            if (places.length == 0) {
                                return;
                            }
                            places.forEach(function(place)
                            {
                                $.ajax({
                                    url: '<?php echo base_url() ?>admin/find_markers',
                                    type: 'POST',
                                    dataType: 'json',
                                    crossDomain: true,
                                    data: {
                                        "lat": place.geometry.location.lat(),
                                        "lng": place.geometry.location.lng()
                                    },
                                    beforeSend: function () {
                                        // SHOW DIV
                                        //$('#loader-div').css('display', 'block');
                                    },
                                    success: function (res) {
                                        //alert('success');
                                        if (res.length != 0)
                                        {

                                            var latlngArr = [];
                                            var markerClusters = new L.MarkerClusterGroup({ disableClusteringAtZoom: 17 });
                                            for (i = 0; i < res.length; i++)
                                            {
                                                var data = res[i];
                                                var custom_icon = "";
                                                switch (data.type) {
                                                    case "Online":
                                                        custom_icon = "green";
                                                        break;
                                                    case "Offline":
                                                        custom_icon = "red";
                                                        break;
                                                    case "Busy":
                                                        custom_icon = "grey";
                                                        break;
                                                }
                                                custom_icon = "http://maps.google.com/mapfiles/ms/icons/" + custom_icon + ".png";
                                                var useIcon = L.icon({
                                                    iconUrl: custom_icon,
                                                    //shadowUrl: 'leaf-shadow.png',

                                                    iconSize:     [24, 24], // size of the icon
                                                    shadowSize:   [50, 64], // size of the shadow
                                                    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                                                    shadowAnchor: [4, 62],  // the same for the shadow
                                                    popupAnchor:  [-10, -96] // point from which the popup should open relative to the iconAnchor
                                                });
                                                //marker = new L.marker([data.lat,data.lng],{icon: useIcon}).bindPopup(data.description).addTo(map);
                                                var marker = new L.marker(new L.LatLng(data.lat,data.lng),{icon: useIcon});
                                                marker.bindPopup(data.description);
                                                markerClusters.addLayer( marker );
                                                //bounds.extend(marker.getLatLng());
                                                markersToRemove.push(marker);
                                                latlngArr.push(marker);
                                            }
                                            map.addLayer( markerClusters );

                                            var group = L.featureGroup(latlngArr); //add markers array to featureGroup
                                            map.fitBounds(group.getBounds());
                                            //var Points = [latlngArr];
                                            //var bounds = new L.LatLngBounds(Points);
                                            //map.fitBounds(markerClusters, {padding: [50, 50]});

                                        } else {
                                            //marker.setVisible(false);
                                            //map.setCenter(map.getCenter());
                                            //map.setZoom(13);  // Why 17? Because it looks good.
                                            alert('Currently there is no driver available for this location');
                                        }
                                    },
                                    complete: function () {
                                        // Hide loading DIV
                                        //$('#loader-div').css('display', 'none');
                                    },
                                    error: function (e) {
                                        //marker.setVisible(false);
                                        alert('Something went wrong! Please try again.');
                                    }
                                });
                            });
                        });

                        map.on('dragend',function(event){
                            removeMarkers();
                            markersToRemove = [];
                            dlat = map.getCenter().lat;
                            dlng = map.getCenter().lng;
                            //alert(dlat);
                            //alert(dlng);
                            $.ajax({
                                url: '<?php echo base_url() ?>admin/find_markers',
                                type: 'POST',
                                dataType: 'json',
                                crossDomain: true,
                                data: {
                                    "lat": dlat,
                                    "lng": dlng
                                },
                                beforeSend: function () {
                                    // SHOW DIV
                                    //$('#loader-div').css('display', 'block');
                                },
                                success: function (res) {
                                    //alert('success');
                                    if (res.length != 0)
                                    {

                                        //var latlngArr = [];
                                        var markerClusters = new L.MarkerClusterGroup({ disableClusteringAtZoom: 17 });
                                        for (i = 0; i < res.length; i++)
                                        {
                                            var data = res[i];
                                            var custom_icon = "";
                                            switch (data.type) {
                                                case "Online":
                                                    custom_icon = "green";
                                                    break;
                                                case "Offline":
                                                    custom_icon = "red";
                                                    break;
                                                case "Busy":
                                                    custom_icon = "grey";
                                                    break;
                                            }
                                            custom_icon = "http://maps.google.com/mapfiles/ms/icons/" + custom_icon + ".png";
                                            var useIcon = L.icon({
                                                iconUrl: custom_icon,
                                                //shadowUrl: 'leaf-shadow.png',

                                                iconSize:     [24, 24], // size of the icon
                                                shadowSize:   [50, 64], // size of the shadow
                                                iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                                                shadowAnchor: [4, 62],  // the same for the shadow
                                                popupAnchor:  [-10, -96] // point from which the popup should open relative to the iconAnchor
                                            });
                                            //latlngArr.push([data.lat,data.lng]);
                                            //marker = new L.marker([data.lat,data.lng],{icon: useIcon}).bindPopup(data.description).addTo(map);
                                            var marker = new L.marker(new L.LatLng(data.lat,data.lng),{icon: useIcon});
                                            marker.bindPopup(data.description);
                                            markerClusters.addLayer( marker );
                                            //bounds.extend(marker.getLatLng());
                                            markersToRemove.push(marker);
                                        }
                                        map.addLayer( markerClusters );
                                        //var Points = [latlngArr];
                                        //var bounds = new L.LatLngBounds(Points);
                                        //map.fitBounds(bounds, {padding: [50, 50]});

                                    } else {
                                        //marker.setVisible(false);
                                        //map.setCenter(map.getCenter());
                                        //map.setZoom(13);  // Why 17? Because it looks good.
                                        alert('Currently there is no driver available for this location');
                                    }
                                },
                                complete: function () {
                                    // Hide loading DIV
                                    //$('#loader-div').css('display', 'none');
                                },
                                error: function (e) {
                                    //marker.setVisible(false);
                                    alert('Something went wrong! Please try again.');
                                }
                            });
                        });
                        function removeMarkers() {
                            for(var i = 0; i < markersToRemove.length; i++) {
                                //markersToRemove[i].setMap(null);
                                map.removeLayer(markersToRemove[i]);
                            }
                        }

                        $('#leaflet-control-geosearch-qry').keypress(function(event) {
                            if (event.keyCode == 13) {
                                event.preventDefault();
                            }
                        });
                      </script>
                </div>
                <footer id="footer-bar" class="row">
                    <p id="footer-copyright" class="col-xs-12">
                        <?php echo $footer; ?>
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

    function openModal()
    {
        $('#myModal').modal('show');
    }
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
