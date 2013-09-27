<?php 
class router 
{
	private $registry;
	private $path;
	private $args = array();
	public $file;
	public $cotroller;
	public $action;
	function __construct($registry)
	{
		$this->registry = $registry;
	}
	function setPath($path)
	{
		if(is_dir($path) == false)
		{
			throw new Exception ('invalid controller path : ''.$path.''');
		}
		$this->path = $path;
	}
	public function loader()
	{
		$this->getController();
		if(is_realable($this->file) == false)
		{
			$this->file = $this->path.'/error404.php';
			$this->controller = 'error404';
		}
		include $this->file;
		$class = $this->controller.'Controller';
		$controller = new $class($this->registry);
		if(is_callable(array($controller, $this->action)) == false)
		{
			$action = 'index';
		}
		else 
		{
			$action = $this->action;
		}
		if(!empty($this->args))
			$controller->action($this->args);
		else
			$controller->$action();
	}
	private function getController()
	{
		$route = (empty($_GET['rt']))?'':$_GET['rt'];
		if(empty($route))
		{
			$route = 'index';
		}
		else
		{
			$parts = explode('/', $route);
			$this->controller = $parts[0];
			if(isset($parts[1]))
			{
				$this->action = $parts[1];
			}
			if(isset($parts[2]))
			{
				$count_args = count($parts);
				$k =1 ;
				$args = array();
				for($i = 2; $i <$count_args ; $i++)
				{
					$args[$k++] = $parts[$i];
				}
				$this->args = $args;
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
		$this->file = $this->path . '/' . $this->controller.'Controller.php';
	}
}
?>