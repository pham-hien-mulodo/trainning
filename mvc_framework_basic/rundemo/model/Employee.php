<?php
require_once ('interface.php');
class Employee implements iEntity
{
	public $state;
	public $id;
	public $name;
	public $title;
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
			'created' => $this->valid_date($this->data['created']),
			'name' => $this->valid_string($this->data['name'], 1,50),
			'title' => $this->valid_string($this->data['title'], 1,50),
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
		if($this->state == 'update')
		{
			$result = array(
			//	'id' => $this->valid_int($this->data['id'], 1,11),
				'name' => $this->valid_string($this->data['name'], 1,50),
				'title' => $this->valid_string($this->data['title'], 1,50),
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
	public function valid_string($data, $minlength, $maxleng)
	{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_string($data))
				{
					return true;
				}
			}
		}
		return false;
	}
	public function valid_date(&$data)
	{
		$daty = trim($data);
		if(!empty($daty))
		{
			if(preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/",$data,$matches))
			{
				if(checkdate($matches[2], $matches[3], $matches[1]))
				{
				return true;
				}
			}
		}
		return false;
	}
	public function valid_int($data, $minlength, $maxleng)
	{
		$daty=trim($data);
		if(!empty($daty))
		{
			if(strlen($data)>= $minlength && strlen($data)<=$maxleng)
			{
				if(is_int($data))
				{
					return true;
				}
			}
		}
		return false;
	}
}