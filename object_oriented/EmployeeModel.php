<?php
require_once('interface.php');
require_once('Employee.php');
require_once('abstractModel.php');
class EmployeeModel extends aModel
{
	protected function calldbConnect()
	{
		return $this->dbConnect();
	}
	protected function calldbClose()
	{
		return $this->dbClose();
	}
	protected function checkIdExit($data,$colum)
	{
		return $this->checkId($data,$colum);
	}

//////////////DELETE///////////////

	public function delete($data)
	{
		$em = new Employee($data);
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$result = $em->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$result = mysql_query("DELETE FROM $colum WHERE employee_code = '".$data['id']."'");
			$count = mysql_affected_rows();
			if(!isset($result))
			{
				throw new Exception('delete salary no access');
			}
			$result = mysql_query("DELETE FROM $colums WHERE id = '".$data['id']."'");
			$count = mysql_affected_rows();
			if($count < 1 )
			{
				throw new Exception('delete employee no access');
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
		$this->calldbClose();
		return $count;
	}// kiem tra id ton tai: check_id_exit()

//////////////INSERT////////////////

	public function insert($data)
	{
		$em = new Employee($data);
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$result = $em->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$sql = "INSERT INTO employee (name , title, created, modified) VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
			$result = mysql_query($sql);
			if(!isset($result))
			{
				throw new Exception('insert no access');
			}
			$count = mysql_insert_id();
			//echo $count;
			mysql_query('commit');
			
		} catch(Exception $e)
		{
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->calldbClose();
		return $count;
	}

/////////////UPDATE/////////////////

	public function update( $data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$em = new Employee($data);
		$count = 0;
		try
		{
			$result = $em->validate($data);
			if($result == 0)
			{
				throw new Exception('valid ko dung dinh dang - ');
			}
			$this->calldbConnect();
			$check = $this->checkIdExit($data['id'],$colums);
			if(!isset($check))
			{
				throw new Exception('check id no access');
			}
			
			$sql = "update employee set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
			var_dump($sql);
			$result = mysql_query($sql);
			if(!isset($result))
			{
				throw new Exception('update no access');
			}
			$count = mysql_affected_rows();
			mysql_query('commit');
		} catch(Exception $e)
		{
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			echo 'Error happened in the process. Please try again.';
		}
		$this->calldbClose();
		return $count;
	}

/////////////SELECT_BY_ID////////////

	public function selectById($data)
	{
		$em = new Employee($data);
		$colum = $data['colum'];
		$colums = $data['colums'];
		$row = 0;
		try
		{
			$result = $em->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$this->calldbConnect();
			$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$result = mysql_query("SELECT * FROM $colums WHERE id='".$data['id']."'");
			if(!isset($result))
			{
				throw new Exception('select by id no access');
			}
			$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$this->calldbClose();
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





