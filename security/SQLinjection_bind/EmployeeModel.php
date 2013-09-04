<?php
require_once('Employee.php');
require_once('abstractModel.php');
class EmployeeModel extends aModel
{
//	private $mysqli;
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
			$mysqli->prepare('set autocommit = 0');
			$mysqli->prepare('begin');
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
			$mysqli->commit();
		} catch(Exception $e)
		{
			$mysqli->rollback();
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$result->close();
		$this->close();
		return $count;
		
		
		
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$this->calldbConnect();
		/*	$check = $this->checkIdExit($data['id'],$colum);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			*/
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$sql = "DELETE FROM $colum WHERE id = ? ";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param('i',$data['id']);
				$result->execute();
				mysqli_stmt_store_result($result);
				$sa = $result->affected_rows;
				if($sa < 1)
				{
					throw new Exception('delete salary no access');
				}
				$result->close();
			}
			$this->mysqli->commit();
			$count = $sa;
		} catch(Exception $e)
		{
			$this->mysqli->rollback();
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->mysqli->close();
		return $count;
	}// kiem tra id ton tai: check_id_exit()

//////////////INSERT////////////////

	public function insert($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$sa = new Salary($data);
		$count = null;
		try
		{
			$result = $sa->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$this->calldbConnect();
		/*	$check = $this->checkIdExit($data['employee_code'], $colums);
			if($check == 0)
			{
				throw new Exception('employee_code no exit');
			}*/
			$sql = "INSERT INTO $colums (name , title, created, modified) VALUES (?,?,?,?)";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param('ssss',$data['name'],$data['title'],$data['created'],$data['modified']);
				$result->execute();
				$count = $result->insert_id;
		//		printf("id : %s----", $result->insert_id);
				if(!isset($count))
				{
					throw new Exception('insert salary no access');
				}
				$result->close();
			}
			$this->mysqli->commit();
		} catch(Exception $e)
		{
			$this->mysqli->rollback();
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->mysqli->close();
		return $count;
	}

/////////////UPDATE/////////////////

	public function update( $data)
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
	/*		$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			*/
			$sql = "update employee set name = ?, title = ? , modified = ? where id = ?";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param('ssss',$data['name'],$data['title'],$data['modified'],$data['id']);
				$result->execute();
				printf(" rows: %s -- ",$result->affected_rows);
				$count = $result->affected_rows;
				if($count < 1)
				{
					throw new Exception('update salary no access');
				}
				
				$result->close();
			}
			$this->mysqli->commit();
		} catch(Exception $e)
		{
			$this->mysqli->rollback();
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		
		$this->mysqli->close();
		return $count;
	}

/////////////SELECT_BY_ID////////////

	public function selectById($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		try
		{
			$this->calldbConnect();
	/*		$check = $this->checkIdExit($data['id'],$colum);
			print_r($check);
			if($check == 0)
			{
				throw new Exception('id no exit');
			} 
			*/
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			if($result = $this->mysqli->prepare("SELECT * FROM $colums WHERE id=?"))
			{
				$result->bind_param("i",$data['id']);
				$result->execute();
				$result->bind_result($data['id'], $data['name'], $data['title'],$data['created'],$data['modified']);
				while ($result->fetch())
				{
					
					printf("%s - %s - %s - %s -%s- \n",$data['id'], $data['name'], $data['title'],$data['created'],$data['modified']);
				}
				$result->close();
			}
			$this->mysqli->commit();
		} catch(Exception $e)
		{
			$this->mysqli->rollback();
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->mysqli->close();
		return $result;
	}

}





