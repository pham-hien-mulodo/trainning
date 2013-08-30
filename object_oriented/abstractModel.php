<?php
require_once('interface.php');
abstract class aModel
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'php_basics';
	protected $validate = null;

	protected function dbConnect()
	{
		try
		{
			$dbcon = mysql_connect($this->host, $this->user, $this->password);
			if($dbcon == false)
			{
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($this->dbname, $dbcon);
			if($selected ==false)
			{
				throw new Exception('no name data');
			}
			if($selected == true)
			{ return true; }
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
		mysql_close();
	}
	protected function checkId($data, $colum)
	{
		try{
		$this->dbConnect();
		$result = mysql_query("select count(id) as id from $colum where id = $data");
		$test = mysql_fetch_assoc($result);
		if($test['id'] != 1)
		{
			throw new Exception('id no exit');
			return false;
		}else return true;
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		$this->dbClose();
	}
	abstract public function insert($data);
	abstract public function update( $data);
	abstract public function delete($data);
	abstract public function selectById($data);
	
	
}



