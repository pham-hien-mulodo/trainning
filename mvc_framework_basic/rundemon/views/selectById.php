
<html>
<head><title>Update</title>
</head>
<body>
<form action="index.php?uri=salary/update&param[id]=<?php echo $data['id']; ?>" method = "POST"> 

 Employee_code : <input type="text" name="employee_code" value="<?php echo empty($data['employee_code'])?null:$data['employee_code']; ?>" /> </br>
 Year:<input type="text" name="year" value="<?php echo empty($data['year'])?null:$data['year']; ?>" /> </br>
 Month:<input type="text" name="month" value="<?php echo empty($data['month'])?null:$data['month']; ?>" /> </br>
 Payment:<input type="text" name="payment" value="<?php echo empty($data['payment'])?null:$data['payment']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' /> 

<input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
 <button><a href='index.php?uri=salary/index'><strong>Back</strong></a></button>
</body>
</html>




























