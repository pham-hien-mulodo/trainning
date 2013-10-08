<?php 
/*
error_reporting(E_ALL);
$site_path = realpath(dirname(__FILE__));

define ('__SITE_PATH', $site_path);
include ($site_path.'/includes/init.php');

$registry->router = new router($registry);

$registry->router->setPath (__SITE_PATH . '/controller');
$registry->view = new baseView($registry);
$registry->router->loader();
*/
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
 $result->getController($site_path);
$result->loader($site_path);