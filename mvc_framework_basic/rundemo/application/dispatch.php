<?php

class Dispatch
{
/*
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
*/
	public function load()
	{
		$data = $this->analyze_uri();

		$data['process'] = $data['action'];
		$file = __SITE_PATH.'/controller/'.$data['controller'].'Controller.php';
		if(!is_readable($file))
		{
			echo "no read   ";
		}
		require_once(__SITE_PATH.'/controller/'.$data['controller'].'Controller.php');
		$controller = $data['controller'].'Controller';
		$controller = new $controller;
		$action = $data['action'];
		echo $action;
		$controller->$action();
	
	}
	private function analyze_uri()
	{
		$data = array();
		$uri = $_GET['uri'];
		$uri = explode('/',$uri); 
		$data['controller'] = $uri[0];
		$data['method'] = $uri[1];
		$data['action'] = $data['method'];
		if(preg_match("/[?]/", $data['method']))
		{
			$method = explode('?', $data['method']);
			var_dump($method);
			$data['action'] = $method[0];
			$data['param'] = $method[1];
		/*	foreach($method as $key=>$value)
			{
				$data[$key] = $value;
			}
			$data['param'] = $method[1];*/
		//	var_dump($data);
		}
		return $data;
	}
	
	
	
	
	
	
	
	
	
}