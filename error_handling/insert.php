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
if($employee ->validation($data,$process) == 1)
{
	echo $employee->insert($data);
}
else echo 'error data incorrect';
