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
			// Push Message Title
			$push_message_title = 'Top Ridez';
			// New Booking Request Driver Side Push Message
			$new_booking_request_push = "Booking ID:%s New Booking Request Arrived.";
			// Driver Unavailable User Side Push Message
			$driver_unavailable_push = "Oops! Booking ID %s is cancelled as all our drivers are busy handling other client’s. We regret for inconvenience caused.";
			// Driver Accepted Booking User Side Push Message
			$driver_accept_push="Your Booking ID : %s is been assigned to Driver Mr. %s and is been reaching to your location soon.";
			// Driver Reached Pickup Point User Side Push Message
			$driver_arrived_push = "Mr. %s has reached pickup point.";
			// Driver On Trip User Side Push Message
			$driver_on_trip_push = "Welcome Abroad. Your Trip with booking id %s has began. We wish you safe journey.";
			// Trip Completed User Side Push Message
			$driver_completed_push = "Your Booking ID: %s has been completed with Mr. %s. We hope to serve your soon in the future.";
			// Payment Done Via Cash Driver Side Push Message
			$cash_payment_push = "User has opted to Pay %s %s via Cash , We request you to collect the same.";
			// Payment Done User Side Push Message
			$payment_completed_user_push = "Congratulations !!. Your payment of  %s %s  is received . We  hope to serve you in future.";
			// Payment Done via POS Driver Side Push Message
			$payment_completed_driver_push = "Congratulations !!. Your booking is completed and We acknowledge the  payment receipt of %s %s via POS.";
			// Payment Done Via Card Driver Push Message
			$payment_via_card_driver_push = "Congratulations !!. Your booking is completed and We acknowledge the  payment receipt of %s %s via CARD.";
			// Account Verification Push Message
			$account_verification_push = "HOWDY !! your account is been verified successfully. You can now login to our app";
			// Send Invite Message
			$send_invite_sms = 'Download our free app and join Top Ridez. iTunes - https://tinyurl.com/h72tv3m Playstore - https://tinyurl.com/jxfnbwb';
			$payment_failed_user_push = "Your transaction has been cancelled as there is an error in card.";
			$payment_failed_driver_push = "Current transaction has been cancelled by user as there is a problem with the card.";
		}
