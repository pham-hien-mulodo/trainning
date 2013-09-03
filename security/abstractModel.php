<?php
require_once('interface.php');
abstract class aModel
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'php_basics';
	private $mysqli;
//	protected $validate = null;

	protected function dbConnect()
	{
		try
		{
			$this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbname);//mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
	
	}
	protected function dbClose()
	{
		$this->mysqli->close();
	}
	protected function checkId($data, $colum)
	{
		try{
		$this->dbConnect();
		$result = $this->mysqli->prepare("select count(id) as id from $colum where id = ? ");
		$result -> bind_param('i', $data);
		$result->execute();
	//	$stmt = array($result);
		$test = $result->affected_rows;
	//	$test = mysqli_fetch_assoc($result);
		if($test['id'] != 1)
		{
			throw new Exception('id no exit');
		}else{ return true;}
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$result->close();
		$this->dbClose();
	}
	abstract public function insert($data);
	abstract public function update( $data);
	abstract public function delete($data);
	abstract public function selectById($data);
	
	
}



