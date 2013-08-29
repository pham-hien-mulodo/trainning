<?php
abstract class aModel
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = '';
	private $dbname = 'php_basics';
	
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
	public function checkIdExit($data, $colum)
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
	abstract public function insert($data,$colum,$colums);
	abstract public function update($data,$colum,$colums);
	abstract public function delete($data,$colum,$colums);
	abstract public function selectById($id,$colum,$colums);
	public function valid_string($data, $minlength, $maxleng)
	{
		try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_string($data))
				{
					return true;
				}else { throw new Exception('data type string false'); return false;}
			}else { throw new Exception('string length false'); return false;}
		}else { throw new Exception('string empty'); return flase;}
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
	}
	public function valid_date(&$data)
	{
		try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data,$matches))
			{
				if(checkdate($matches[2], $matches[3], $matches[1]))
				{
				return true;
				}else { throw new Exception('date no exit'); return false;}
			}else { throw new Exception('format date false'); return false;}
		}else { throw new Exception('date empty'); return false;}
		} catch(Exception $e)
		{
			echo $e->getmessage();
		}
		return false;
	}
	public function valid_int($data, $minlength, $maxleng)
	{
		try{
		$daty=trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_int($data))
				{
					return true;
				}
				else
				{
					throw new Exception('data no type int');
				}
			}else
			{
				throw new Exception('int length false');
			}
		}
		} catch(Exception $e)
		{
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return false;
	}
	
}



