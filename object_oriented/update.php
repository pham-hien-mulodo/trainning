<?php
require_once('salary.php');
require_once('EmployeeModel.php');
$data = array();
$data['name'] = 'update retest';
$data['title'] = 'admin';
$data['employee_code'] = 110;
$data['id'] = 92;
$data['year'] = 2013;
$data['month']= 11;
$data['payment'] = 88000;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='update';
$colum = 'salary';
$colums = 'employee';
$salary = new SalaryModel();
$salary->validation($data, $process);
echo $salary->update($data,$colum,$colums);

/*
$employee = new EmployeeModel();
$employee->validation($data,$process);
echo $employee->update($data);
*/

