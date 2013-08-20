<?php

class employee_model
{
/*		
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
	$this->validation($data);
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
		$this->validation($data);
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database = "php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die (" no connect");
		$selected = mysql_select_db($database, $dbcon) or die ("no database");
		$sql = "update employee set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
		$result = mysql_query($sql);
		$count = mysql_affected_rows();
		mysql_close($dbcon);
		return $count;
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
///////////VALIDATION///////////////
	public function validation($data, $process)
	{
		$code = '200';
		$message ='';
		switch($process){
		case "insert":
				if(!empty($data['id']) &&  !empty($data['name']) && !empty($data['title']) && !empty($data['modified']))
		{
			if(!preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['name']) || !preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['title']) || !preg_match('/(\d{4})-(\d{2})-(\d{2})/', $data['created']) || !preg_match('/(\d{4})-(\d{2})-(\d{2})/', $data['modified']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else 
		{
			$code = '201';
			$message = 'have fied data null';
		}
		break ;
		case "update":
		if(!empty($data['id']) &&  !empty($data['name']) && !empty($data['title']) && !empty($data['modified']))
		{
			if(!preg_match('/^[0-9]{1,11}$/',$data['id']) || !preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['name']) || !preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['title']) || !preg_match('/(\d{4})-(\d{2})-(\d{2})/', $data['modified']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else 
		{
			$code = '201';
			$message = 'have fied data null';
		}
		break ;
		case "delete":
		if(!empty($data['id']))
		{
			if(!preg_match('/^[0-9]{1,11}$/',$data['id']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else
		{
			 $code= '201';
			 $message = 'have fied data null';
		}
		break ;
		}
	
	}
	public function validation_insert($data)
	{
		$code = '200';
		$message = 'true';
		if(!empty($data['id']) &&  !empty($data['name']) && !empty($data['title']) && !empty($data['modified']))
		{
			if(!preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['name']) || !preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['title']) || !preg_match('/(\d{4})-(\d{2})-(\d{2})/', $data['created']) || !preg_match('/(\d{4})-(\d{2})-(\d{2})/', $data['modified']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else 
		{
			$code = '201';
			$message = 'have fied data null';
		}
		$result = array('code'=>$code, 'message'=>$message);
		return $result;
	}*/
	public function validation_update($data)
	{
		echo $data['modified'];
		$code = '200';
		if(!empty($data['id']) &&  !empty($data['name']) && !empty($data['title']) && !empty($data['modified']))
		{
			if(!preg_match('/^[0-9]{1,11}$/',$data['id']) || !preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['name']) || !preg_match('/^[a-zA-Z0-9]{1,20}$/',$data['title']) || !preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data['modified']))
			{
				$code = '202';
			}
		}
		else 
		{
			$code = '201';
		}
		return $code;
	}
	public function validation_delete($id)
	{
		$code ='200';
		$message = '';
		if(!empty($id))
		{
			if(!preg_match('/^[0-9]{1,11}$/',$id))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else
		{
			 $code= '201';
			 $message = 'have fied data null';
		}
		$result = array('code'=>$code, 'message'=>$message);
		return $result;
	}
	public function valid_modified($data)
	{
		$code ='200';
		$message = '';
		if(!empty($data['modified']))
		{
			if(!preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data['modified']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else
		{
			 $code= '201';
			 $message = 'have fied data null';
		}
		$result = array('code'=>$code, 'message'=>$message);
		return $result;
	}
	public function valid_name($data)
	{
		$tr= trim($data['name']);
		$num = strlen($tr);
		$code ='200';
		$message = '';
		echo $num;
		if(0<$num && $num<21)
		{
			if(preg_match('/[!@#$%^&*()<>,.;:\|}{]/',$data['name']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else
		{
			 $code= '201';
			 $message = 'no data';
		}
		$result = array('code'=>$code, 'message'=>$message);
		return $result;
		
	}
	public function valid_title($data)
	{
		$tr= trim($data['title']);
		$num = strlen($tr);
		$code ='200';
		$message = '';
		echo $num;
		if(0<$num && $num<21)
		{
			if(preg_match('/[!@#$%^&*()<>,.;:\|}{]/',$data['title']))
			{
				$code = '202';
				$message = 'data type incorrect';
			}
		}
		else
		{
			 $code= '201';
			 $message = 'no data';
		}
		$result = array('code'=>$code, 'message'=>$message);
		return $result;
		
	}
	


}