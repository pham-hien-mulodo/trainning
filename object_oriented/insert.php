<?php
require_once('interface.php');
require_once('EmployeeModel.php');
require_once('SalaryModel.php');
$data = array();
$data['name'] = 'testime';
$data['title'] = 'a@in';
$data['employee_code'] = 107;
$data['year'] = 2013;
$data['month']= 8;
$data['payment'] = 109000;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$data['process'] ='insert';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$salary = new SalaryModel();
//$salary->validation($data, $process);
echo $salary->insert($data);
/*
$employee = new EmployeeModel();
$employee->validation($data,$process);
echo $employee->insert($data);*/

