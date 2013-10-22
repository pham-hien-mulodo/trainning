<?php 
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
$result->load();