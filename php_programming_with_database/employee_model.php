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

}