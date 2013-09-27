<?php 
class template
{
	private $registry;
	private $vars = array();
	function __contruct($registry)
	{
		$this->registry = $registry;
	}
	public function __set($index, $value)
	{
		$this->vars[$index] = $value;
	}
	function show($name)
	{
		$path = __SITE_PATH . '/views'.'/'.$name.'.php';
		if(file_exists($path) == false)
		{
			throw new Exception('Template not found in '.$path);
			return false;
		}
		foreach ($this->vars as $key=>$value)
		{
			$key = $value;
		}
		include($path);
	}
}
?>