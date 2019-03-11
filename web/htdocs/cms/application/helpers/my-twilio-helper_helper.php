<?php

if (!class_exists('Services_Twilio')) {
	/**
	 * The main Twilio.php file contains an autoload method for its dependent
	 * classes, we only need to include the one file manually.
	 */
	include_once(APPPATH.'libraries/Twilio/Twilio.php');
}

/**
 * Return a twilio services object.
 *
 * Since we don't want to create multiple connection objects we
 * will return the same object during a single page load
 *
 * @return object Services_Twilio
 */
function get_twilio_service() {
	static $twilio_service;

	if (!($twilio_service instanceof Services_Twilio)) {
		/**
		 * This assumes that you've defined your SID & TOKEN as constants
		 * Replace with a way to get your SID & TOKEN if different
		 */
		$twilio_service = new Services_Twilio("AC8037f65f93f590ece3a2ac0f0e2a4af7", "76a71d66375cf3aff94f6eb8d714b190");
	}

	return $twilio_service;
}

?>