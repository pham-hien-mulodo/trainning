<?php
require_once('employee_model.php');
$id = 7;

$employee = new employee_model();
echo $employee -> delete($id);
//echo $result;