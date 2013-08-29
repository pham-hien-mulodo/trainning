<?php

class Employee implements iEntity
{
	public $state;
	public $id;
	public $name;
	public $title;
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
		if($this->state == 'update')
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
	}
}