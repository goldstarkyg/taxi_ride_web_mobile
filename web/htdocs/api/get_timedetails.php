<?php
include_once('../include/connect.php');
$okswissweb=new okswissweb;
$okswissweb_data=$okswissweb->get_timedetails($_POST);
echo $okswissweb_data;

