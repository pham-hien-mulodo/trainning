<?php
echo $token;
/* <button><a href='index.php?uri=salary/insertkq&param[employee_code]=<?php echo $result['employee_code']; ?>&param[year]=<?php echo $result['year']; ?>&param[month]=<?php echo $result['month']; ?>&param[payment]=<?php echo $result['payment']; ?>&param[token]=<?php echo $token; ?>&param[id]=<?php echo $data['id'] ?>'>Insert</a></button>*/
 //<input type='submit' name='submit' value='Submit' /> $param[employee_code]=<?php echo $employee_code; ?>
?>
<html>
<head>
	<title>INSERT</title>
</head>
<body>
<form action="index.php?uri=salary/insertkq" method = "POST"> 

 Employee_code : <input type="text" name="employee_code" value="<?php echo empty($result['employee_code'])?null:$result['employee_code']; ?>" /> </br>
 year :<input type="text" name="year" value="<?php echo empty($result['year'])?null:$result['year']; ?>" /> </br>
 month :<input type="text" name="month" value="<?php echo empty($result['month'])?null:$result['month']; ?>" /> </br>
 payment:<input type="text" name="payment" value="<?php echo empty($result['payment'])?null:$result['payment']; ?>" /> </br>

 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
<a href='index.php?uri=salary/insertkq&param[token]=<?php echo $token; ?>'><strong>New Salary</strong></a>
</body>
</html>