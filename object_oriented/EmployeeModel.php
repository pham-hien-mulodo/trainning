<?php

class EmployeeModel
{
//////////////DELETE///////////////

	public function delete($data)
	{
		$count = 0;
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		try
		{
			$dbcon = mysql_connect($hostname, $username, $password);
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon);
			if($selected == false)
			{
				throw new Exception('no name data');
			}
			
			$result = mysql_query("select count(id) as id from employee where id = '".$data['id']."'");
			$test = mysql_fetch_assoc($result);
			if($test['id'] != 1)
			{
				throw new Exception('id no exit');
			}
			$result = mysql_query("DELETE FROM employee WHERE id = '".$data['id']."'");
			if(!isset($result))
			{
				throw new Exception('delete no access');
			}
			$count = mysql_affected_rows();
			mysql_close($dbcon);
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return $count;
		
	}// kiem tra id ton tai: check_id_exit()

//////////////INSERT////////////////

	public function insert($data)
	{
		$count = 0;
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		try
		{
			$dbcon = mysql_connect($hostname, $username, $password);
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon);
			if($selected == false)
			{
				throw new Exception('no name data');
			}
		
			$sql = "INSERT INTO employee (name , title, created, modified) VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
			$result = mysql_query($sql);
			if(!isset($result))
			{
				throw new Exception('insert no access');
			}
			$count = mysql_insert_id();
			mysql_close($dbcon);
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return $count;
	}

/////////////UPDATE/////////////////

	public function update($data)
	{
		$count = 0;
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database = "php_basics";
		try
		{
			$dbcon = mysql_connect($hostname, $username, $password);
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon);
			if($selected == false)
			{
				throw new Exception('no name data');
			}
			
			$result = mysql_query("select count(id) as id from employee where id = '".$data['id']."'");
			$test = mysql_fetch_assoc($result);
			if($test['id'] != 1)
			{
				throw new Exception('id no exit');
			}
			$sql = "update employee set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
			$result = mysql_query($sql);
			if(!isset($result))
			{
				throw new Exception('insert no access');
			}
			$count = mysql_affected_rows();
			mysql_close($dbcon);
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return $count;
	}

/////////////SELECT_BY_ID////////////

	public function select_by_id($data)
	{
		$row = 0;
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		try
		{
			$dbcon = mysql_connect($hostname, $username, $password);
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon);
			if($selected == false)
			{
				throw new Exception('no name data');
			}
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$result = mysql_query("select count(id) as id from employee where id = '".$data['id']."'");
			$test = mysql_fetch_assoc($result);
			if($test['id'] != 1)
			{
				throw new Exception('id no exit');
			}
			$result = mysql_query("SELECT * FROM employee WHERE id='".$data['id']."'");
			if(!isset($result))
			{
				throw new Exception('select by id no access');
			}
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			mysql_close($dbcon);
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return $row;
	}
	
	
}
