<?php
/*header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');*/
	if(isset($_POST))
	{
		$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			$request_headers = array();
			$request_headers[] = 'X-Authy-API-Key:O0dZS9ouqNVVCMS14x35MZic5vK2ldCv';
			curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => 'https://api.authy.com/protected/json/phones/verification/start',
			    CURLOPT_USERAGENT => 'cURL Request',
			    CURLOPT_POST => 1,
			    CURLOPT_POSTFIELDS => array(
			        "via" => 'sms',
			        "country_code" => $_POST['countrycode'],
			        "phone_number" => $_POST['mobileno'],
			        "locale" => 'en',
			    )
			));
			// Send the request & save response to $resp
			$resp = curl_exec($curl);
			// Close request to clear up some resources
			curl_close($curl);
			$data=json_decode($resp,true);
			if($data['success'])
			{
				echo '{"message":"Send OTP Successfully","success":' . json_encode('true') . '}';
			}
			else
			{
				echo '{"message":"Send OTP Not Successfully","error":' . json_encode('false') . '}';
			}
	}
	else
	{
		echo '{"message":"Send OTP Not Successfully","error":' . json_encode('false') . '}';
	}
?>