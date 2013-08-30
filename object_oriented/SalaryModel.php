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
			$this->checkIdExit($data, $colum);
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
			$this->checkIdExit($data['employee_code'], $colums);
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
			$this->checkIdExit($data['id'], $colum);
			$this->checkIdExit($data['employee_code'],$colums);
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
////////////// VALIDATION //////////////
/*
	public function validation($data,$process)
	{
		if($process=='delete' || $process == 'selectById')
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
				'employee_code' => $this->valid_int($data['employee_code'], 1,11),
				'payment' => $this->valid_int($data['payment'], 1,11),
				'year' => $this->valid_int($data['year'], 1,11),
				'month' => $this->valid_int($data['month'], 1,11),
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
				'employee_code' => $this->valid_int($data['employee_code'], 1,11),
				'payment' => $this->valid_int($data['payment'], 1,11),
				'year' => $this->valid_int($data['year'], 1,11),
				'month' => $this->valid_int($data['month'], 1,11),
				'modified' => $this->valid_date($data['modified']),
				'created' => $this->valid_date($data['created'])
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
	*/













