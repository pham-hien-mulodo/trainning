<?php

class Dispatch
{
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
		 'action' =>$action,
		 'param' =>$param
		);
		 return $result;
	}
	public function getController($site_path)
	{
		$result = $this->analyzURI();
	//	var_dump($result);
		$controller = $result['controller'];
		$action = $result['action'];
		if(!empty($controller)&& !empty($action))
		{
	//		echo "---access----";
			$files = $site_path .'/controller/'.$controller.'Controller.php';
	//		var_dump($files);
		}
		else
		{
	//		echo "error";
			$file = $site_path.'/'.'index.php';
		}
		
		return $files;
		
	}
	public function loader($site_path)
	{
		$result = $this->analyzURI();
		$controller = $result['controller'];
		$action = $result['action'];
	//	echo $site_path;
		$file = $this->getController($site_path);
	//	var_dump($file);
		if(is_readable($file))
		{
		//	echo "controller read able";
			if(is_callable($controller, $action))
			{
		//		echo "----action exit";
				include $file;
				$controller = $controller.'Controller';
			
		//		echo $action;
		//		echo '---'.$param;
				$result = new $controller;
				$data['process'] = $action;
				$result->$action();
			}
			else echo "    no call able action   ";
		}
		else echo " no read";
	}
}