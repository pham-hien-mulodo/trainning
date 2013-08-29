<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = 119;
date_default_timezone_set('Asia/Bangkok');
$employee = new EmployeeModel();
$process ='delete';
$colum = 'salary';
$colums = 'employee';
$salary = new SalaryModel();
$salary->validation($data,$process);
echo $salary->delete($data,$colum,$colums);
//echo $employee ->validation($data,$process);
//echo $employee->delete($data);
