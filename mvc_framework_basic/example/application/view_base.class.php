<?php
class baseView
{
	public $data = array();
	private static $instance;
	function __construct()
	{
		
	}
	public static function getInstance()
	{
		if(!self::$instance)
		{
			self::$instance = new baseView();
		}
		return self::$instance;
	}
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}
	function show($name)
	{
		$path = __SITE_PATH.'/views'.'/'.$name.'.php';
		if(file_exists($path) == false)
		{
			throw new Exception('template not found in '.$path);
			return false;
		}
	}
	foreach ($this->data as $key =>$value)
	{
		$$key = $value;
	}
	include($path);
}