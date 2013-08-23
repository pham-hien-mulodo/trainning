<?php
require_once('employee_model.php');
$data= array();
$data['id'] = 96;
 date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();
$employee ->valid_int($data,1,11);
print_r($employee->select_by_id($data));
