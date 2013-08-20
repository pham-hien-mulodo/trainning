<?php
require_once('employee_model.php');
$id = '201';

$employee = new employee_model();
echo $employee->delete($id);

//echo $employee -> validation_delete($id);
//echo $result;