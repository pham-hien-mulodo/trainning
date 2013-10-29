<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data= array();
$data['id'] = 120;
$data['process'] = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$salary = new SalaryModel();
$salary->selectById($data);

//$employee = new EmployeeModel();
//$employee->selectById($data);
