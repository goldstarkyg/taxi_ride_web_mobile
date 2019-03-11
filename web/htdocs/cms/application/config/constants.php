<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/

define("APP_SECRET_KEY", "app_secret_key");
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

define('CUSTOM_ZONE_NAME','America/Los_Angeles');

//setting accuarate background service https://developer.accuratebackground.com/#/login
define('ACCURATE_USERNAME',  'd719b7c9-aee0-4d00-9db6-d8edb53bc1be');
define('ACCURATE_PASS', 'a3103548-0d3c-40e9-b1b9-5c7a32eb906a');

// define('BASE_URL','http://132.148.66.112/cms/');
define('BASE_URL','http://localhost/cms/');
define('ROOT_PATH', realpath(__DIR__ . '/../../..'));
// define('BASE_IP','http://132.148.66.112');
define('BASE_IP','http://localhost');

/* End of file constants.php */
/* Location: ./application/config/constants.php */

//staff-option
define('DASHBOARD',                         'dashboard');
define('REAL_TIME_MAPPING','real_time_mapping');
define('DAILY_DRIVER_EARNINGS','daily_driver_earnings');
define('MANAGE_STAFF','manage_staff');

define('MANAGEUSER','manageuser');
define('MANAGEUSER_ALLUSER','manageuser_alluser');
define('MANAGEUSER_ALLUSER_SEEDETAIL','manageuser_alluser_seedetail');
define('MANAGEUSER_ALLUSER_SEEDETAIL_CHANGEPASSWORD','manageuser_alluser_seedetail_changepassowrd');
define('MANAGEUSER_ALLUSER_DELETE','manageuser_alluser_delete');
define('MANAGEUSER_FLAGGEDUSER','manageuser_flaggeduser');

define('MANAGEBOOKING','managebooking');
define('MANAGEBOOKING_ALLBOOKING','managebooking_allbooking');
define('MANAGEBOOKING_ALLBOOKING_EDIT','managebooking_allbooking_edit');
define('MANAGEBOOKING_ALLBOOKING_EDIT_EDITDRIVER','managebooking_allbooking_edit_editdriver');
define('MANAGEBOOKING_ALLBOOKING_DELETE','managebooking_allbooking_delete');

define('MANAGEBOOKING_PENDNINGBOOKING','managebooking_pedingbooking');
define('MANAGEBOOKING_PENDNINGBOOKING_EDIT','managebooking_pedingbooking_edit');
define('MANAGEBOOKING_PENDNINGBOOKING_EDIT_EDITDRIVER','managebooking_pedingbooking_edit_editdriver');
define('MANAGEBOOKING_PENDNINGBOOKING_DELETE','managebooking_pedingbooking_delete');

define('MANAGEBOOKING_USERCANCELBOOKING','managebooking_usercancelbooking');
define('MANAGEBOOKING_USERCANCELBOOKING_EDIT','managebooking_usercancelbooking_edit');
define('MANAGEBOOKING_USERCANCELBOOKING_EDIT_EDITDRIVER','managebooking_usercancelbooking_edit_editdriver');
define('MANAGEBOOKING_USERCANCELBOOKING_DELETE','managebooking_usercancelbooking_delete');

define('MANAGEBOOKING_DRIVERCANCELBOOKING','managebooking_drivercancelbooking');
define('MANAGEBOOKING_DRIVERCANCELBOOKING_EDIT','managebooking_drivercancelbooking_edit');
define('MANAGEBOOKING_DRIVERCANCELBOOKING_EDIT_EDITDRIVER','managebooking_drivercancelbooking_edit_editdriver');
define('MANAGEBOOKING_DRIVERCANCELBOOKING_DELETE','managebooking_drivercancelbooking_delete');

