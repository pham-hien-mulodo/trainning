<?php

require_once('employee_model.php');

$data = array();

$data['name'] = 'test ime';
$data['title'] = 'admc2@in';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='insert';
$employee = new employee_model();

if($employee ->validation($data,$process) == 0)
{
	echo 'error data incorrect';
}
else echo $employee->insert($data);