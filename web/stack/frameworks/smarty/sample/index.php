<?php
// NOTE: Smarty has a capital 'S'
require_once('Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

$smarty->assign('name', 'Bitnami');
$smarty->display('index.tpl');
$smarty->testInstall();

?>
		    