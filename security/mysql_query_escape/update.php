<?php
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['name'] =  '1 OR 1 = 1';
$data['title'] = 'hiềnphạm ';
$data['employee_code'] = 145;
$data['id'] = 187;
$data['year'] = 2013;
$data['month']= 11;
$data['payment'] = 8800;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$data['process'] ='update';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
//$salary = new SalaryModel();
//echo $salary->update($data);
echo "\n";
$employee = new EmployeeModel();
echo $employee->update($data);


