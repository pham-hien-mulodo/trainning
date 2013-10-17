<html>
<head>
	<title>Update</title>
</head>
<body>
<form action="em_update.php/?id=<?php echo $data['id']; ?>" method = "POST"> 

 Name : <input type="text" name="name" value="<?php echo empty($data['name'])?null:$data['name']; ?>" /> </br>
 Title :<input type="text" name="title" value="<?php echo empty($data['title'])?null:$data['title']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' /> 
</form>
</body>
</html>