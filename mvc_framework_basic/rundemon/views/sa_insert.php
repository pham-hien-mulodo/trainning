
<html>
<head>
	<title>INSERT</title>
</head>
<body>
<form action="index.php?uri=salary/insertkq&param[employee_code]=<?php echo $result['employee_code']; ?>&param[year]=<?php echo $result['year']; ?>&param[month]=<?php echo $result['month']; ?>&param[payment]=<?php echo $result['payment']; ?>" method = "POST"> 

 Employee_code : <input type="text" name="employee_code" value="<?php echo empty($result['employee_code'])?null:$result['employee_code']; ?>" /> </br>
 year :<input type="text" name="year" value="<?php echo empty($result['year'])?null:$result['year']; ?>" /> </br>
 month :<input type="text" name="month" value="<?php echo empty($result['month'])?null:$result['month']; ?>" /> </br>
 payment:<input type="text" name="payment" value="<?php echo empty($result['payment'])?null:$result['payment']; ?>" /> </br>
<input type='submit' name='submit' value='Submit' /> 
 <input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
 <button><a href='index.php?uri=salary/index'><strong>Back</strong></a></button>
</body>
</html>