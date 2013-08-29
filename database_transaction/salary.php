<?php

abstract class Salary extends AbstractModel
{
	protected function calldbConnect()
	{
		return $this->dbConnect();
	}
	protected function calldbClose()
	{
		return $this->dbClose();
	}
	protected function callcheckIdExit($id)
	{
		return $this->checkIdExit($id);
	}
	public function delete_salary($data)
	{
		
		$count = 0;
		
		try
		{
			$this->calldbConnect();
			$this->callcheckIdExit();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$result = mysql_query("DELETE FROM employee WHERE id = '".$data['employee_code']."'");
			$counts = mysql_affected_rows();
			echo $counts;
			if($counts < 1 )
			{
				throw new Exception('delete employee no access');
			}
			$result = mysql_query("DELETE FROM salary WHERE id = '".$data['id']."'");
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
			mysql_query('rollback, set autocommit = 1');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->calldbClose();
		return $count;
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