define('MANAGEDRIVER','managedriver');
define('MANAGEDRIVER_ALLDRIVER','managedriver_alldriver');
define('MANAGEDRIVER_ALLDRIVER_STATUS','managedriver_alldriver_status');
define('MANAGEDRIVER_ALLDRIVER_DETAIL','managedriver_alldriver_detail');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL','managedriver_alldriver_detail_general');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_VIEW','managedriver_alldriver_detail_general_view');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_VIEW_SSN','managedriver_alldriver_detail_general_view_ssn');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_GENERAL_EDIT','managedriver_alldriver_detail_general_edit');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS','managedriver_alldriver_detail_changepass');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS_VIEW','managedriver_alldriver_detail_changepass_view');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_CHANGEPASS_EDIT','managedriver_alldriver_detail_changepass_edit');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL','managedriver_alldriver_detail_cardetail');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL_VIEW','managedriver_alldriver_detail_cardetail_view');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_CARDETAIL_EDIT','managedriver_alldriver_detail_cardetail_edit');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION','managedriver_alldriver_detail_inspection');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_CREATE','managedriver_alldriver_detail_inspection_create');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_INSPECTION_EDITAPPOINTMENT','managedriver_alldriver_detail_inspection_editappointment');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL','managedriver_alldriver_detail_bankdetail');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_VIEW','managedriver_alldriver_detail_bankdetail_view');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_BANKDETAIL_EDIT','managedriver_alldriver_detail_bankdetail_edit');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL','managedriver_alldriver_detail_paymentdetail');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL_VIEW','managedriver_alldriver_detail_paymentdetail_view');
define('MANAGEDRIVER_ALLDRIVER_DETAIL_PAYMENTDETAIL_EDIT','managedriver_alldriver_detail_paymentdetail_edit');
define('MANAGEDRIVER_ALLDRIVER_DELETE','managedriver_alldriver_delete');
define('MANAGEDRIVER_FLAGDRIVER','managedriver_flagdriver');
define('MANAGEDRIVER_FLAGDRIVER_STATUS','managedriver_flagdriver_status');
define('MANAGEDRIVER_FLAGDRIVER_DETAIL','managedriver_flagdriver_detail');
define('MANAGEDRIVER_FLAGDRIVER_GENERAL','managedriver_flagdriver_general');
define('MANAGEDRIVER_FLAGDRIVER_GENERAL_VIEW','managedriver_flagdriver_general_view');
define('MANAGEDRIVER_FLAGDRIVER_GENERAL_EDIT','managedriver_flagdriver_general_edit');
define('MANAGEDRIVER_FLAGDRIVER_CHANGEEPASS','managedriver_flagdriver_changepass');
define('MANAGEDRIVER_FLAGDRIVER_CHANGEPASS_VIEW','managedriver_flagdriver_changepass_view');
define('MANAGEDRIVER_FLAGDRIVER_CHANGEPASS_EDIT','managedriver_flagdriver_changepass_edit');
define('MANAGEDRIVER_FLAGDRIVER_CARDETAIL','managedriver_flagdriver_cardetail');
define('MANAGEDRIVER_FLAGDRIVER_CARDETAIL_VIEW','managedriver_flagdriver_cardetail_view');
define('MANAGEDRIVER_FLAGDRIVER_CARDETAIL_EDIT','managedriver_flagdriver_cardetail_edit');
define('MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION','managedriver_flagdriver_detail_inspection');
define('MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_CREATE','managedriver_flagdriver_detail_inspection_create');
define('MANAGEDRIVER_FLAGDRIVER_DETAIL_INSPECTION_EDITAPPOINTMENT','managedriver_flagdriver_detail_inspection_editappointment');
define('MANAGEDRIVER_FLAGDRIVER_BANKDETAIL','managedriver_flagdriver_bankdetail');
define('MANAGEDRIVER_FLAGDRIVER_BANKDETAIL_VIEW','managedriver_flagdriver_bankdetail_view');
define('MANAGEDRIVER_FLAGDRIVER_BANKDETAIL_EDIT','managedriver_flagdriver_bankdetail_edit');
define('MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL','managedriver_flagdriver_paymentdetail');
define('MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL_VIEW','managedriver_flagdriver_paymentdetail_view');
define('MANAGEDRIVER_FLAGDRIVER_PAYMENTDETAIL_EDIT','managedriver_flagdriver_paymentdetail_edit');
define('MANAGEDRIVER_FLAGDRIVER_DELETE','managedriver_flagdriver_delete');

define('MANAGECARTYPE','managecartype');
define('MANAGEDELAYREASON','managedelayreason');
define('SETTINGS','settings');
define('SETTINGS_UPDATESETTING','settings_updatesetting');
define('SETTINGS_FIXPRICEAREA','settings_fixpricearea');
define('SETTINGS_MANAGEDAYTIME','settings_managedaytime');
define('SETTINGS_COMMISIONSETTING','settings_commisionsetting');
define('CASHOUT','cashout');