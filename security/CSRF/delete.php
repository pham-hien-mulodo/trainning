<?php
ob_start();
session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['id'] = $_GET['id'];
echo $_POST['token'];
$data['token'] = $_POST['token'];
$data['process'] ='delete';
$data['colum'] = 'salary';
$data['colums'] = 'employee';

date_default_timezone_set('Asia/Bangkok');
$employee = new EmployeeModel();
if($data['token'] == $_SESSION['token']){
$em = $employee->delete($data);
if(!isset($em))
{
	echo "error !";
}
}
?>
 DELETE ACCESS !



