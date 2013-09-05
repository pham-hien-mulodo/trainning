<?php
require_once('interface.php');
abstract class aModel
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'php_basics';
	protected $mysqli;
//	protected $validate = null;

	protected function dbConnect()
	{
		
		try
		{
			$this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbname);
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			mysqli_set_charset($this->mysqli,'utf8');
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
	
	}
	protected function dbClose()
	{
		$result = $this->mysqli->close();
		if($result)
		{
			return true;
		}
	}
	protected function checkId($data, $colum)
	{
		try{
		if($result = $this->mysqli->prepare("select count(id) as id from $colum where id = ? "))
		{
			$result -> bind_param('i', $data);
			$result->execute();

			if($result->execute())
			{
				throw new Exception('id no exit');
			}else{ return true;}
		}
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
	}
	abstract public function insert($data);
	abstract public function update($data);
	abstract public function delete($data);
	abstract public function selectById($data);
	
	
}



