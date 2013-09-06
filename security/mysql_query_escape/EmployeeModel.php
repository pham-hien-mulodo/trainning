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
			
			if(!$result)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			
			$check = $this->checkIdExit($data['id'],$colums);
			if($check<1)
			{
				//echo "id no exit";
				throw new Exception('id no exit');
			}
			foreach ($data as $key =>$value)
			{
				$data[$key] = $this->mysqli->real_escape_string($value);
			}
			if(!$result = $this->mysqli->query("SELECT * FROM $colum WHERE employee_code = '".$data['id']."'"))
			{
				throw new Exception('select salary no access');
			}
			$count = $this->mysqli->affected_rows;
			if($count >0)
			{
			//	echo "id is employee_code in salary";
				return $count = 0 ;
			}
		/*	$result = mysql_query("DELETE FROM $colum WHERE employee_code = '".$data['id']."'");
			if(!$result)
			{
				throw new Exception('delete salary no access');
			}*/
			$count = mysql_affected_rows();
			$result = $this->mysqli->query("DELETE FROM $colums WHERE id = '".$data['id']."'");
			if(!$result)
			{
				throw new Exception('delete employee no access');
			}
			$count = $this->mysqli->affected_rows;
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
			
			foreach ($data as $key =>$value)
			{//if(get_magic_quotes_gpc()) $data[$key]=stripslashes($value);
				$data[$key] = $this->mysqli->real_escape_string($value);
			}
			$sql = "INSERT INTO $colums (name , title, created, modified) VALUES ('".$data['name']."','".$data['title']."' , '".$data['created']."', '".$data['modified']."')";
			if(!$result = $this->mysqli->query($sql))
			{
				throw new Exception('insert employee no access');
			}
			$count = $this->mysqli->insert_id;
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
			foreach ($data as $key =>$value)
			{
				$data[$key] = $this->mysqli->real_escape_string($value);
			}
			$sql = "update $colums set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
			if(!$result = $this->mysqli->query($sql))
			{
				throw new Exception('update employee no access');
			}
	//		printf("Affected rows (UPDATE): %d\n",$this->mysqli->affected_rows);
			$count = $this->mysqli->affected_rows;
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
		$em = new Employee($data);
		$colum = $data['colum'];
		$colums = $data['colums'];
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
			$check = $this->checkIdExit($data['id'],$colum);
		//	print_r($check);
			if(!$check)
			{
				throw new Exception('id no exit');
			}
			foreach ($data as $key =>$value)
			{
				$data[$key] = $this->mysqli->real_escape_string($value);
			}
			if(!$result = $this->mysqli->query("SELECT * FROM $colums WHERE id='".$data['id']."'"))
			{
				throw new Exception('select employee no access');
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





