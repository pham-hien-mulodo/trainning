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
		
		$em = new Employee($data);
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
		try
		{
			$this->calldbConnect();
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$result = $em->validate($data);
			
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			
			$check = $this->checkIdExit($data['id'],$colums);
			if(!isset($check))
			{
				throw new Exception('check id no access');
			}
			
			$data = array_map("mysql_real_escape_string", $data);
			$sql = "DELETE FROM $colums WHERE id = ? ";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param('i',$data['id']);
				$result->execute();
				mysqli_stmt_store_result($result);
				$sa = $result->affected_rows;
				if($sa < 1)
				{
					throw new Exception('delete employee no access');
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
			$this->calldbConnect();
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$result = $sa->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			
			$check = $this->checkIdExit($data['employee_code'], $colums);
			if(!isset($check))
			{
				throw new Exception('employee_code no exit');
			}
			
			$data = array_map("mysql_real_escape_string", $data);
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
		$em = new Employee($data);
		$count = 0;
		try
		{
			$this->calldbConnect();
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$result = $em->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			
			$check = $this->checkIdExit($data['id'],$colums);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			
			
			$data = array_map("mysql_real_escape_string", $data);
			$sql = "update $colums set name = ?, title = ? , modified = ? where id = ?";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param('ssss',$data['name'],$data['title'],$data['modified'],$data['id']);
				$result->execute();
			//	printf(" rows: %s -- ",$result->affected_rows);
				$count = $result->affected_rows;
				if($count < 1)
				{
					throw new Exception('update employee no access');
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
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$result = $sa->validate($data);
			if($result==0)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			
			$check = $this->checkIdExit($data['id'],$colum);
			print_r($check);
			if($check == 0)
			{
				throw new Exception('id no exit');
			} 
			$data = array_map("mysql_real_escape_string", $data);
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





