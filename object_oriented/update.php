<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['name'] = 'update retest';
$data['title'] = 'admin';
$data['employee_code'] = 111;
$data['id'] = 91;
$data['year'] = 2013;
$data['month']= 13;
$data['payment'] = 8800;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='update';
$colum = 'salary';
$colums = 'employee';
$salary = new SalaryModel();
//$salary->validation($data, $process);
echo $salary->update($data,$colum,$colums);

/*
$employee = new EmployeeModel();
$employee->validation($data,$process);
echo $employee->update($data);
*/

