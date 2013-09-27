<?php 
class router 
{
	private $registry;
	private $path;
	private $args = array();
	public $file;
	public $controller;
	public $action;
	function __contruct($registry)
	{
		$this->registry = $registry;
	}
	function setPath($path)
	{
		if(is_dir($path)==false)
		{
			throw new Exception ('Invalid controller path: ');
		}
		$this->path = $path;
	}
	public function loader()
	{
		$this->getController();
		if(is_readable($this->file)==false)
		{
			$this->file = $this->path.'/error404.php';
			$this->controller = 'error404';
			
		}
		include $this->file;
		$class = $this->controller.'Controller';
		$controller = new $class_$this->action)) == false)
		{
			$action = 'index';
		}
		else
		{
			$action = $this->action;
		}
		$controller->$action();
		
	}
	private function getController()
	{
		$route = (empty($_GET['rt']))?'':$GET['rt'];
		if(empty($route))
		{
			$route = 'index';
		}
		else 
		{
			$paths = explode('/',$route);
			$this->controller = $paths[0];
			if(isset($parts[1]))
			{
				$this->action = $parts[1];
			}
		}
		if(empty($this->controller))
		{
			$this->controller = 'index';
		}
		if(empty($this->action))
		{
			$this->action = 'index';
		}
		$this->file = $this->path .'/'. $this->controller . 'Controller.php';
		
	}
}