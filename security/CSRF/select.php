<?php

session_start();
require_once('SalaryModel.php');
require_once('EmployeeModel.php');
$data = array();
$data['token'] = $_POST['token'];
var_dump($_POST['token']);
$data['id'] = (int)$_GET['id'];
$data['process'] = 'selectById';
$colum = 'salary';
date_default_timezone_set('Asia/Bangkok');
$data['colum'] = 'salary';
$data['colums'] = 'employee';
$em = new EmployeeModel();
if($data['token'] == $_SESSION['token'])
{
$data= $em->selectById($data);
}
$token = $_SESSION['token'];
var_dump($_SESSION['token']);
?>
<html>
<head>
	<title>Update</title>
</head>
<body>
<form action="update.php/?id=<?php echo $data['id']; ?>" method = "POST"> 

 Name : <input type="text" name="name" value="<?php echo empty($data['name'])?null:$data['name']; ?>" /> </br>
 Title :<input type="text" name="title" value="<?php echo empty($data['title'])?null:$data['title']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' /> 
<button><a href='index.php'>Back</a></button>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>

</body>
</html>




























