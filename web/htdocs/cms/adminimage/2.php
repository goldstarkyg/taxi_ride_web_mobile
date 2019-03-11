<?php

	$dir    = '/var/www/html/';   // paste path from 1.php 
	
		$files2 = scandir($dir, 1);
			
			echo "<pre>";
				print_r($files2);
			echo "</pre>";

?>