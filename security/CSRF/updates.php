<?php
ob_start();
session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = (int)$_GET['id'];
$data['token'] = $_POST['token'];
$salary = new SalaryModel();
if($data['token'] == $_SESSION['token']){
	$result['id'] = (int)$data['id'];
	$result['process'] = 'update';
	date_default_timezone_set('Asia/Bangkok');
	$result['colum'] = 'salary';
	$result['colums'] = 'employee';
	$result['employee_code'] = $_POST['employee_code'];
	$result['year'] = $_POST['year'];
	$result['month'] = $_POST['month'];
	$result['payment'] = $_POST['payment'];
	$day = time();
	$result['modified'] = date('Y-m-d H:i:s', $day);
	$result= $salary->update($result);
	if(!isset($result))
	{
		echo "error";
	}
	else echo $result;

}
?>





























