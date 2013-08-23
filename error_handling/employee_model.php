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
			$result = $this->valid_int($data['id'], 1,11);
			if($result == 1)
			{
				return 1;
				}
			else return 0;
		}
		if($process == 'update')
		{
				$result = array(
				'id' => $this->valid_int($data['id'], 1,11),
				'name' => $this->valid_string($data['name'], 1,20),
				'title' => $this->valid_string($data['title'], 1,15),
				'modified' => $this->valid_date($data['modified'])
				);
				foreach($result as $result1)
				{
					if($result1 == 0)
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
			foreach($result as $result1)
			{
				if($result1 == 0)
				{
					return 0;
				}
			}
			return 1;
		}
	}
	public function valid_string($data, $minlength, $maxleng)
	{
		
		try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_string($data))
				{
					return true;
				}else { throw new Exception('data type string false'); return false;}
			}else { throw new Exception('string length false'); return false;}
		}else { throw new Exception('string empty'); return flase;}
		} catch(Exception $e)
		{
			echo $e->getmessage();
		}
		return false;
	}
	public function valid_date($data)
	{
		try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data,$matches))
			{
				if(checkdate($matches[2], $matches[3], $matches[1]))
				{
					return true;
				}else { throw new Exception('date no exit'); return false;}
			}else { throw new Exception('format date false'); return false;}
		}else { throw new Exception('date empty'); return false;}
		} catch(Exception $e)
		{
			echo $e->getmessage();
		}
		return false;
	}
	public function valid_int($data, $minlength, $maxleng)
	{
		$kq= 0;
		$daty = trim($data);
		try
		{
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_int($data))
				{
					$kq= 1;
				}
				else
				{
					throw new Exception('data no type int');
				}
			}else
			{
				throw new Exception('int length false');
			}
		}else
		{
			throw new Exception('int no data');
		}
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
		}
		return $kq;
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