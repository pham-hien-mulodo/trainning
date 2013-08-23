<?php
require_once('employee_model.php');
$data = array();
$data['id'] = 13;
date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();
$process ='delete';
if($employee ->validation($data,$process) == 1)
{
	$employee->delete_salary($data);
}
else echo 'error data incorrect';