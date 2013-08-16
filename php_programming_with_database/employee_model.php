<?php

class employee_model
{



//////////////SELECT_ALL//////////////
/*
	public function select_all($id)
	{
		$result = mysql_query("select * from employee ");
		return $result;
	}
*/
//////////////DELETE///////////////
/*
	public function delete($id)
	{
		//check exit id
		//echo "access";
		//$sql = "DELETE FROM employee WHERE id = $id";
		$result = mysql_query("DELETE FROM employee WHERE id = $id");
		if($result == true) { return 1;}
		else { return 0;}
	}
*/
//////////////INSERT////////////////
/*
	public function insert($data)
	{
		$sql = "INSERT INTO employee ('name' , 'title', 'created', 'modified') VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
		$result = mysql_query($sql);
		
		if(isset($result))
		{
			//$sql = "SELECT LAST_INSERT_ID()";
			$result = mysql_query("SELECT LAST_INSERT_ID()");
			if(!empty($result))
			{
				return $result;
			}
		}
	}
*/
/////////////UPDATE/////////////////
/*
	public function update($data)
	{
		//check exit id
		$sql = "UPDATE employee SET name = '".$data['name']."', 'title' = '".$data['title']."', 'modified' = '".$data['modified']."' WHERE id=$data['id']";
		$result = mysql_query($sql);
		if($result = true)
		{ return 1;}
		else
		{ return 0;}
		
	}
*/
/////////////SELECT_BY_ID////////////
/*
	public function select_by_id($id)
	{
		//$sql = "SELECT * FROM employee WHERE id=1";
	//	$row = mysql_fetch_array($result, mysql_assoc);
		$result = mysql_query("SELECT * FROM employee WHERE id=1");
		if(empty($result))
		{ echo "empty";}
		else { 
				//echo "exit";
				$data = array('id' => $result->id,'name' => $result->name,'title' => $result->title,'created' => $result->created,'modified' => $result->modified);
				print_r($data);
			}
	}
*/
///////////INSERT_TEST//////////////////
/*
	public function insert($data)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$sql = "INSERT INTO employee ('name' , 'title', 'created' , 'modified') VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
	//	$sql = "insert into employee ('name' , 'title', 'created' , 'modified') values ('kondo', 'GM', '2013-08-16 00:00:00', '2013-08-16 00:00:00') ";
		$result = mysql_query($sql);
		echo mysql_error();
		$sql = "SELECT LAST_INSERT_ID()";
		$id = mysql_query($sql);
		echo $result;
		$result = mysql_query("select 'name' from employee where 'id' = '".$id."'");
		if(!empty($result))
		{
			print_r($result['name']);
		}
		else echo mysql_error();
	
	}
*/
//////////DATA///////////
/*
	public function data($data)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		//$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password);
		if(! $dbcon)
		{
			die(mysql_error());
		}
		
		//$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$sql = "INSERT INTO employee ('name' , 'title', 'created', 'modified') VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
		mysql_select_db('php_basics');
		$result = mysql_query($sql, $dbcon);
		if(! $result)
		{
		die(mysql_error());
		}
		echo "access";
		mysql_close($dbcon);
}
*/

}