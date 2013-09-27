<?php 
error_reporting(E_ALL);
$site_path = realpath(dirname(__FILE__));

define ('__SITE_PATH', $site_path);
include ($site_path.'/includes/init.php');

$registry->router = new router($registry);

$registry->router->setPath (__SITE_PATH . '/controller');
$registry->view = new view($registry);
$registry->router->loader();
