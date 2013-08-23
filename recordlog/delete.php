<?php
require_once('employee_model.php');
$data = array();
$data['id'] = 39;
date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();
$process ='delete';


try{
$result = $employee ->validation($data,$process);
 echo $employee->delete($data);
} catch(Exception $e)
{
	$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	echo $error;
	print_r($e->getTrace());
	echo 'Error happened in the process. Please try again.';
}


//else echo 'error data incorrect';
//$salary = 12345111678923;
//echo $employee->valid_int($salary,1,11);
