<?php
require_once('interface.php');
require_once('Salary.php');
require_once('abstractModel.php');
class SalaryModel extends aModel
{
	public function __construct(){

	}
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
	
///////////////// DELETE //////////////////
	public function delete($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$this->calldbConnect();
			$check = $this->checkIdExit($data['id'],$colum);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			
			$result = mysql_query("DELETE FROM $colum WHERE id = '".$data['id']."'");
			$sa = mysql_affected_rows();
			if($sa < 1)
			{
				throw new Exception('delete salary no access');
			}
			mysql_query('commit');
			$count = $sa;
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
////////////  INSERT  /////////////////////
	public function insert($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$sa = new Salary($data);
		$count = 0;
		try
		{
			$result = $sa->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$check = $this->checkIdExit($data['employee_code'], $colums);
			if($check == 0)
			{
				throw new Exception('employee_code no exit');
			}
			$sql = "INSERT INTO $colum (employee_code, year, month, payment, created, modified) VALUES ('".$data['employee_code']."','".$data['year']."','".$data['month']."','".$data['payment']."', '".$data['created']."', '".$data['modified']."')";
			$result = mysql_query($sql);
			$count = mysql_insert_id();
		//	echo $count;
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
		$this->calldbClose();
		return $count;
	}

/////////////UPDATE/////////////////

	public function update($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$sa = new Salary($data);
		$count = 0;
		try
		{
			$result = $sa->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$check =  $this->checkIdExit($data['id'], $colum);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$check = $this->checkIdExit($data['employee_code'],$colums);
			if($check == 0)
			{
				throw new Exception('employee_code no exit');
			}
			$sql = "update $colum set employee_code='".$data['employee_code']."',year='".$data['year']."',month='".$data['month']."',payment='".$data['payment']."', created='".$data['created']."', modified='".$data['modified']."' where id = '".$data['id']."'";
			$result = mysql_query($sql);
			$count = mysql_affected_rows();
			if($count < 1)
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
		$this->calldbClose();
		return $count;
	}
/////////////  SELECT ////////////////////////
	public function selectById($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$row = 0;
		try
		{
			$this->calldbConnect();
			$this->checkIdExit($data['id'],$colum);
			$result = mysql_query("SELECT * FROM $colum WHERE id='".$data['id']."'");
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














