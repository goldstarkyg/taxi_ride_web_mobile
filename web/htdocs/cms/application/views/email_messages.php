<?php
// DON'T REMOVE %s from below strings.
$table_language = 'settings';
$select_data_language = "*";
$this->db->select($select_data_language);
		$query_language = $this->db->get($table_language);
		$result_language = $query_language->result_array();
		$language=$result_language[0]['languagetr'];
		if($language == 1)
		{
			$send_mail_id = "ocrides949@gmail.com";
			$send_mail_password = "B[6Gyq';Ycy";
			$send_mail_name = "Top Ridez";
			$booking_id_str = "Booking ID";
			$driver_unavailable_str = "Driver Unavailable History.";
			$pickup_location_str = "Pickup Location";
			$drop_location_str = "Drop Location";
			$pickup_time_str = "Pickup Time";
			$driver_assigned_str = "Driver Assigned";
			$driver_id_str = "Driver ID";
			$assigned_time_str = "Assigned Time";
			$cancelled_time_str = "Cancelled Time";
			$driver_user_name_str = "Driver Username";
			$driver_name_str = "Driver Name";
			$mobile_no_str = "Mobile No";
			$phone_str = "Phone";
			$email_str = "Email";
			$license_no_str = "License No";
			$car_type_str = "Car Type";
			$car_no_str = "Car No";
			$car_model_str = "Car Model";
			$car_make_str = "Car Make";
			$loading_capacity_str = "Loading Capacity";
			$status_str = "Status";
			$is_flagged_str = "Is Flagged";
			$not_driver_assigned_str = "Not any driver assigned.";
			$new_flagged_driver_id_str = "New Flagged Driver ID";
			$driver_details_str = "Driver Details";
			$name_str = "Name";
			$last_five_booking_details_str = "Last 5 Booking Details";
			$user_name_str = "Username";
			$user_id_str = "User ID";
			$booking_time_str = "Booking Time";
			$new_flagged_user_id_str = "New Flagged User ID";
			$details_str = "Details";
			$user_details_str = "User Details";
			$last_two_booking_details_str = "Last 2 Booking Details";
			$hello_str = "Hello";
			$your_email_id_str = "Your Email ID";
			$and_str = "and";
			$your_password_str = "Your Password";
			$for_okayswiss_str = "for OC-Rides are as below.";
			$password_str = "Password";
			$contact_str = "If you have any questions please contact";
			$thanks_str = "Thanks";
			$new_driver_register_str = "OC-Rides New Driver Register";
			$gender_str = "Gender";
			$dob_str = "Date Of Birth";
			$address_str = "Address";
			$license_expiry_str = "License Expiry Date";
			$license_plate_str = "License Plate";
			$insurance_str = "Insurance";
			$new_user_register_str = "Top Ridez New User Registration.";
			$forget_password_str = "Top Ridez Forget Password Request.";
			$password_reset_str = "Your reset password request for Top Ridez is successful. Please login to your Top Ridez account with your new password.";
			$account_activate_str = "Your account has been activated";
			$account_verification_str = "HOWDY !! your account is been verified successfully You can now login to our app using below details.";
			$okay_team_str = "Top Ridez Team";
			$cashout_str = "New Cashout Request Arrived. Details are given below";
			$generated_time = "Generated Time";
			
		}
?>