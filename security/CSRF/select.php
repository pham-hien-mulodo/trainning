<?php
ob_start();
session_start();
		$token= md5('test');
		$_SESSION['token'] = $token;
	
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data= array();
$data['id'] = 204;
$data['process'] = 'selectById';
$colum = 'salary';
$data['token'] = '11a9f5adeea200872d8478ffd9500371a1794d79';
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
echo "</br>";
}
