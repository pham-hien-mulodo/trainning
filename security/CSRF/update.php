<?php
ob_start();
session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = (int)$_GET['id'];
$data['token'] = $_POST['token'];
var_dump($_POST['token']);
$em = new EmployeeModel();
if(!empty($data['token']) && $data['token'] == $_SESSION['token']){
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
	else
	echo $result;
}
}
?>




























