<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data= array();
$data['id'] = 110;
$data['process'] = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$salary = new SalaryModel();
$result = $salary->selectById($data);

//$employee = new EmployeeModel();
//$result =$employee->selectById($data);
while ($row = mysqli_fetch_row($result))
{
	printf("%s- %s - %s -%s - %s", $row[0], $row[1], $row[2], $row[3], $row[4]);
}