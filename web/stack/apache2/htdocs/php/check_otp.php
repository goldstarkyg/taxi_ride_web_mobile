<?php
/*header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');*/
	if(isset($_POST))
	{
		// otp verification process
		$curl = curl_init();
			$request_headers = array();
			$request_headers[] = 'X-Authy-API-Key:O0dZS9ouqNVVCMS14x35MZic5vK2ldCv';
			curl_setopt($curl, CURLOPT_HTTPHEADER, $request_headers);
			curl_setopt_array($curl, array(
			    CURLOPT_RETURNTRANSFER => 1,
			    CURLOPT_URL => 'https://api.authy.com/protected/json/phones/verification/check?verification_code='.$_POST['otp'].'&country_code='.$_POST['countrycode'].'&phone_number='.$_POST['mobileno']
			));
			$resp = curl_exec($curl);
			curl_close($curl);
			$data=json_decode($resp,true);
			if($data['success']==true)
			{
				echo '{"message":"OTP Verification Successfully","success":' . json_encode('true') . '}';
			}
			else
			{ 
				echo '{"message":"Something went wrong!","success":' . json_encode('false') . '}';
			}
	}
	else
	{
		echo '{"message":"OTP Verification Not Successfully","success":' . json_encode('false') . '}';
	}
?>