<?php
require_once 'employee_model.php';
$id = 7;

$employee = new employee_model();
$employee -> delete($id);
