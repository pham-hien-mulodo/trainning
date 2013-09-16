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
<form action="insert.php" method = "POST"> 

 Name : <input type="text" name="name" value="<?php echo empty($result['name'])?null:$result['name']; ?>" /> </br>
 Title :<input type="text" name="title" value="<?php echo empty($result['title'])?null:$result['title']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' />
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</body>
	
</html>