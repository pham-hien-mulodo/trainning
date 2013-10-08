<?php

class Dispatch
{
//	global $this->uri;
//	global $files;
//	global $controller: string;
//	global $action : string;
//	global $param : array();


	public function __construct()
	{

	//	$employee = $uri.'/employeeController.php';
	//	$controller = $uri.'/salaryController.php';
	//	$action = $uri.'/'.$controller.'controller'.'?delete/id=20';
	}
	public function setPath()
	{
		$uri = $_SERVER['REQUEST_URI'];
		return $uri;
	}
	public function analyzURI()
	{
	//	$uri = $this->setPath();
		$url = array();
		$uri = $_GET['uri'];
		$url = explode('/', $uri);
		$controller = $url[0];
		$action = $url[1];
	//	$arg = explode('?', $action);
	//	$action = $arg[0];
	//	$param = $arg[1];
		$result = array(
		 'controller' =>$controller,
		 'action' =>$action
	//	 'param' =>$param
		);
		 return $result;
	}
	public function getController($site_path)
	{
		$result = $this->analyzURI();
		var_dump($result);
		$controller = $result['controller'];
		$action = $result['action'];
	//	echo $GLOBALS['action'];
		if(!empty($controller)&& !empty($action))
		{
			echo "---access----";
			$files = $site_path .'/controller/'.$controller.'Controller.php';
			var_dump($files);
		}
		else
		{
			echo "error";
			//$file = $uri.'/'.'index.php';
		}
		
		return $files;
		
	}
	public function loader($site_path)
	{
		$result = $this->analyzURI();
		$controller = $result['controller'];
		$action = $result['action'];
		echo $site_path;
		$file = $this->getController($site_path);
		if(is_readable($file))
		{
			echo "controller read able";
			if(is_callable($controller, $action))
			{
				echo "----action exit";
				include $file;
				$controller = $controller.'Controller';
				echo $controller;
				$result = new $controller;
				$data['process'] = $action;
				$result->$action();
			}
			else echo "    no call able action   ";
		}
		else echo " no read";
	}
}