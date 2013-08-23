<?php
require_once('employee_model.php');
$data = array();

$data['name'] = 'test ime';
$data['title'] = 'a@in';
$data['employee_code'] = 13;
$data['id'] = 13;
$data['year'] = 2013;
$data['month']= 08;
$data['payment'] = 10000;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='insert';
$employee = new employee_model();
$employee->validation($data,$process);
echo $employee->delete_salary($data);
