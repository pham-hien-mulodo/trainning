<?php
require_once('employee_model.php');
$data = array();
$data['id'] = 14;
date_default_timezone_set('Asia/Bangkok');
$employee = new employee_model();
$process ='delete';
$employee ->validation($data,$process);
echo $employee->delete_salary($data);
