<?php
require_once('employee_model.php');
$data['name'] = 'test retest';
$data['title'] = 'user';
$data['employee_code'] = 119;
$data['id'] = 62;
$data['year'] = 2013;
$data['month']= 11;
$data['payment'] = 90000;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$process ='insert';
$employee = new employee_model();
$employee->validation($data,$process);
echo $employee->update_employee($data);
