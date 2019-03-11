<?php
require('../include/connect.php');
	error_reporting(0);
	if(!empty(session_id()))
	{
		session_destroy();
		session_start();
	}
	else
	{
		session_start();
	}
	if(isset($_POST))
	{
				////find from lat and lang
				$from_lat;
				$from_lng;
				$curl = curl_init();
				curl_setopt_array($curl, array(
				    CURLOPT_RETURNTRANSFER => 1,
				    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(" ", "+", $_POST['search_from']).'&key=AIzaSyCeDVAgl10YylCiyTiML7WCYeiGX-yJ-wM'));
				$resp = curl_exec($curl);
				curl_close($curl);
				$data=json_decode($resp,true);
				if($data['status']=="OK")
				{
					$from_lat=$data["results"][0]["geometry"]["location"]["lat"];
					$from_lng=$data["results"][0]["geometry"]["location"]["lng"];
				}
				else
				{ 	
					exit;
				}
				////find to lat and lang
					$to_lat;
					$to_lng;
				  	$curl = curl_init();
					curl_setopt_array($curl, array(
					    CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/json?address='.str_replace(" ", "+", $_POST['search_to']).'&key=AIzaSyCeDVAgl10YylCiyTiML7WCYeiGX-yJ-wM'));
					$resp = curl_exec($curl);
					curl_close($curl);
					$data=json_decode($resp,true);
					if($data['status']=="OK")
					{
						$to_lat=$data["results"][0]["geometry"]["location"]["lat"];
						$to_lng=$data["results"][0]["geometry"]["location"]["lng"];
					}
					else
					{ 
						exit;
					}
				//////////////////////////
				////find km and time	
					$km;
					$atime;
					$curl = curl_init();
					curl_setopt_array($curl, array(
					    CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/distancematrix/json?origins='.str_replace(" ", "+", $_POST['search_from']).'&destinations='.str_replace(" ", "+", $_POST['search_to']).'&key=AIzaSyCeDVAgl10YylCiyTiML7WCYeiGX-yJ-wM'));
					$resp = curl_exec($curl);
					curl_close($curl);
					$data=json_decode($resp,true);
					if($data['status']=="OK")
					{
						$km=$data["rows"][0]["elements"][0]["distance"]["text"];
						$atime=$data["rows"][0]["elements"][0]["duration"]["text"];
					}
					else
					{ 
						exit;
					}
				//////////////////////////	
				////find day or night
					$tmp=explode(" ",$_POST['booking_datetime']);
					$tmp=explode(":", $tmp[1]);
					$tmp_h=$tmp[0];
					$tmp_m=$tmp[1];
					$timetype;
					$curl = curl_init();
					curl_setopt_array($curl, array(
					    CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_URL => BASEPATH.'/api/get_timedetails.php',
					    CURLOPT_USERAGENT => 'cURL Request',
				   		CURLOPT_POST => 1,
				    	CURLOPT_POSTFIELDS => array()
					));
					$resp = curl_exec($curl);
					curl_close($curl);
					$data=json_decode($resp,true);
					if($data['success'])
					{
						$start=explode(":",$data['day_start_time']);
						$end=explode(":",$data['day_end_time']);
						if($start[0] <= $tmp_h && $tmp_h < $end[0])
						{
							$timetype="day";
						}
						else
						{
							$timetype="night";
						}
					}
				//////////////////////////
	/*
		 data:{countrycode:countrycode,mobileno:mobileno,otp:otp,search_from:search_from,search_to:search_to,booking_datetime:booking_datetime,booking_pessenger:booking_pessenger,booking_cartype:booking_cartype,cartype_value:cartype_value,user_id:user_id,username:username},
	*/
		 		//// prepare variable
		 		$final_amount;
		 		$curl = curl_init();
				curl_setopt_array($curl, array(
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_URL => BASEPATH.'/api/get_cartype.php',
					CURLOPT_USERAGENT => 'cURL Request',
					CURLOPT_POST => 1,
					CURLOPT_POSTFIELDS => array("cab_id"=>$_POST['cartype_value'])
				));
				$resp = curl_exec($curl);
				curl_close($curl);
				$data=json_decode($resp,true);
		        $km=round($km,0);
				if($timetype=="day")
				{
					if($data["data"]["intialkm"][0]['intialkm'] >= $km)
					{
						$final_amount=$km * $data["data"]["carrate"][0]['carrate'];	
					}
					else
					{
						$tmp_km=$km-$data["data"]["intialkm"][0]['intialkm'];
						$final_amount=$data["data"]["intialkm"][0]['intialkm']*$data["data"]["car_rate"][0]['car_rate'];
						$final_amount+=$tmp_km * $data["data"]["fromintailrate"][0]['fromintailrate'];
					}
				}
				else
				{
					if($data["data"]["intialkm"][0]['intialkm'] >= $km)
					{
						$final_amount=$km * $data["data"]["night_intailrate"][0]['night_intailrate'];	
					}
					else
					{
						$tmp_km=$km-$data["data"]["intialkm"][0]['intialkm'];
						$final_amount=$data["data"]["intialkm"][0]['intialkm']*$data["data"]["night_intailrate"][0]['night_intailrate'];
						$final_amount+=$tmp_km * $data["data"]["night_fromintailrate"][0]['night_fromintailrate'];
					}
					
				}
			if($from_lat!="" && $to_lat!="")
		 	{
		 		/////////////////////////
		 		$tmp=explode(" ",$_POST['booking_datetime']);
				$tmp_time = strtotime($tmp[0]." ".$tmp[1]);
				$date_book = date('Y-m-d',$tmp_time);
				$time_book = date('H:i:s',$tmp_time);
		 		$date=date("Y-m-d H:i:s");
		 		////storing session data
		 			$_SESSION['car_image'] = $data["data"]["icon"][0]['icon'];
		 			$_SESSION['search_from']=$_POST['search_from'];
		 			$_SESSION['search_to']=$_POST['search_to'];
		 			$_SESSION['date_book']=$date_book;
		 			$_SESSION['time_book']=$time_book;
		 			$_SESSION['booking_cartype']=$_POST['booking_cartype'];
		 			$_SESSION['cartype_value']=$_POST['cartype_value'];
		 			$_SESSION['km']=$km;
		 			$_SESSION['date']=$date;
		 			$_SESSION['atime']=$atime;
		 			$_SESSION['amount']=$final_amount * $_POST['booking_pessenger'];
		 			$_SESSION['booking_pessenger']=$_POST['booking_pessenger'];
		 			$_SESSION['timetype']=$timetype;
		 			$_SESSION['from_lat']= $from_lat;
		 			$_SESSION['from_lng']= $from_lng;
		 			$_SESSION['to_lat']=$to_lat;
		 			$_SESSION['to_lng']=$to_lng;
		 			////display book detail start
					echo '<div class="text-center">';
						echo '<img src="images/car.gif" width="270px">';
					echo '</div>';
					echo '<br />';
					echo '<div class="row">';
						echo '<div class="col-lg-6">';
							echo '<label><i class="glyphicon glyphicon-map-marker"></i> &nbsp;&nbsp;Pickup Location</label>';
							echo '<p class="location">'.$_SESSION['search_from'].'</p>';
						echo '</div>';
						echo '<div class="col-lg-6">';
							echo '<label><i class="glyphicon glyphicon-map-marker"></i> &nbsp;&nbsp;Drop Location</label>';
							echo '<p class="location">'.$_SESSION['search_to'].'</p>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row">';
						echo '<div class="col-lg-4">';
							echo '<label><i class="glyphicon glyphicon-calendar"></i> &nbsp;&nbsp;Booking Date</label>';
							echo '<p class="location">'.$_SESSION['date_book'].'</p>';
						echo '</div>';
						echo '<div class="col-lg-4">';
							echo '<label><i class="glyphicon glyphicon-time"></i> &nbsp;&nbsp;Booking Time</label>';
							echo '<p class="location">'.$_SESSION['time_book'].'</p>';
						echo '</div>';
						echo '<div class="col-lg-4">';
							echo '<label><i class="fa fa-cloud"></i> &nbsp;&nbsp;Day/Night</label>';
							echo '<p class="location">'.$_SESSION['timetype'].'</p>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row">';
						echo '<div class="col-lg-4">';
							echo '<label><i class="glyphicon glyphicon-time"></i> &nbsp;&nbsp;Approx Time</label>';
							echo '<p class="location">'.$_SESSION['atime'].'</p>';
						echo '</div>';
						echo '<div class="col-lg-4">';
							echo '<label><i class="glyphicon glyphicon-road"></i> &nbsp;&nbsp;Distance</label>';
							echo '<p class="location">'.$_SESSION['km'].' KM</p>';
						echo '</div>';
						echo '<div class="col-lg-4">';
							echo '<label><i class="fa fa-group"></i> &nbsp;&nbsp;Person</label>';
							echo '<p class="location">'.$_SESSION['booking_pessenger'].'</p>';
						echo '</div>';
					echo '</div>';
		 			//////////////////////////////	
		    }
	}
?>