<?php
ob_start();
session_start();
require_once('../model/SalaryModel.php');
require_once('../model/EmployeeModel.php');
$data = array();
$token = $_SESSION['token'] =sha1(uniqid(rand(),true));
$data['id'] = (int)$_GET['id'];
$data['process'] = 'selectById';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$salary = new SalaryModel();
$data= $salary->selectById($data);
?>
<html>
<head><title>Update</title>
</head>
<body>
<form action="updates.php/?id=<?php echo $data['id']; ?>" method = "POST"> 

 Employee_code : <input type="text" name="employee_code" value="<?php echo empty($data['employee_code'])?null:$data['employee_code']; ?>" /> </br>
 Year:<input type="text" name="year" value="<?php echo empty($data['year'])?null:$data['year']; ?>" /> </br>
 Month:<input type="text" name="month" value="<?php echo empty($data['month'])?null:$data['month']; ?>" /> </br>
 Payment:<input type="text" name="payment" value="<?php echo empty($data['payment'])?null:$data['payment']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' /> 
<button><a href='indexsalary.php'>Back</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</body>
</html>




























