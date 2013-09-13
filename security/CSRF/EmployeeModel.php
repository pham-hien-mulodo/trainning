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
			$check = $this->checktoken($data);
			if($check <= 0)
			{
				throw new Exception('token no match');
			}
			foreach ($data as $key =>$value)
			{
				$data[$key] = htmlspecialchars($this->mysqli->real_escape_string($value));
			}
			if(!$result = $this->mysqli->query("SELECT * FROM $colum WHERE employee_code = '".$data['id']."'"))
			{
				throw new Exception('select salary no access');
			}
			$count = $this->mysqli->affected_rows;
			echo $count;
			echo "--";
			while($count >0)
			{
				$result = $this->mysqli->query("DELETE FROM $colum WHERE employee_code = '".$data['id']."'");
				if(!$result)
				{
					throw new Exception('delete salary no access');
				}
				$count = $this->mysqli->affected_rows;
			}
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
		$em = new Employee($data);
		$count = null;
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
			
			foreach ($data as $key =>$value)
			{
				$data[$key] = htmlspecialchars($this->mysqli->real_escape_string($value));
			}
	//		var_dump($data);
			$sql = "INSERT INTO $colums (name , title,token, created, modified) VALUES ('".$data['name']."','".$data['title']."' , '".$data['token']."','".$data['created']."', '".$data['modified']."')";
			var_dump($sql);
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
			var_dump($data);
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
			$check = $this->checktoken($data);
			if($check <= 0)
			{
				throw new Exception('token no match');
			}
			foreach ($data as $key =>$value)
			{
				$data[$key] = htmlspecialchars($this->mysqli->real_escape_string($value));
			}
			$sql = "update $colums set name = '".$data['name']."', title = '".$data['title']."' , modified = '".$data['modified']."' where id = '".$data['id']."'";
			if(!$result = $this->mysqli->query($sql))
			{
				throw new Exception('update employee no access');
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
			$check = $this->checkIdExit($data['id'],$colums);
			if($check <= 0)
			{
				throw new Exception('id no exit');
			}
		/*	$check = $this->checktoken($data);
			if($check <= 0)
			{
				throw new Exception('token no match');
			}*/
			foreach ($data as $key =>$value)
			{
				$data[$key] = $this->mysqli->real_escape_string($value);
			}
			$result = $this->mysqli->query("SELECT * FROM $colums WHERE id='".$data['id']."'");
			if(!$result)
			{
				throw new Exception('select employee no access');
			}
			$result = $result->fetch_array(MYSQLI_ASSOC);
			foreach ($result as $key =>$value)
			{
				$result[$key] = htmlspecialchars($value);
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
	public function checktoken($data)
	{
		$colums= $data['colums'];
	//	$em = new Employee($data);
		$this->calldbConnect();
		$this->mysqli->autocommit(TRUE);
		$this->mysqli->prepare('begin');
		$colums= $data['colums']; 
		
		$result = $this->mysqli->query("SELECT token FROM $colums WHERE id='".$data['id']."'");
		$result = $result->fetch_array(MYSQLI_ASSOC);
		if($result['token'] == $data['token'])
		{
			$token = sha1(uniqid(rand(),TRUE));
			$result = $this->mysqli->query("UPDATE $colums SET token = '".$token."' WHERE id = '".$data['id']."' ");
			if($result){ return 1;}
		}
		else return 0;
		
		$this->mysqli->close();
		
	}
	public function create_token($data)
	{
		$this->calldbConnect();
		$this->mysqli->autocommit(TRUE);
		$this->mysqli->prepare('begin');
		$colums= $data['colums'];
		$token = sha1(uniqid(rand(),TRUE));
		echo $token;
		$result = $this->mysqli->query("UPDATE $colums SET token = '".$token."' WHERE id = '".$data['id']."' ");
		if($result)
		{
			return true;
		}else return false;
	}
}






















