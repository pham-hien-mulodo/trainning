<?php

require_once('employee_model.php');

$data = array();
$data['name'] = 'hien';
$data['title'] = 'admin';
$data['created'] = '2013-09-08 09:11:00';
$data['modified'] = '2013-09-08 09:11:00';
//date_default_timezone_set('VietNam/HoChiMinh');
//$data['created'] = date('m/d/Y h:i:s', time());
//$data['modified'] = date('m/d/Y h:i:s', time());

$employee = new employee_model();
$result = $employee -> insert($data);

print_r($result);