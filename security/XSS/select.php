<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data= array();
$data['id'] = 204;
$data['process'] = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
//$salary = new SalaryModel();
//$result = $salary->selectById($data);

$employee = new EmployeeModel();
$result =$employee->selectById($data);
foreach($result as $key => $value)
{
	print_r($value);
	echo "\t";
}