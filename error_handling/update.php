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
if($employee ->validation($data,$process) == 1)
{
	echo $employee->update($data);
}
else echo 'error data incorrect';