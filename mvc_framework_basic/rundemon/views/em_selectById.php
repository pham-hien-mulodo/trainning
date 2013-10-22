
<html>
<head><title>Update</title>
</head>
<body>
<form action="index.php?uri=employee/update&param[id]=<?php echo $data['id']; ?>" method = "POST"> 

 name : <input type="text" name="name" value="<?php echo empty($data['name'])?null:$data['name']; ?>" /> </br>
 Year : <input type="text" name="title" value="<?php echo empty($data['title'])?null:$data['title']; ?>" /> </br>
 <input type='submit' name='submit' value='Submit' /> 
<input type='hidden' name='token' value="<?php echo $token;?>" />
</form>
 <button><a href='index.php?uri=employee/index'><strong>Back</strong></a></button>
</body>
</html>
