<?php
require_once(__SITE_PATH.'/model/Employee.php');
require_once(__SITE_PATH.'/model/Salary.php');
abstract class Validate
{
	protected $process;
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
	public function valid_month($data)
	{
			if(preg_match("/^([1-9]|1[0-2])$/",$data))
			{
				return 1;
			}
		return 0;
	}
}