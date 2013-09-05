<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = 140;
$data['process'] ='delete';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
date_default_timezone_set('Asia/Bangkok');
$employee = new EmployeeModel();
echo $employee->delete($data);
//$vidu  = new vidu();
//echo $vidu->delete($data);
//$salary = new SalaryModel();
//echo $salary->delete($data);



