<?php
ob_start();
session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data= $_POST;
$token = NULL;
$data['id'] = $_GET['id'];

/*
$data['name'] =  '<h1> </h1>';
$data['title'] = 'hiềnphạm ';
$data['employee_code'] = 145;
$data['id'] = 110;
$data['year'] = 2013;
$data['month']= 11;
$data['payment'] = 8800;
$day = time();
date_default_timezone_set('Asia/Bangkok');
$data['created'] = date('Y-m-d H:i:s', $day);
$data['modified'] = date('Y-m-d H:i:s', $day);
$data['process'] ='update';
$data['colum'] = 'salary';
$data['colums'] = 'employee';

//$salary = new SalaryModel();
//echo $salary->update($data);
echo "\n";
$employee = new EmployeeModel();
echo $employee->update($data);

*/

if(empty($_POST))
{
	$_SESSION['token'] = sha1(uniqid(rand(),true));
	$em = new EmployeeModel();
		$data['process'] ='update';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
	$result = $em->selectById($data);
	var_dump($result);
}
else
{

	$employee = new EmployeeModel();
	if($data['token'] == $_SESSION['token'])
	{
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$data['process'] ='update';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$result = $employee->update($data);
	}
}
$token = $_SESSION['token'];

?>

<html>
<head>
	<title> "update"</title>;
</head>
<body>
	<form action="update.php?id=<?php echo $result['id']; ?>" method = "POST"> 
	<input type="text" name="name" value="<?php echo empty($result['name'])?null:$result['name']; ?>" /> </br>
	<input type="text" name="title" value="<?php echo empty($result['title'])?null:$result['title']; ?>" /> </br>
	
	 <input type='submit' name='submit' value='Submit' />
	 <input type="hidden" name= 'token' value="<?php echo $token ?>"  /> 
	</form>

</body>

</html>


























