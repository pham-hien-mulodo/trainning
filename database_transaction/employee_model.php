<?php

class employee_model
{

//////////////DELETE///////////////

	public function delete_employee($data)
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

	public function insert_employee($data)
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

	public function update_employee($data)
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
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
	}
	public function valid_date(&$data)
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
		try{
		$daty=trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_int($data))
				{
					return true;
				}
				else
				{
					throw new Exception('data no type int');
				}
			}else
			{
				throw new Exception('int length false');
			}
		}
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
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
	public function delete_salary($data)
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
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$result = mysql_query("select count(id) as id from employee where id = '".$data['id']."'");
			$test = mysql_fetch_assoc($result);
			if($test['id'] != 1)
			{
				throw new Exception('id no exit');
			}
			$result = mysql_query("DELETE FROM employee WHERE id = '".$data['id']."'");
			$count = mysql_affected_rows();
			echo $count;
			if($count < 1 )
			{
				throw new Exception('delete employee no access');
			}
			$result = mysql_query("DELETE FROM salary WHERE employee_code = '".$data['id']."'");
			$count = mysql_affected_rows();
			echo $count;
			echo ' ';
			if($count<1)
			{
				throw new Exception('delete salary no access');
			}
			mysql_query('commit');
		} catch(Exception $e)
		{
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		mysql_close($dbcon);
		//return $count;
	}
	public function insert_salary($data)
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
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$sql = "INSERT INTO employee (name , title, created, modified) VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
			$result = mysql_query($sql);
			$count = mysql_insert_id();
			echo $count;
			echo '-';
			if($count < 1)
			{
				throw new Exception('insert employee no access');
			}
			
			$sql = "INSERT INTO salary (employee_code, year, month, payment, created, modified) VALUES ('".$data['employee_code']."','".$data['year']."','".$data['month']."','".$data['payment']."', '".$data['created']."', '".$data['modified']."')";
			$result = mysql_query($sql);
			$count = mysql_insert_id();
			echo $count;
			if($count <1)
			{
				throw new Exception('insert salary no access');
			}
			mysql_query('commit');
		} catch(Exception $e)
		{
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		mysql_close($dbcon);
		//return $count;
	}

/////////////UPDATE/////////////////

	public function update_salary($data)
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
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$result = mysql_query("select count(id) as id from employee where id = '".$data['id']."'");
			$test = mysql_fetch_assoc($result);
			if($test['id'] != 1)
			{
				throw new Exception('id no exit');
			}
			$sql = "update employee set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
			$result1 = mysql_query($sql);
			$count1 = mysql_affected_rows();
			//echo $count1;
			//echo '__';
			if($count1 < 1)
			{
				throw new Exception('update employee no access');
			}
			
			$sql2 = "update salary set employee_code='".$data['employee_code']."',year='".$data['year']."',month='".$data['month']."',payment='".$data['payment']."', created='".$data['created']."', modified='".$data['modified']."' where employee_code = '".$data['id']."'";// id= '".$data['id']."'
			$result2 = mysql_query($sql2);
			$count2 = mysql_affected_rows();
			echo $count2;
			if($count2 < 1)
			{
				throw new Exception('update salary no access');
			}
			mysql_query('commit');
		} catch(Exception $e)
		{
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		mysql_close($dbcon);
		//return $count;
	}

}






