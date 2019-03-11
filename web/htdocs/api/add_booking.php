<?php
include_once('../include/connect.php');
$okswissweb=new okswissweb;
$okswissweb_data=$okswissweb->add_booking($_POST);
echo $okswissweb_data;

