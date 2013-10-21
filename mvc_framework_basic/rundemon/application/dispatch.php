<?php

class Dispatch
{

	public function analyzURI()
	{
		$param = null;
		$url = array();
		$uri = $_GET['uri'];
		$url = explode('/', $uri);
		$controller = $url[0];
		$action = $url[1];
		if($action == 'index')
		{
			$result = array(
				 'controller' =>$controller,
				 'action' =>$action
			);
		}
		else
		{
		$result = $_GET['param'];
		foreach($result as $key=>$value)
		{
			$param[$key] = $value;
		}
			$result = array(
				 'controller' =>$controller,
				 'action' =>$action,
				 'param'=> $param
			);
		}
		 return $result;
	}

	public function loader($site_path)
	{
		$result = $this->analyzURI();
		$controller = $result['controller'];
		$action = $result['action'];
		if(!empty($controller)&& !empty($action))
		{
			$file = $site_path .'/controller/'.$controller.'Controller.php';
		}
		else
		{
			$file = $site_path.'/'.'index.php';
		}
		if(is_readable($file))
		{
			if(is_callable($controller, $action))
			{
				include $file;
				$controller = $controller.'Controller';
				if($action =='index'){ $param = null;}
				else{	$param = $result['param']; }
				$result = new $controller;
				$data['process'] = $action;
				$result->$action($param);
			}
			else echo "    no call able action   ";
		}
		else echo " no read";
	}
}