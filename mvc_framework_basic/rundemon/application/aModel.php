<?php
require_once(__SITE_PATH.'/model/implement.php');
abstract class aModel
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'php_basics';
	protected $mysqli;
	protected static $instance;
	function __construct()
	{
	}
	public static function getInstance()
	{
		if(!seft::$instance)
		{
			self::$instance = new aModel();
		}
		return self::$instance;
	}
	public function get($name)
	{
		$file = __SITE_PATH.'/model/'.str_replace("model","",strtolower($name))."Model.php";
		if(file_exists($file))
		{
			include ($file);
			$class = str_replace("model","",strtolower($name))."Model";
			return new $class;
		}
		return null;
	}
	
	
//	protected $validate = null;

	protected function calldbConnect()
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
	protected function checkIdExit($data, $column)
	{
		try{
		if($result = $this->mysqli->prepare("select count(id) as id from $column where id = ? "))
		{
			$result -> bind_param('i', $data);
			$result->execute();
			$result->bind_result($data);
			if($result->execute())
			{
				while ($result->fetch()) {
					if($data <= 0)
					throw new Exception('id no exit');
				}
				return true;

			}
			else{ 
				throw new Exception('The query execute fail');
			}
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
	abstract public function  select_all();
	function __destruct()
		{
		}
}




