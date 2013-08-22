<?php

class employee_model
{

//////////////DELETE///////////////

	public function delete($data)
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database ="php_basics";
		$dbcon = mysql_connect($hostname, $username, $password) or die ("ko ket noi den mysql");
		$selected = mysql_select_db($database,$dbcon) or die("ko the lay php_basics");
		$result = mysql_query("DELETE FROM employee WHERE id = '".$data['id']."'");
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
		if($process =='delete')
		{
			$result = $this->valid_int($data['id'], 1,11);
			if($result == 1)
			{
				return 1;
			}
			else
			return 0;
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
		$kq= 0;
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_string($data))
				{
					$kq= 1;
				}
			}
		}
		return $kq;
	}
	public function valid_date(&$data)
	{
		$kq=0;
		$daty = trim($data);
		if(!empty($daty))
		{
			if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data))
			{
				date_default_timezone_set('Asia/Bangkok');
				$data = strtotime($data);
				$dat1=date('Y-m-d H:i:s', $data);
				$data = $dat1;
				$kq=1;
			} }
		return $kq;
	}
	public function valid_int($data, $minlength, $maxleng)
	{
		$kq= 0;
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_int($data))
				{
					$kq= 1;
				}
			}
		}
		return $kq;
	}
}