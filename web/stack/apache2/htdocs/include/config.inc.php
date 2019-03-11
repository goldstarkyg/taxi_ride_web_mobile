<?php
	//...........Local Settings.................	this is superfreeapps cms and web services
	define ("DB_HOST","localhost");
	define ("DB_USER","root");
	define ("DB_PASS","root"); //Onetoeight30@
	define ("DB_NAME","taxiapp");

	define ("BASEPATH","http://132.148.66.112");
	//..........database connection............
	mysql_connect (DB_HOST,DB_USER,DB_PASS) or die ("Couldn't connect with database!");
	mysql_select_db(DB_NAME) or die ("Database not found!");

	//...........define site name & important variables.............

	//...............set server level settings.....................
	date_default_timezone_set('UTC');
	ini_set('memory_limit', '40M');
	ini_set('post_max_size', '40M');
    ini_set('upload_max_filesize', '40M');
	$today=$date=date("Y-m-d");
	$datetime=date("Y-m-d H:i:s");

?>
