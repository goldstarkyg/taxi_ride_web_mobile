<?php
error_reporting(0);
ob_start();
@session_start();
/*header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');*/
include("config.inc.php");
include("db_function.php");
include("function.php");
include("message.php");
include("class_connect.php");
include_once('imageTransform.php');
//................Paging file..............
include("newpaging.php");
$prs_pageing = new get_pageing_new();

include("newpaging_front.php");
$prs_pageing1 = new get_pageing_new1();

include("cmspaging.php");
$cms_pageing = new get_pageing_cms();

include("ajaxpaging.php");
$ajax_pageing = new get_pageing_ajax();

?>