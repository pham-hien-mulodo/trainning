<?php
require_once('employee_model.php');

$data = array();
$data['id'] = '67787';
$data['name'] = 'hien} 27';
$data['title'] = 'user';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['modified'] = date('Y-m-d H:i:s', $day);
//$name =' pham thi   thu hien';
//echo trim($name);
$employee = new employee_model();
//echo $employee->update($data);
//print_r($employee -> validation_update($data));
$id = '1111111';
$process = 'update';
//echo $employee ->valid_int($data['id']);
if($employee ->validation($data,$process) == 0)
{
	echo 'error data incorrect';
}
else echo $employee->update($data);