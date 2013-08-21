<?php

require_once('employee_model.php');

$data = array();

$data['name'] = 'test ime';
$data['title'] = 'admc2@in';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);

//$data['created'] = date('m/d/Y h:i:s', time());
//$data['modified'] = date('m/d/Y h:i:s', time());
$process ='insert';
$employee = new employee_model();
//echo $employee -> validation_insert($data);
//echo $employee ->validation($data,$process);
//print_r($result);
if($employee ->validation($data,$process) == 0)
{
	echo 'error data incorrect';
}
else echo $employee->insert($data);