<?php
include_once('../include/connect.php');
$okswissweb=new okswissweb;
$okswissweb_data=$okswissweb->webuser_chkmobile($_POST);
echo $okswissweb_data;

