<?php
require_once('employee_model.php');
$data= array();
$data['id'] = 50;
 date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();

if($employee ->validation($data,$process) == 1)
{
	echo $employee->select($data);
}
else echo 'error data incorrect';
