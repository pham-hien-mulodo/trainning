<?php
abstract class aModel
{
	private $host = 'hostname';
	private $user = 'username';
	private $password = 'password';
	private $dbname = 'database';
	
	protected function dbConnect()
	{
		try
		{
			$dbcon = mysql_connect($this->host, $this->user, $this->password);
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
	abstract protected function checkIdExit($id)
	{
	}
	abstract public function insert($data)
	{
	}
	abstract public function update($data)
	{
	}
	abstract public function delete($id)
	{
	}
	abstract public function selectById($id)
	{
	}
	protected function valid_string($data, $minlength, $maxleng)
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
	protected function valid_date(&$data)
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
	protected function valid_int($data, $minlength, $maxleng)
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



