<?php
require_once('employee_model.php');
$data = array();
$data['id'] = '2a01';

$employee = new employee_model();
$process ='delete';
//echo $employee -> validation_delete($id);
//echo $result;
if($employee ->validation($data,$process) == 0)
{
	echo 'error data incorrect';
}
else echo $employee->delete($data);