
<html>
<head>
	<title>INSERT</title>
</head>
<body>

<form action="index.php?uri=employee/insertkq" method = "POST"> 
 Name : <input type="text" name="name" value="<?php echo empty($result['name'])?null:$result['name']; ?>" /> </br>
 Title :<input type="text" name="title" value="<?php echo empty($result['title'])?null:$result['title']; ?>" /> </br>
 <input type='submit' name='Update' value='Update' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
 <button><a href='index.php?uri=employee/index'><strong>Back</strong></a></button>
</body>
	
</html>