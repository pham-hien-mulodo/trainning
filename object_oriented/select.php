<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data= array();
$data['id'] = 100;
$data['process'] = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$salary = new SalaryModel();
print_r($salary->selectById($data));
/*
$employee = new EmployeeModel();
echo $employee->checkIdExit($data);
echo $employee ->validation($data,1,11);
print_r($employee->selectById($data));
*/
