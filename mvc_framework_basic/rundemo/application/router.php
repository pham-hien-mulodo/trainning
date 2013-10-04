<?php
class router 
{
	private $registry;
	private $path;
	private $args = array();
	public $file;
	public $controller;
	public $action;
	function __construct($registry)
	{
		$this->registry = $registry;
	}
	
	function setPath($path)
	{
		if(is_dir($path) == false)
		{
			throw new Exception('invalid controller path :'.$path);
		}
		$this->path = $path;
	}
	
	public function loader()
	{
		$this->getController();
	
		if(is_readable($this->file) == false)
		{
			$this->file = $this->path.'/error404.php';
			$this->controller = 'error404';
		}

		include $this->file;
		$class = $this->controller.'Controller';
		$controller = new $class($this->registry);
		if(is_callable(array($controller, $this->action))==false)
		{
			$action = 'index';
		}
		else
		{
			$action = $this->action;
		}
		$controller->$action();
	}
	private function getController(&$file, &$controller, &$action, &$args)
	{
		$router = (empty($_GET['rt']))?'': $_GET['rt'];

		if(empty($router))
		{
			$router = 'index';
		}
		else 
		{
			$rt = trim($rt, '/\\');
			$parts = explode('/',$router);
			$this->controller = $parts[0];
			if(isset($parts[1]))
			{
				$this->action = $parts[1];
			}
		}
		if(empty($this->controller))
		{
			$this->controller = 'index';
		}

		$this->file = $this->path.'/'.$this->controller.'Controller.php';
	}
}

