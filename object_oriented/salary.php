<?php
//require_once('abstractModel.php');
class Salary implements iEntity
{
	public $state;
	public $id;
	public $employee_code;
	public $year;
	public $month;
	public $sal;//payment
	public function __construct($data=array())
	{
		$this->data = $data;
		$this->state = $data['process'];
	//	$this->id = $data['id'];
	//	$this->employee_code = $data['employee_code'];
	//	$this->year = $data['year'];
	//	$this->month = $data['month'];
	//	$this->sal = $data['payment'];
	}
	public function validate()
	{
		if($this->state == 'delete' || $this->state == 'selectById')
		{
			$result = $this->valid_int($data['id'], 1,11);
			if($result == 1)
			{
				return 1;
				}
			else return 0;
		}
		if($this->state=='insert')
		{
			$result = array(
				'employee_code' => $this->valid_int($this->data['employee_code'], 1,11),
				'payment' => $this->valid_int($this->data['payment'], 1,11),
				'year' => $this->valid_int($this->data['year'],4,4),
				'month' => $this->valid_month($this->data['month']),
				'modified' => $this->valid_date($this->data['modified']),
				'created' => $this->valid_date($this->data['created'])
			);
		//	print_r($result);
			foreach($result as $result1)
			{
				if($result1 == 0)
				{
					return 0;
				}
			}
			return 1;
		}
		if($this->state == 'update')
		{

				$result = array(
				'id' => $this->valid_int($this->data['id'], 1,11),
				'employee_code' => $this->valid_int($this->data['employee_code'], 1,11),
				'payment' => $this->valid_int($this->data['payment'], 1,11),
				'year' => $this->valid_int($this->data['year'], 4,4),
				'month' => $this->valid_month($this->data['month'], 1,2),
				'modified' => $this->valid_date($this->data['modified'])
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
	public function valid_month($data)
	{
			if(preg_match("/^([1-9]|1[0-2])$/",$data))
			{
				return true;
			}
		return false;
	}
	public function valid_string($data, $minlength, $maxleng)
	{
	// 	try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_string($data))
				{
					return true;
				}//else { throw new Exception('data type string false'); return false;}
			}//else { throw new Exception('string length false'); return false;}
		}//else { throw new Exception('string empty'); return flase;}
	//	} catch(Exception $e)
	//	{
	//		$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	//		echo $error;
	//		print_r($e->getTrace());
	//		echo 'Error happened in the process. Please try again.';
	//	}
		return false;
	}
	public function valid_date(&$data)
	{
	//	try{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data,$matches))
			{
				if(checkdate($matches[2], $matches[3], $matches[1]))
				{
				return true;
				}//else { throw new Exception('date no exit'); return false;}
			}//else { throw new Exception('format date false'); return false;}
		}//else { throw new Exception('date empty'); return false;}
	//	} catch(Exception $e)
	//	{
	//		echo $e->getmessage();
	//	}
		return false;
	}
	public function valid_int($data, $minlength, $maxleng)
	{		
	//	try{
		$daty=trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_int($data))
				{
					return true;
				}
			//	else
			//	{
			//		throw new Exception('data no type int');
			//	}
			}
		//	else
		//	{
		//		throw new Exception('int length false');
		//	}
		}
	//	} catch(Exception $e)
	//	{
	//		$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
	//		echo $error;
	//		print_r($e->getTrace());
	//		echo 'Error happened in the process. Please try again.';
	//	}

		return false;
	}
}