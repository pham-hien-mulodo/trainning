<?php
require_once('employee_model.php');
$data= array();
$data['id'] = 50;
 date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();

try{
//$result = $employee ->validation($data,$process);
 print_r($employee->select_by_id($data));
} catch(Exception $e)
{
	$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	echo $error;
	print_r($e->getTrace());
	echo 'Error happened in the process. Please try again.';
}

