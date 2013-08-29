<?php
require_once('salary.php');
require_once('EmployeeModel.php');
$data= array();
$data['id'] = 100;
$process = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$colum = 'salary';
$colums = 'employee';
$salary = new SalaryModel();
$salary -> validation($data,1,11);
print_r($salary->selectById($data,$colum, $colums));
/*
$employee = new EmployeeModel();
echo $employee->checkIdExit($data);
echo $employee ->validation($data,1,11);
print_r($employee->selectById($data));
*/
