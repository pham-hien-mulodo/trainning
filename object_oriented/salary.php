<?php

abstract class Salary extends AbstractModel
{
	public function delete_salary($data)
	{
		protected function calldbConnect()
	{
		return $this->dbConnect();
	}
	protected function calldbClose()
	{
		return $this->dbClose();
	}
	protected function checkIdExit($id)
	{
		try{
		$this->dbConnect();
		$result = mysql_query("select count(id) as id from salary where id = $id");
		//print_r($result);
		$test = mysql_fetch_assoc($result);
		if($test['id'] != 1)
		{
			throw new Exception('id no exit');
		}else return true;
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->dbClose();
	}
	public function delete_salary($data)
	{
		$count = 0;
		try
		{
			$this->calldbConnect();
			$this->checkIdExit();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			
			$result = mysql_query("DELETE FROM salary WHERE id = '".$data['id']."'");
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
	public function insert_salary($data)
	{
		$count = 0;
		try
		{
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$this->checkIdExit($data['employee_code']);
			$sql = "INSERT INTO salary (employee_code, year, month, payment, created, modified) VALUES ('".$data['employee_code']."','".$data['year']."','".$data['month']."','".$data['payment']."', '".$data['created']."', '".$data['modified']."')";
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
		$this->calldbClose()
		return $count;
	}

/////////////UPDATE/////////////////

	public function update_salary($data)
	{
		$count = 0;
		try
		{
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$this->checkIdExit($data['id']);
			$this->checkIdExit($data['employee_code']);
			$sql = "update salary set employee_code='".$data['employee_code']."',year='".$data['year']."',month='".$data['month']."',payment='".$data['payment']."', created='".$data['created']."', modified='".$data['modified']."' where id = '".$data['id']."'";
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
		$this->calldbClose()
		return $count;
	}
////////////// VALIDATION //////////////

protected function validation($data,$process)
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
				'id' => $this->valid_int($data['id'], 1,11),
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
	
}












