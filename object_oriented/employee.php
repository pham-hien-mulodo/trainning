<?php
class Employee{
	private $_id;
	private $_name;
	private $_title;
	private $_created;
	private $_modified;
	
	public function __construct($id, $name, $title, $created, $modified)
	{
		$this ->_id = $id;
		$this ->_name = $name;
		$this ->_title = $title;
		$this ->_created = $created;
		$this ->_modified = $modified;
	}
	protected function setpass($newpass)
	{
		$this->_id = $newid;
	}
	protected function setname($newname)
	{
		$this->_name = $newname;
	}
	protected function settitle($newtitle)
	{
		$this->_title = $newname;
	}
	public function getid()
	{
		return $this->_id;
	}
	protected function getname()
	{
		return $this->_name;
	}
	protected function gettitle()
	{
		return $this->_title;
	}
	public function getcreated()
	{
		date_default_timezone_set('Asia/Bangkok');
		return $created = date('Y-m-d H:i:s',time());
	}
	protected function getmodified()
	{
		date_default_timezone_set('Asia/Bangkok');
		return $modified = date('Y-m-d H:i:s',time());
	}
	public function get()
	{
		$result = array(
		'id' => $this->_id,
		'name' => $this->_name,
		'title' => $this->_title,
		'created' => $this->getcreated(),
		'modified' => $this->getmodified()
		);
		return $result;
	}
}

/////////////CLASS SALARY////////////

class Salary{
	private $_id;
	public $_employee_code;
	private $_year;
	private $_month;
	private $_payment;
	private $_created;
	private $_modified;
	
	public function __construct($id, $employee_code, $year, $month, $payment, $modified)
	{
		$this ->_id = $id;
		$this ->_employee_code = $employee_code;
		$this ->_year = $year;
		$this ->_month = $month;
		$this ->_payment = $payment;
		$this ->_created = $created;
		$this ->_modified = $modified;
	}
	protected function setpass($newpass)
	{
		$this->_id = $newid;
	}
	protected function setE_C($newE_C)
	{
		$this->_employee_code = $newE_C;
	}
	protected function setyear($newyear)
	{
		$this->_year = $newyear;
	}
	protected function setmonth($newmonth)
	{
		$this->_month = $newmonth;
	}
	protected function setpayment($newpay)
	{
		$this->_payment = $newpay;
	}
	protected function getpass($password)
	{
		return $password;
	}
	public function getid()
	{
		return $this->_id;
	}
	public function getE_C($employee_code)
	{
		return $employee_code;
	}
	protected function getyear($year)
	{
		return $year;
	}
	protected function getmonth($month)
	{
		return $month;
	}
	protected function getpayment($payment)
	{
	return $payment;
	}
	public function getcreated()
	{
		date_default_timezone_set('Asia/Bangkok');
		return $created = date('Y-m-d H:i:s',time());
	}
	protected function getmodified()
	{
		date_default_timezone_set('Asia/Bangkok');
		return $modified = date('Y-m-d H:i:s',time());
	}
	public function get()
	{
		$result = array(
		'id' => $this->_id,
		'employee_code' => $this->_employee_code,
		'year'=> $this->_year,
		'month' => $this->_month,
		'payment' => $this->_payment,
		'created' => $this->getcreated(),
		'modified' => $this->getmodified()
		);
		return $result;
	}
	public function validation($data,$process)
	{
		if($process=='delete')
		{
			$result = $this->valid_int($data['id'], 1,11);
			if($result == 1)
			{
				return 1;
				}
			else return 0;
		}
		if($process == 'update')
		{
				$result = array(
				'id' => $this->valid_int($data['id'], 1,11),
				'name' => $this->valid_string($data['name'], 1,20),
				'title' => $this->valid_string($data['title'], 1,15),
				'modified' => $this->valid_date($data['modified'])
				);
				foreach($result as $result1)
				{
					if($result1 == 0)
					{
						return 0;
					}
				}
				return 1;
		}
		if($process == 'insert')
		{
			$result = array(
			'created' => $this->valid_date($data['created']),
			'name' => $this->valid_string($data['name'], 1,20),
			'title' => $this->valid_string($data['title'], 1,15),
			'modified' => $this->valid_date($data['modified'])
			);
			foreach($result as $result1)
			{
				if($result1 == 0)
				{
					return 0;
				}
			}
			return 1;
		}
	}
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

	public function data()
	{
		$hostname = "localhost";
		$username = "root";
		$password = "";
		$database = "php_basics";
		try
		{
			$dbcon = mysql_connect($hostname, $username, $password);
			if($dbcon == false)
			{
				throw new Exception('no connect');
			}
			$selected = mysql_select_db($database, $dbcon);
			if($selected ==false)
			{
				throw new Exception('no name data');
			}
			if($selected == true)
			{ echo 'access';}
			mysql_close($dbcon);
		}
		catch(Exception $e)
		{
			echo $e->getmessage();
		}
	}
}

$employ = new Employee(2, 'hien 1', 'admin');
$salary = new Salary(2, 1, 2013, '08',10000);
//print_r($employ);
//print_r($salary);
print_r($employ->get());
print_r($salary->get());
echo $employ->getid();
echo "\n";
echo $salary->getid();
echo "\n";
echo $salary->getcreated();
echo "\n";
echo $employ->getcreated();
echo "\n";
	/*
	protected function __destruct()
	{
		echo " doi tuong bi huy bo :";
	}
	
	protected function __isset($id)
	{
		echo " kiem tra su ton tai cua id ";
		if($id == 1)
		{
			return true;
		}
		return false;
	}//$id == '".$employee['id']."'
	
	protected function __get($id)
	{
		if($id == 10)
		{
			return 10;
		}
		return -1;
	}
	
	protected function __isset($name)
	{
		if($name == 'admin')
			return true;
		return false;
	}
	
	public function __get($name)
	{
		if($name == 'admin')
			return 'pham hien';
		return 'khong co';
	}
	
	protected function __unset($name)
	{
		echo " ban vua huy thuoc tinh $name \n";
	}

}


*/





