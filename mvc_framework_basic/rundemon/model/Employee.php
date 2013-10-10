<?php
require_once ('implement.php');
class Employee extends Validate
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
	
}