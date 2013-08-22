<?php

class employee_model
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
			$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
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
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
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
			$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
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
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
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
			$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
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
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
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
			$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
			if($dbcon == false)
			{	
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
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
			$result = mysql_query("SELECT * FROM employee WHERE id='".$data['id']."'");
			if(!isset($result))
			{
				throw new Exception('select by id no access');
			}
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			mysql_close($dbcon);
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
		}
		return $row;
	}
///////////VALIDATION///////////////
	public function validation($data,$process)
	{
		if($process=='delete')
		{
			$result = $this->valid_int($data['id']);
			return $result;
		}
		if($process == 'update')
		{
			$result = array(
			'id' => $this->valid_int($data['id']),
			'name' => $this->valid_string($data['name'], 1,20),
			'title' => $this->valid_string($data['title'], 1,15),
			'modified' => $this->valid_date($data['modified'])
			);
			//print_r($result);
			foreach($result as $result1)
			{
				if(preg_match('/[0]/',$result1))
				{
					return 0;
				}
			}
			return 1;
		}
		if($process == 'insert')
		{
			$result = array(
			'created' => $this->valid_date($data['created']),
			'name' => $this->valid_string($data['name'], 1,20),
			'title' => $this->valid_string($data['title'], 1,15),
			'modified' => $this->valid_date($data['modified'])
			);
			//print_r($result);
			foreach($result as $result1)
			{
				if(preg_match('/[0]/',$result1))
				{
					return 0;
				}
			}
			return 1;
		}
	}
	public function valid_string($data, $minlength, $maxleng)
	{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(!preg_match('/[!@#$%^&*()<>,.;:\|}{?]/',$data))
				{ 	
					return 1;
				}
			}
		}
		return 0;
	}
	public function valid_date($data)
	{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data))
			{
				return 1;
			}
		}
		return 0;
	}
	public function valid_int($id)
	{
		$daty= trim($id);
		if(!empty($id))
		{
				if(preg_match('/^[0-9]{1,11}$/',$id))
				{
					return 1;
				}
			
		}
		return 0;
	}
	public function data()
	{
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
			$selected = mysql_select_db($database, $dbcon);
			if($selected ==false)
			{
				throw new Exception('no name data');
			}
			if($selected == true)
			{ echo 'access';}
			mysql_close($dbcon);
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
		}
	}
	

}