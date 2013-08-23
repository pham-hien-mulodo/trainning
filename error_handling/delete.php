<?php
require_once('employee_model.php');
$data = array();
$data['id'] = 13;
date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();
$process ='delete';
if($employee ->validation($data,$process) == 1)
{
	echo $employee->delete_employee($data);
}
else echo 'error data incorrect';