<?php
require_once('employee_model.php');
$id = 2;
 
$employee = new employee_model();
//$result = $employee -> select_by_id();
$employee ->select_by_id($id);

