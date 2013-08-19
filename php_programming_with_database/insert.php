<?php

require_once('employee_model.php');

$data = array();

$data['name'] = 'test time';
$data['title'] = 'admin';
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);

//$data['created'] = date('m/d/Y h:i:s', time());
//$data['modified'] = date('m/d/Y h:i:s', time());

$employee = new employee_model();
echo $employee -> insert($data);

//print_r($result);