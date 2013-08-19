<?php
require_once('employee_model.php');

$data = array();
$data['id'] = '26';
$data['name'] = 'hien up';
$data['title'] = 'user';
//$data['created'] = '2013-09-08 09:11:00';
$data['modified'] = '2013-09-08 09:11:00';
$employee = new employee_model();
echo $employee -> update($data);
//$employee -> data($data);