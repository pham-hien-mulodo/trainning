<?php
ob_start();
session_start();
require_once('../model/SalaryModel.php');
require_once('../model/EmployeeModel.php');
$data = array();
$data['id'] = (int)$_GET['id'];
$data['token'] = $_POST['token'];
$data['process'] ='delete';
$data['colum'] = 'salary';
$data['colums'] = 'employee';

date_default_timezone_set('Asia/Bangkok');
$employee = new EmployeeModel();
if(!empty($data['token']) && $data['token'] == $_SESSION['token']){
$em = $employee->delete($data);
if(!isset($em))
{
	echo "error !";
}
else echo $em;
}
?>



