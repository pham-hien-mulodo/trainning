<?php
class testDispatch extends PHPUnit_Framework_TestCase
{
	public function testAnalyzURI()
	{
		// /index.php?uri=salary/selectById&param[id]=47
		$uri = 'salary/selectById&param[id]=47';
		$this->assertNotNull('_GET');
		$this->assertArrayHasKey('uri', $_GET);
		
		$dispatch = new Dispatch();
		$result = $dispatch->analyzURI();
		$this->assertArrayHasKey('controller', $result);
		$this->assertArrayHasKey('action', $result);
		if($action == 'delete' || $action == 'update' || $action == 'selectById')
		{
			$this->assertArrayHasKey('param', $_GET);
			$this->assertArrayHasKey('param', $result);
		}
	}
	
	public function testLoad()
	{
		$param = array();
		$param = NULL;
		if($action == 'delete' || $action == 'update' || $action == 'selectById')
		{
			$param['id'] = 10;
		}
		$result = array(
			'controller' = 'employee',
			'action' = 'update',
			'param' = $param);
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/controller/'.$controller.'Controller.php');
		$file = '/Library/WebServer/Documents/rundemon/controller/'.$controller.'Controller.php';
		include $file;
		///// kiểm tra action tồn tại. /////////
		$controller = $controller.'Controller';
		$result = new $controller;
		if($action == 'delete' || $action == 'update' || $action == 'selectById')
		{
			$this->assertTrue($result->$action($param));
		}
		$this->assertTrue($result->$action);
	}
	

	public function testErrorLoad_1()
	{
		$this->assertNull($request);
		throw new Exception("URI NULL");
	}
	public function testErrorLoad_2()
	{
		$uri = 'employee/index';
		$this->assertNotNull('_GET');
		$controller = $controller.'Controller';
		$result = new $controller;
		$this->assertFalse( $this->assertFileExists('/Library/WebServer/Documents/rundemon/controller/'.$controller.'Controller.php'));
	}
	public function testErrorLoad_3()
	{
		$uri = 'employee/index';
		$this->assertNotNull('_GET');
		$controller = $controller.'Controller';
		$result = new $controller;
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/controller/'.$controller.'Controller.php');
		$file = '/Library/WebServer/Documents/rundemon/controller/'.$controller.'Controller.php';
		include $file;
		if($action == 'delete' || $action == 'update' || $action == 'selectById')
		{
			$this->assertFalse($result->$action($param));
		}
		$this->assertFalse($result->$action);
	}
	
	public function testErrorAnalyzURI_1()
	{
	//	$uri = 'salary/selectById&param[id]=47';
		$uri = 'employee/index';
		$this->assertNull('_GET');
		throw new "URI NUll";
	}
	public function testErrorAnalyzURI_2()
	{
		$this->assertFalse($this->assertInstanceOf($dispatch, new Dispatch));
		throw new Exception('Object no instance');
		$this->assertTrue($this->assertArrayNotHasKey('controller', $result) || $this->assertArrayNotHasKey('action', $result));
		throw new Exception ('controller or action no exit');
		if($action == 'delete' || $action == 'update' || $action == 'selectById')
		{
			$this->assertTrue($this->assertArrayNotHasKey('param', $_GET) || $this->assertArrayNotHasKey('param', $result));
			throw new Exception(' GET['param'] or Result['param'] no exit ');
		}
	}
	
}
