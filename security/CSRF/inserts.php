<?php
ob_start();
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
$employee = new EmployeeModel();
	if($data['token'] == $_SESSION['token']){
		$day = time();
		date_default_timezone_set('Asia/Bangkok');
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$result = $employee->insert($data);
		if(isset($result))
		{
			echo "access";
		}
	}
}
$token = $_SESSION['token'];
?>
<html>
<head>
	<title>INSERT</title>
</head>
<body>
<form action="inserts.php" method = "POST"> 

 Employee_code : <input type="text" name="employee_code" value="<?php echo empty($result['employee_code'])?null:$result['employee_code']; ?>" /> </br>
 year :<input type="text" name="year" value="<?php echo empty($result['year'])?null:$result['year']; ?>" /> </br>
 month :<input type="text" name="month" value="<?php echo empty($result['month'])?null:$result['month']; ?>" /> </br>
 payment:<input type="text" name="payment" value="<?php echo empty($result['payment'])?null:$result['payment']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' />
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</body>
	
</html>