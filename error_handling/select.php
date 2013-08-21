<?php
require_once('employee_model.php');
$id = 5;
 
$employee = new employee_model();
//$result = $employee -> select_by_id();
$row = $employee ->select_by_id($id);
//$employee->select_all();
		if(!empty($row))
		{
			print_r($row);
		}else echo " id no exit";

