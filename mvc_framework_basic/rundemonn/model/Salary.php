<?php
class Salary extends Validate
{
	public $state;
	public $id;
	public $employee_code;
//	public $year;
	public $month;
	public $sal;//payment
	public function __construct($data=array())
	{
		$this->data = $data;
		$this->state = $data['process'];
	}
	public function validate()
	{
		if($this->state == 'delete' || $this->state == 'selectById')
		{
			$result = $this->valid_int($this->data['id'], 1,11);
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
				'month' => $this->valid_month($this->data['month'])
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
				'month' => $this->valid_month($this->data['month'])
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
	
	
}