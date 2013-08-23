<?php
require_once('employee_model.php');

$data = array();
$data['id'] = 46 ;
$data['name'] = 'hientestasdfghjklasdfghjkl891';
$data['title'] = 'user';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['modified'] = date('Y-m-d H:i:s', $day);
$employee = new employee_model();
$process = 'update';
//$data['modified'] = '2013-02-29 09:08:07';

try{
$employee ->validation($data,$process);
 echo $employee->update($data);
} catch(Exception $e)
{
	$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	echo $error;
	print_r($e->getTrace());
	echo 'Error happened in the process. Please try again.';
}
