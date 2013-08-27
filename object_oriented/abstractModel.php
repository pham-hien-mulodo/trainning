<?php
class AbstractModel
{
	private $_host;
	private $_user;
	private $_pass;
	private $_dbname;
	public function __construct($hostname, $username, $password, $database)
	{
		$this->_host = $hostname;
		$this->_user = $username;
		$this->_pass = $password;
		$this->_dbname = $database;
	}
	public function dbConnect()
	{
		try
		{
			$dbcon = mysql_connect($this->_host, $this->_user, $this->_pass);
			if($dbcon == false)
			{
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($this->_dbname, $dbcon);
			if($selected ==false)
			{
				throw new Exception('no name data');
			}
			if($selected == true)
			{ echo 'access';}
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			mysql_query('rollback');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
	
	}
	protected function dbClose()
	{
		mysql_close($this->dbConnect());
	}
}
$ab = new AbstractModel("localhost", "root","", "php_basics");
echo $ab->dbConnect();




