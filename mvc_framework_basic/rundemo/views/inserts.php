<?php
ob_start();
session_start();
$data = array();
$data = $_POST;
$token = null;
$token = $_SESSION['token'];
?>
<html>
<head>
	<title>INSERT</title>
</head>
<body>
<form action="index.php?rt=salary/insert" method = "POST"> 

 Employee_code : <input type="text" name="employee_code" value="<?php echo empty($result['employee_code'])?null:$result['employee_code']; ?>" /> </br>
 year :<input type="text" name="year" value="<?php echo empty($result['year'])?null:$result['year']; ?>" /> </br>
 month :<input type="text" name="month" value="<?php echo empty($result['month'])?null:$result['month']; ?>" /> </br>
 payment:<input type="text" name="payment" value="<?php echo empty($result['payment'])?null:$result['payment']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' />
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</body>
	
</html>