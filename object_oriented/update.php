<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['name'] = "' OR ''='";
$data['title'] = 'admin';
$data['employee_code'] = 111;
$data['id'] = 135;
$data['year'] = 2013;
$data['month']= 12;
$data['payment'] = 8800;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$data['process'] ='update';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
//$salary = new SalaryModel();
//$salary->validation($data, $process);
//echo $salary->update($data);

//print_r(class_implement(new SalaryModel($data));

$employee = new EmployeeModel();
echo $employee->update($data);


