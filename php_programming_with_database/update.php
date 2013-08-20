<?php
require_once('employee_model.php');

$data = array();
$data['id'] = '26';
$data['name'] = '  hien 78';
$data['title'] = 'user';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['modified'] = date('Y-m-d H:i:s', $day);
//$name =' pham thi   thu hien';
//echo trim($name);
$employee = new employee_model();
echo $employee->update($data);
//echo $employee -> validation_update($data);
print_r($employee ->valid_name($data));