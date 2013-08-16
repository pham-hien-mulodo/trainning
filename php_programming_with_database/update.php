<?php
require_once('employee_model.php');

$data = array();
$data['name'] = 'hien';
$data['title'] = 'admin';
$data['modified'] = date('m/d/Y h:i:s', time());
$employee = new employee_model();
//$employee -> update($data);
$employee -> data($data);