<?php
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
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$result = $mysqli->prepare("DELETE FROM $colum WHERE employee_code = ?");
			$result->bind_param('i',$data['id']);
			$result->execute();
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
		$result->close();
		$this->close();
		return $count;
	}// kiem tra id ton tai: check_id_exit()

//////////////INSERT////////////////

	public function insert($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$this->calldbConnect();
			mysql_query('set autocommit = 0');
			mysql_query('begin');
			$sql = "INSERT INTO employee (name , title, created, modified) VALUES (?,?,?,?)";//('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
			$result= $mysqli->prepare($sql);
			$result->param('ssss',$data['name'],$data['title'],$data['created'],$data['modified']);
			$result->execute();
			if(!isset($result))
			{
				throw new Exception('insert no access');
			}
			$count = mysql_insert_id();
			//echo $count;
	//		mysql_query('commit');
			
		} catch(Exception $e)
		{
	//		mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$result->close();
		$this->close();
		return $count;
	}

/////////////UPDATE/////////////////

	public function update( $data)
	{
		
		$count = 0;
		try
		{
			if(!$data->validate())
			{
				throw new Exception('valid ko dung dinh dang - ');
			}
			$this->calldbConnect();
			$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$sql = "update employee set name = ?, title = ? , modified = ? where id = ?";
			$result= $mysqli->prepare($sql);
			$result->param('sssi',$data['name'],$data['title'],$data['modified'],$data['id']);
			$result->execute();
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
			echo 'Error happened in the process. Please try again.';
		}
		$result->close();
		$this->close();
		return $count;
	}

/////////////SELECT_BY_ID////////////

	public function selectById($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$row = 0;
		try
		{
			$this->calldbConnect();
			$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$result = mysql_query("SELECT * FROM $colums WHERE id=?");
			$result->param('i',$data['id']);
			$result->execute();
			if(!isset($result))
			{
				throw new Exception('select by id no access');
			}
	//		$row = mysql_fetch_array($result, MYSQL_ASSOC);
			$result->close();
			$this->close();
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





