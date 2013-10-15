<?php 
// thay đổi interface bằng abstract class validate, B2: thêm abstract view và implement : salaryView và employeeView
session_start();
$uri = '';
$files = '';
$controller = '';
$action = '';
$param = array();

require_once("application/dispatch.php");
 error_reporting(E_ALL);
 $site_path = realpath(dirname(__FILE__));
 define ('__SITE_PATH', $site_path);
 include 'includes/init.php';
 $result = new dispatch();
// $result->getController($site_path);
$result->loader($site_path);
//$result->analyzURI();