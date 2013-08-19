<?php

class employee_model
{
		
//////////////DELETE///////////////

	public function delete($id)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$result = mysql_query("DELETE FROM employee WHERE id = $id");
		$count = mysql_affected_rows();
		mysql_close($dbcon);
		return $count;
		
	}// kiem tra id ton tai: check_id_exit()

//////////////INSERT////////////////

	public function insert($data)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$sql = "INSERT INTO employee (name , title, created, modified) VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
		
		$result = mysql_query($sql);
		echo mysql_error();
		$result = mysql_insert_id();
		mysql_close($dbcon);
		return $result;
	}

/////////////UPDATE/////////////////

	public function update($data)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		//check exit id
		$sql = "update employee set name = 'hien update' , title = 'admin', modified = '2013-09-08 09:11:00' where id=7";
		//$sql = "UPDATE employee SET name = '".$data['name']."', title = '".$data['title']."', modified = '".$data['modified']."' WHERE id='".$data['id']."'";
		$result = mysql_query($sql);
		mysql_close($dbcon);
	}

/////////////SELECT_BY_ID////////////

	public function select_by_id($id)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$result = mysql_query("SELECT * FROM employee WHERE id=$id");
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		mysql_close($dbcon);

		return $row;
	}

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
		/*
		$code = 100;
		try
		{
			//$sql = "SELECT LAST_INSERT_ID()";
			$result = mysql_query("SELECT LAST_INSERT_ID($result)");
			
			if(!empty($result))
			{
				echo $result;
			}
			else
			{
				$code = 101;
				$message = "select  last insert id fail";
				$result = $message;
			}
		}
		catch(Exeption $e)
		{
			$code = 102;
			$message = "insert fail";
			$result = $message;
		}
		$data = array('code' => $code, 'result' => $result);
		*/

}