<?php
ob_start();
session_start();
require_once('../model/SalaryModel.php');
require_once('../model/EmployeeModel.php');
$data = array();

$data['id'] = $_GET['id'];
//$data['token'] = $_POST['token'];
$data['process'] = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$em = new EmployeeModel();
$data= $em->selectById($data);
$em = new EmployeeModel();
//if($data['token'] == $_SESSION['token']){
if (isset($_POST['name']) || isset($_POST['title']) ){
	$result['id'] = $data['id'];
	$result['process'] = 'update';
	date_default_timezone_set('Asia/Bangkok');
	$result['colum'] = 'salary';
	$result['colums'] = 'employee';
	$result['name'] = $_POST['name'];
	$result['title'] = $_POST['title'];
	$day = time();
	$result['modified'] = date('Y-m-d H:i:s', $day);
	$result= $em->update($result);
	if(!isset($result))
	{
		echo "error";
	}
	else echo $result;
//	}
}
?>





























