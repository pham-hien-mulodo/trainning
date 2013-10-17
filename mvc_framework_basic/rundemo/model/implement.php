<?php
require_once(__SITE_PATH.'/model/Employee.php');
require_once(__SITE_PATH.'/model/Salary.php');
interface iEntity
{
	public function Validate();
}