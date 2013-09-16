<?php
require_once('interface.php');
require_once('Salary.php');
require_once('abstractModel.php');
class SalaryModel extends aModel
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
	
///////////////// DELETE //////////////////
	public function delete($data)
	{
		$sa = new Salary($data);
		$colum = $data['colum'];
		$colums = $data['colums'];
		$count = 0;
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
			if(!isset($check))
			{
				throw new Exception('check id error');
			}
			
	/*		foreach ($data as $key =>$value)
			{
				$data[$key] = htmlspecialchars($this->mysqli->real_escape_string($value));
			}*/
			$sql = "DELETE FROM $colum WHERE id = '".$data['id']."' ";
			if(!$result = $this->mysqli->query($sql))
			{
				throw new Exception('delete salary no access');
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
////////////  INSERT  /////////////////////
	public function insert($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$sa = new Salary($data);
		$count = 0;
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
			if($check == 0)
			{
				throw new Exception('employee_code no exit');
			}
			foreach ($data as $key =>$value)
			{
				$data[$key] = htmlspeciachars($this->mysqli->real_escape_string($value));
			}
			$sql = "INSERT INTO $colum (employee_code, year, month, payment, created, modified) VALUES ('".$data['employee_code']."', '".$data['year']."', '".$data['month']."', '".$data['payment']."', '".$data['created']."', '".$data['modified']."' ) ";
			if(!$result = $this->mysqli->query($sql))
			{
				throw new Exception('insert salary no access');
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

	public function update($data)
	{
		$colum = $data['colum'];
		$colums = $data['colums'];
		$sa = new Salary($data);
		$count = 0;
		try
		{
			
			$this->calldbConnect();
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$result = $sa->validate($data);
			if(!$result)
			{
				throw new Exception('valid ko dung dinh dang');
			}
			$check =  $this->checkIdExit($data['id'], $colum);
			if(!isset($check))
			{
				throw new Exception('check id error');
			}
			$check = $this->checkIdExit($data['employee_code'],$colums);
			if(!$check)
			{
				throw new Exception('check employee_code error ');
			}
			
			foreach ($data as $key =>$value)
			{
				$data[$key] = htmlspecialchars($this->mysqli->real_escape_string($value));
			}
			$sql = "UPDATE $colum SET employee_code= '".$data['employee_code']."', year= '".$data['year']."', month= '".$data['month']."',payment= '".$data['payment']."', modified= '".$data['modified']."' where id = '".$data['id']."'";
			if(!$result = $this->mysqli->query($sql))
			{
				throw new Exception('update salary no access');
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
/////////////  SELECT ////////////////////////
	public function selectById($data)
	{
		$sa = new Salary($data);
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
			
			foreach ($data as $key =>$value)
			{
				$data[$key] = $this->mysqli->real_escape_string($value);
			}
			$result = $this->mysqli->query("SELECT * FROM $colum WHERE id= '".$data['id']."'");
			if(!$result)
			{
				throw new Exception('select salary no access');
			}
			$result = $result->fetch_array(MYSQLI_ASSOC);
			foreach ($result as $key => $value)
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
	public function select_all()
	{
		$this->calldbConnect();
		$this->mysqli->autocommit(TRUE);
		$this->mysqli->prepare('begin');
		$result = $this->mysqli->query("SELECT * FROM salary");
		if(!isset($result)){ echo "eror";}
		while($row = $result->fetch_array()){  
			$data[] = $row;
		}
		$this->mysqli->close();
		return $data;
		

	}
}














