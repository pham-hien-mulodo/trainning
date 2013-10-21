
<html>
<head>

	<title> selectById </title>
	<meta charset="utf-8">
</head>
<body>
<form action = "index.php?uri=employee/update&param[id]=<?php echo $data['id']; ?>&param[name]=<?php echo $data['name']; ?>&param[title]=<?php echo $data['title']; ?>&param[token]=<?php echo $token; ?>" method = "POST">
Name: <input type="text" value="<?php echo empty($data['name'])?null:$data['name']; ?>" /> </br>
Title: <input type="text" value="<?php echo empty($data['name'])?null:$data['title']; ?>" /> </br>
 <input type='hidden' name='token' value="<?php echo $token;?>" />
<input type= 'submit' name = 'submit' value = ' Submit' />

</form>
</body>
</html>