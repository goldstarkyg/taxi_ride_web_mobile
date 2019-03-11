<?php
require('../include/connect.php');
	if(isset($_POST['cab_id']))
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL => BASEPATH.'/api/get_cartype.php',
			CURLOPT_USERAGENT => 'cURL Request',
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => array(
					"cab_id" => $_POST['cab_id']
				)
			));
		$resp = curl_exec($curl);
		curl_close($curl);
		$data=json_decode($resp,true);
		if($data['success'])
		{
			echo '<div class="row">';
      			echo '<div class="col-lg-3 text-center">';
       				echo '<br />';
      	 				echo '<img src="http://192.169.145.50/cms/car_image/'.$data["data"]["icon"][0]["icon"].'" alt="" style="width:100%;">';
      			echo '</div>';
      			echo '<div class="col-lg-9">';
		       		echo '<div class="clearfix car-detail-row">';
		        		echo '<div class="lbl-text pull-left"><b>Car Name :</b></div>';
		        		echo '<div class="value-text pull-right">'.$data["data"]["cartype"][0]["cartype"].'</div>';
		      	 	echo '</div>';
                    echo '<div class="clearfix car-detail-row">';
                    echo '<div class="lbl-text pull-left"><b>Seat Capacity :</b></div>';
                    echo '<div class="value-text pull-right">'.$data["data"]["seat_capacity"][0]["seat_capacity"].'</div>';
                    echo '</div>';
                    echo '<div class="clearfix car-detail-row">';
                    echo '<div class="lbl-text pull-left"><b>Minimum KM :</b></div>';
                    echo '<div class="value-text pull-right">'.$data["data"]["intialkm"][0]["intialkm"].'</div>';
                    echo '</div>';
		       		echo '<div class="clearfix car-detail-row">';
		        		echo '<div class="lbl-text pull-left"><b>Day Rate :</b></div>';
		        		echo '<div class="value-text pull-right">'.$data["data"]["car_rate"][0]["car_rate"].'/KM</div>';
		       		echo '</div>';
                    echo '<div class="clearfix car-detail-row">';
                    echo '<div class="lbl-text pull-left"><b>Night Rate :</b></div>';
                    echo '<div class="value-text pull-right">'.$data["data"]["night_intailrate"][0]["night_intailrate"].'/KM</div>';
                    echo '</div>';
		      	 	echo '<div class="clearfix car-detail-row">';
		        		echo '<div class="lbl-text pull-left"><b>Extra KM Day Rate :</b></div>';
		       	 		echo '<div class="value-text pull-right">'.$data["data"]["fromintailrate"][0]["fromintailrate"].'/KM</div>';
		       		echo '</div>';

		       		echo '<div class="clearfix car-detail-row">';
		       			echo '<div class="lbl-text pull-left"><b>Extra KM Night Rate :</b></div>';
		        		echo '<div class="value-text pull-right">'.$data["data"]["night_fromintailrate"][0]["night_fromintailrate"].'/KM</div>';
		       		echo '</div>';
     			echo '</div>';
     		echo '</div>';
     	}
     	else
     	{
     		echo "Record Not Fetch";
     	}
	}
	else
	{
		echo "Not Post Data";
	}
?>