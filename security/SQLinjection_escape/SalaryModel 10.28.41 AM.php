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
		foreach ($data as $key =>$value)
		{
			$data[$key] = mysql_real_escape_string($value);
		}
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
	}
////////////  INSERT  /////////////////////
	public function insert($data)
	{
/*		foreach ($data as $key =>$value)
		{
			$data[$key] = mysql_real_escape_string($value);
		}*/
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
		/*	$check = $this->checkIdExit($data['employee_code'], $colums);
			if($check == 0)
			{
				throw new Exception('employee_code no exit');
			}*/
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
			$sql = "INSERT INTO $colum (employee_code, year, month, payment, created, modified) VALUES (?,?,?,?,?,?) ";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param("ssssss",$data['employee_code'], $data['year'], $data['month'], $data['payment'] , date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
				$result->execute();
				$count = $result->insert_id;
				printf("id : %s----", $result->insert_id);
				if($count <1)
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
			$this->mysqli->autocommit(TRUE);
			$this->mysqli->prepare('begin');
	/*		$check =  $this->checkIdExit($data['id'], $colum);
			if($check == 0)
			{
				throw new Exception('id no exit');
			}
			$check = $this->checkIdExit($data['employee_code'],$colums);
			if($check == 0)
			{
				throw new Exception('employee_code no exit');
			}*/
			
			$sql = "UPDATE $colum SET employee_code=?, year=?, month=?,payment=?, modified=? where id = ?";
			if($result = $this->mysqli->prepare($sql))
			{
				$result->bind_param('ssssss',$data['employee_code'], $data['year'], $data['month'], $data['payment'], date("Y-m-d H:i:s"), $data['id']);
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
		//return $count;
	}
/////////////  SELECT ////////////////////////
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
			if($result = $this->mysqli->prepare("SELECT * FROM $colum WHERE id=?"))
			{
				$result->bind_param("i",$data['id']);
				$result->execute();
				$result->bind_result($data['id'], $data['employee_code'], $data['year'], $data['month'],$data['payment'],$data['created'],$data['modified']);
				while ($result->fetch())
				{
					printf("%s - %s - %s - %s -%s - %s - %s \n",$data['id'], $data['employee_code'], $data['year'], $data['month'],$data['payment'],$data['created'],$data['modified']);
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














