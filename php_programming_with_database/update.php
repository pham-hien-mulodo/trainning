<?php
require_once('employee_model.php');

$data = array();
$data['id'] = 4123456789126 ;
$data['name'] = 'hientest1';
$data['title'] = 'user';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['modified'] = date('Y-m-d H:i:s', $day);

$employee = new employee_model();

$process = 'update';

if($employee ->validation($data,$process))
{
	echo $employee->update($data);
}
else echo 'error data incorrect';