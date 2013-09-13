<?php
ob_start();
session_start();
require_once('interface.php');
require_once('EmployeeModel.php');
require_once('SalaryModel.php');
$data = array();

$data = $_POST;
$token = null;
/*$data['name'] = '<script>alert(“hello!”)</script>';
$data['title'] = '<script>hi</script>';
$data['employee_code'] = 107;
$data['year'] = 2013;
$data['month']= 12;
$data['payment'] = 109000;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$data['process'] ='insert';
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$data['token'] = '11a9f5adeea200872d8478ffd9500371a1794d79';
//$salary = new SalaryModel();
//echo $salary->insert($data);
echo "\n";
*/

if(empty($_POST)){
$_SESSION['token'] = md5('abc');

}
else {
$employee = new EmployeeModel();
var_export($data['token']);
var_export($_SESSION['token']);
	if($data['token'] == $_SESSION['token']){
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$result = $employee->insert($data);
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

 <input type="text" name="name" value="<?php echo empty($data['name'])?null:$data['name']; ?>" /> </br>
 <input type="text" name="title" value="<?php echo empty($data['title'])?null:$data['title']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' />
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
</body>
	
</html>