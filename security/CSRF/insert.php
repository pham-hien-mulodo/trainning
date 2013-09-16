<?php

session_start();
require_once('interface.php');
require_once('EmployeeModel.php');
require_once('SalaryModel.php');
$data = array();
$data = $_POST;
$token = $_SESSION['token'];
?>
<html>
<head>
	<title>INSERT</title>
</head>
<body>
<form action="insertkq.php" method = "POST"> 

 Name : <input type="text" name="name" value="<?php echo empty($result['name'])?null:$result['name']; ?>" /> </br>
 Title :<input type="text" name="title" value="<?php echo empty($result['title'])?null:$result['title']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' />
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</body>
	
</html>