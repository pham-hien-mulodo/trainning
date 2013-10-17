<?php 
/*
// implement: giữ interface cho validate. chưa tách view, chưa tạo class abstract validate cho employee và salary
$uri = '';
$files = '';
$controller = '';
$action = '';
$param = array();

require_once("application/dispatch.php");
 error_reporting(E_ALL);
 $site_path = realpath(dirname(__FILE__));
// echo $site_path;
 define ('__SITE_PATH', $site_path);
// echo __SITE_PATH;
 include 'includes/init.php';
 $result = new dispatch();
// $result->getController($site_path);
$result->load();
*/
define ('__SITE_PATH','/Library/WebServer/Documents/rundemo/');
require_once(__SITE_PATH."application/dispatch.php");
$dispatcher = new Dispatch();
$dispatcher->load();