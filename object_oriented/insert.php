<?php
require_once('EmployeeModel.php');
require_once('salary.php');
$data = array();
/*$data['hostname'] = 'localhost';
$data['username'] = 'root';
$data['password'] = '';
$data['database'] = 'php_basics';*/
$data['name'] = 'test ime';
$data['title'] = 'a@in';
$data['employee_code'] = 107;
//$data['id'] = 13;
$data['year'] = 2013;
$data['month']= 08;
$data['payment'] = 100000;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='insert';
$colum = 'salary';
$colums = 'employee';
$salary = new SalaryModel();
$salary->validation($data, $process);
echo $salary->insert($data, $colum, $colums);
/*
$employee = new EmployeeModel();
$employee->validation($data,$process);
echo $employee->insert($data);*/

