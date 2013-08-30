<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = 96;
$data['process'] ='delete';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
date_default_timezone_set('Asia/Bangkok');
$employee = new EmployeeModel();
echo $employee->delete($data);
//$salary = new SalaryModel();
//echo $salary->delete($data);



