<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = 196;
$data['process'] ='delete';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$data['token'] = '11a9f5adeea200872d8478ffd9500371a1794d79';
date_default_timezone_set('Asia/Bangkok');
$employee = new EmployeeModel();
echo $employee->delete($data);
echo "\n";
//echo $employee->create_token($data);
//echo $employee->checktoken($data);
//$salary = new SalaryModel();
//echo $salary->delete($data);



