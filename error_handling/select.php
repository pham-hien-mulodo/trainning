<?php
require_once('employee_model.php');
$data= array();
$data['id'] = 50;
 
$employee = new employee_model();
//$result = $employee -> select_by_id();
print_r($employee ->select_by_id($data));



