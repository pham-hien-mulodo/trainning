<?php
?>
<h1> hehe access  </h1>

<html>
<head>
	<title> selectById </title>
</head>
<body>
<form action = "employee/selectById?id=<?php echo $data['id']; ?>" method = "POST">
Name: <input type="text" value="<?php echo empty($data['name'])?null:$data['name']; ?>" /> </br>
Title: <input type="text" value="<?php echo empty($data['name'])?null:$data['title']; ?>" /> </br>
<input type= 'submit' name = 'submit' value = ' Submit' />
</form>
</body>
</html>