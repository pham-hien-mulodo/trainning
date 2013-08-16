<?php
require_once 'employee_model.php';
$id = 7;
 
$employee = new employee_model();
//$result = $employee -> select_by_id();
$employee ->select();
