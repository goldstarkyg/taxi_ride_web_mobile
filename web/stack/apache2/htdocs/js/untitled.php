////insert booking
					$curl = curl_init();
					curl_setopt_array($curl, array(
					    CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_URL => '192.168.1.45/okswissweb/api/add_booking.php',
					    CURLOPT_USERAGENT => 'cURL Request',
				   		CURLOPT_POST => 1,
				    	CURLOPT_POSTFIELDS => array(
				        	"username" => $_POST['username'],
				        	"user_id" => $_POST['user_id'],
				        	"pickup_area" => $_POST['search_from'],
				        	"drop_area" => $_POST['search_to'],
				        	"pickup_date_time" => $date_book,
				        	"taxi_type" => $_POST['booking_cartype'],
				        	"taxi_id" => $_POST['cartype_value'],
				        	"km" => $km,
				        	"book_create_date_time" => $date,
				        	"approx_time" => $atime,
				        	"amount" => $final_amount * $_POST['booking_pessenger'],
				        	"person" => $_POST['booking_pessenger'],
				        	"timetype" => $timetype,
				        	"pickup_lat" => $from_lat,
				        	"pickup_long" => $from_lng,
				        	"drop_lat" => $to_lat,
				        	"drop_long" => $to_lng
				    	)
					));
					$resp = curl_exec($curl);
					curl_close($curl);
					$data=json_decode($resp,true);
					if($data['success'])
					{	
						echo '{"message":"Booking Successfully","success":' . json_encode('true') .',"data":'.json_encode($resp). '}';
					}
					else
					{
						echo '{"message":"Booking Not Successfully","success":' . json_encode('false') .',"data":}';
					}
				//////////////////////////