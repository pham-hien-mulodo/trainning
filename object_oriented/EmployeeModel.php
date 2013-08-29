<?php
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

//////////////DELETE///////////////

	public function delete($data,$colum,$colums)
	{
		$count = 0;
		try
		{
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$this->checkIdExit($data);
			$result = mysql_query("DELETE FROM salary WHERE employee_code = '".$data['id']."'");
			$count = mysql_affected_rows();
			if(!isset($result))
			{
				throw new Exception('delete salary no access');
			}
			$result = mysql_query("DELETE FROM employee WHERE id = '".$data['id']."'");
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

	public function insert($data,$colum,$colums)
	{
		$count = 0;
		try
		{
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

	public function update($data,$colum,$colums)
	{
		$count = 0;
		try
		{
			$this->calldbConnect();
			$this->checkIdExit($data,$colums);
			$sql = "update employee set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
			$result = mysql_query($sql);
			if(!isset($result))
			{
				throw new Exception('update no access');
			}
			$count = mysql_affected_rows();
			mysql_query('commit');
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->calldbClose();
		return $count;
	}

/////////////SELECT_BY_ID////////////

	public function selectById($data,$colum,$colums)
	{
		$row = 0;
		try
		{
			$this->calldbConnect();
			$this->checkIdExit();
			$result = mysql_query("SELECT * FROM employee WHERE id='".$data['id']."'");
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
///////////// VALIDATION  ////////////////
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
	
}





