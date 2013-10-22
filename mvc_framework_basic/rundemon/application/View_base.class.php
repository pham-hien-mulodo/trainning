<?php
require_once(__SITE_PATH."/application/salaryView.php");
require_once(__SITE_PATH."/application/employeeView.php");
abstract class baseView {

protected $vars = array();
public function __set($data, $value)
{
	$this->vars[$data] = $value;
}
 abstract public function show($process);
 }

