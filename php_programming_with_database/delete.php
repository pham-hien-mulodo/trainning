<?php
require_once('employee_model.php');
$data = array();
$data['id'] = 12;

$employee = new employee_model();
$process ='delete';
$result = $employee ->validation($data,$process);
if($result == 1)
{
	echo $employee->delete($data);
}

else echo 'error data incorrect';