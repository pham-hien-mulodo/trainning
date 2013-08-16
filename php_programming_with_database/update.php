<?php
require_once('employee_model.php');

$data = array();
$data['id'] = '5';
$data['name'] = 'hien';
$data['title'] = 'admin';
$data['created'] = '2013-09-08 09:11:00';
$data['modified'] = '2013-09-08 09:11:00';
$employee = new employee_model();
$employee -> update($data);
//$employee -> data($data);