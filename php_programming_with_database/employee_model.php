<?php
//require_once 'insert.php';
//require_once 'update.php';
//require_once 'delete.php';
//require_once 'select.php';
//require_once 'connect.php';


class employee_model
{
/*
public function data($data)
{
$hostname = "localhost";
$username = "root";
$password = "";
$database ="php_basics";
$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
	}
}
*/	public function insert($data)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
//		$sql = "INSERT INTO employee ('name' , 'title', 'created' , 'modified') VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
		$sql = "insert into employee ('name' , 'title', 'created' , 'modified') values ('kondo', 'GM', '2013-08-16', '2013-08-16')";
		$result = mysql_query($sql);
		echo mysql_error();
		//$result = mysql_query("select * from 'employee' ;");
		//if(isset($result))
		//{
		//echo "access";
		//}
		
	
	}
	public function select()
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysql_query($sql);
		$result = mysql_query("select * from 'employee' where 'id' = $result;");
		if(!empty($result))
		{
			echo $result;
		}
		else echo "no data";
	}

}
/*

public function delete($id)
{
	//echo "access";
	$sql = "DELETE FROM 'employee' WHERE 'id' = $id";
	$result = mysql_query($sql);
	if(!empty($result)) echo "access";
	else echo "error";
	return $result;
	
}
}


public function insert($data)
{
	$code = 200;
	//echo $data['name'],$data['title'];
	$sql = "INSERT INTO employee ('name' , 'title') VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
	$result = mysql_query($sql);
	if(isset($result))
	{
		echo "access";
		$sql = "SELECT LAST_INSERT_ID()";
		$result = mysql_query($sql);
		if(isset($result))
		{
			//print_r($result);
			return $result;}
	}
	else
	{ 
		echo $code;
	}
}
	
	$sql = "SELECT LAST_INSERT_ID()";
	$result = mysql_query($sql);
	if(isset($result))
	{
	
	//print_r($result);
	return $result;}
	else
	{ return $code;}
	
}

public function update($data)
{$sql = "UPDATE 'employee' SET 'name' = '".$result['name']."', 'title' = '".$result['title'] , 'modified'= 
    $result = array('name' => $data['name'], 'title' => $data['title']);
	$sql = "UPDATE 'employee' SET 'name' = '".$data['name']."', 'status' = ".$data['status'].", modified = ".$data['modified']."";
	$result = mysql_query($sql);
    return count($result);

public function select_by_id()
{
   $sql = "SELECT * FROM 'employee' WHERE 'id' = 1 ";
	$result = mysql_query($sql);
	if(empty($result))
	{echo "empty";}
	else echo "exit";
	foreach ($result as $result1)
	{
		$data = array(
		'id' => $result1 -> id,
		'name' => $result1 -> name,
		'title' => $result1 -> title,
		'created' => $result1 -> created
	//	'modified' => $result1 -> 'modified'
		);
	$result[] = $data;
	}
	print_r($result);
	return $result;
}

}
//public $employee =  employee();
//$employee -> delete(2);
//$employee -> insert();
//$employee -> select_by_id();
//$employee -> update();
*/