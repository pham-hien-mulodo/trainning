<?php/*
session_start();
require_once('interface.php');
require_once('EmployeeModel.php');
require_once('SalaryModel.php');
$data = array();
$data = $_POST;
$token = null;

if(empty($_POST)){
$_SESSION['token'] =sha1(uniqid(rand(),true));
}
else {
$salary = new SalaryModel();
	if($data['token'] == $_SESSION['token']){
		$day = time();
		date_default_timezone_set('Asia/Bangkok');
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$result = $salary->insert($data);
		if(isset($result))
		{
		
			return $result;
		}
		else return 0;
	}
}*/
var_dump($result);
?>
access