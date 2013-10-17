<?php

include (__SITE_PATH . '/application/'. 'Controller_base.class.php');
include (__SITE_PATH . '/application/' . 'aModel.php');
include (__SITE_PATH . '/application/' . 'View_base.class.php');
//include (__SITE_PATH . '/application/' . 'registry.php');
//include (__SITE_PATH . '/application/' . 'router.php');

function __autoload($class_name)
{
	$filename = strtolower($class_name) . '.class.php';
	$file = __SITE_PATH . '/model/' . $filename;
	if(file_exists($file) == false)
	{
		return false;
	}
	include ($file);
}

//$registry = new registry();
