<?php
/*
Abstract class aModel
{
	protected $registry;
	protected $model;
	function __construct($registry)
	{
		$this->registry = $registry;
		
	}
}
*/
class baseModel 
{
	private static $instance;
	function __construct()
	{
	}
	public static function getInstance()
	{
		if(!seft::$instance)
		{
			self::$instance = new baseModel();
		}
		return self::$instance;
	}
	public function get($name)
	{
		$file = __SITE_PATH.'/model/'.str_replace("model","",strtolower($name))."Model.php";
		if(file_exists($file))
		{
			include ($file);
			$class = str_replace("model","",strtolower($name))."Model";
			return new $class;
		}
		return null;
	}
	function __destruct()
		{
		}
}
