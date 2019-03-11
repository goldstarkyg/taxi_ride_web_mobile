<?php
require('../include/connect.php');
	error_reporting(0);
	session_start();
	if(isset($_SESSION) && $_POST['mobileno']!="")
	{
		////get user_id&username and creater user
			$id;
			$username;
			$mobileno=substr($_POST['countrycode'],1,strlen($_POST['countrycode']));
			$mobileno.=' '.$_POST['mobileno'];
			$password=myRand(6);

			$_SESSION["name"]=$_POST["name"];
			$_SESSION["email"]=$_POST["email"];
			$_SESSION["password"]=$password;

			$curl = curl_init();
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => BASEPATH.'/api/webuser_chkmobile.php',
			    CURLOPT_USERAGENT => 'cURL Request',
		   		CURLOPT_POST => 1,
		    	CURLOPT_POSTFIELDS => array(
		        "mobile" => $mobileno
		    	)
			));
			$resp = curl_exec($curl);
			curl_close($curl);
			$data=json_decode($resp,true);
			if($data['success']=="true")
			{
				$id=$data['id'];$username=$data['username'];
			}
			else
			{ 
				$curl = curl_init();
				curl_setopt_array($curl, array(
				    CURLOPT_RETURNTRANSFER => 1,
				    CURLOPT_URL => BASEPATH.'/api/add_userdetails.php',
				    CURLOPT_USERAGENT => 'cURL Request',
			   		CURLOPT_POST => 1,
			    	CURLOPT_POSTFIELDS => array(
			    		"user_status" => "Active",
			        	"username" => "webuser",
			        	"email" => $_SESSION["email"],
			        	"mobile" => $mobileno,
			        	"password" => md5($password),
			        	"isdevice" => "0",
			        	"gender" => "",
			        	"dob" => "",
			        	"facebook_id" => "",
			        	"twitter_id" => "",
			        	"name" => $_SESSION["name"]
			    	)
				));
				$resp = curl_exec($curl);
				curl_close($curl);
				$data=json_decode($resp,true);
				if($data['success'])
				{	
						$curl = curl_init();
						curl_setopt_array($curl, array(
						    CURLOPT_RETURNTRANSFER => 1,
						    CURLOPT_URL => BASEPATH.'/api/webuser_chkmobile.php',
						    CURLOPT_USERAGENT => 'cURL Request',
					   		CURLOPT_POST => 1,
					    	CURLOPT_POSTFIELDS => array(
					        "mobile"=> $mobileno
					    	)
						));
						$resp = curl_exec($curl);
						curl_close($curl);
						$data=json_decode($resp,true);
						if($data['success'])
						{
							$id=$data['id'];$username=$data['username'];
						}
						else
						{
							echo '{"message":"Not Success","success":' . json_encode('false') . '}';
							exit;
						}
				}
			}
		//////////////////////////////////////////
		////insert booking
			if($id!="" && $username!="")
			{
				$date=date("Y-m-d H:i:s");
				$curl = curl_init();
				curl_setopt_array($curl, array(
				    CURLOPT_RETURNTRANSFER => 1,
				    CURLOPT_URL => BASEPATH.'/api/add_booking.php',
				    CURLOPT_USERAGENT => 'cURL Request',
			   		CURLOPT_POST => 1,
			    	CURLOPT_POSTFIELDS => array(
			        	"username" => $username,
			        	"user_id" => $id,
			        	"pickup_area" => $_SESSION['search_from'],
			        	"drop_area" => $_SESSION['search_to'],
			        	"pickup_date_time" => $_SESSION['date_book'].' '.$_SESSION['time_book'],
			        	"taxi_type" => $_SESSION['booking_cartype'],
			        	"taxi_id" => $_SESSION['cartype_value'],
			        	"km" => $_SESSION['km'],
			        	"book_create_date_time" => $date,
			        	"approx_time" => $_SESSION['atime'],
			        	"amount" => $_SESSION['amount'],
			        	"person" => $_SESSION['booking_pessenger'],
                        "adult_13plus" => $_POST["passenger_no1"],
                        "child_13less" => $_POST["passenger_no2"],
                        "child_7less" => $_POST["passenger_no3"],
                        "infant_1less" => $_POST["passenger_no4"],
			        	"timetype" => $_SESSION['timetype'],
			        	"pickup_lat" => $_SESSION['from_lat'],
			        	"pickup_long" => $_SESSION['from_lng'],
			        	"drop_lat" => $_SESSION['to_lat'],
			        	"drop_long" => $_SESSION['to_lng'],
			        	"purpose" => "Point to Point Transfer",
			        	"isdevice" => "0",
			        	"status" => "1",
			    	)
				));
				$resp = curl_exec($curl);
				curl_close($curl);
				$data=json_decode($resp,true);
				if($data['success'])
				{	
					//////send confirmation//////////
						$curl1 = curl_init();
						curl_setopt_array($curl1, array(
					    CURLOPT_RETURNTRANSFER => 1,
					    CURLOPT_URL =>BASEPATH.'/php/confirmation_mail.php',
					    CURLOPT_USERAGENT => 'cURL Request',
				   		CURLOPT_POST => 1,
				    	CURLOPT_POSTFIELDS => array(
				    	"name" => $_POST['name'],	
				    	"email" => $_POST['email'],
				    	"password" => $_SESSION["password"],	
			        	"username" => $username,
			        	"user_id" => $id,
			        	"pickup_area" => $_SESSION['search_from'],
			        	"drop_area" => $_SESSION['search_to'],
			        	"pickup_date_time" => $_SESSION['date_book'],
			        	"taxi_type" => $_SESSION['booking_cartype'],
			        	"taxi_id" => $_SESSION['cartype_value'],
			        	"km" => $_SESSION['km'],
			        	"book_create_date_time" => $date,
			        	"approx_time" => $_SESSION['atime'],
			        	"amount" => $_SESSION['amount'],
			        	"person" => $_SESSION['booking_pessenger'],
                        "adult_13plus" => $_POST["passenger_no1"],
                        "child_13less" => $_POST["passenger_no2"],
                        "child_7less" => $_POST["passenger_no3"],
                        "infant_1less" => $_POST["passenger_no4"],
			        	"timetype" => $_SESSION['timetype'],
			        	"pickup_lat" => $_SESSION['from_lat'],
			        	"pickup_long" => $_SESSION['from_lng'],
			        	"drop_lat" => $_SESSION['to_lat'],
			        	"drop_long" => $_SESSION['to_lng'],
			        	"purpose" => "Point to Point Transfer",
			        	"isdevice" => "0",
			        	"status" => "1",
			    		)
						));
						$resp1 = curl_exec($curl1);
						curl_close($curl1);
						$data1=json_decode($resp1,true);
						if($data1['success']=="true")
						{
							echo '{"message":"Booking Successfully","success":' . json_encode('true') .',"data":'.json_encode($resp). '}';
						}
						else
						{
							echo '{"message":"Booking Not Successfully","success":' . json_encode('false') .'}';
						}
					/////////////////////////////////
				}
				else
				{
					echo '{"message":"Booking Not Successfully","success":' . json_encode('false') .'}';
				}
			}
	}
	else
	{

		echo '{"message":"Booking Not Successfully","success":' . json_encode('false') .'}';
	}


	function myRand($no) 
	{

    	$length=$no;
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        $digits_needed=2;
        $random_number='';
        $count=0;
        while ( $count < $digits_needed ) {
            $random_digit = mt_rand(0, 9);

            $random_number .= $random_digit;
            $count++;
        }
        $newPassword=$random_number.$string;
	    $password=$newPassword;
	    return $password;
	}
?>