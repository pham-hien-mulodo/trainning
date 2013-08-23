<?php
require_once('employee_model.php');
$data = array();
$data['name'] = 'test ime';
$data['title'] = 'admsasdfghjklasdfghjklasdc2@in';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='insert';
$employee = new employee_model();
try{
$employee ->validation($data,$process);
 echo $employee->insert($data);
} catch(Exception $e)
{
	$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	echo $error;
	print_r($e->getTrace());
	echo 'Error happened in the process. Please try again.';
}
