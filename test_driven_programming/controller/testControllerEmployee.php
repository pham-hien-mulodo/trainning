<?php 
require_once("/Library/WebServer/Documents/rundemon/controller/employeeController.php");
class testControllerEmployee extends PHPUnit_Framework_TestCase
{
	public function testIndex()
	{
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertInstanceOf($this->view, new employeeView());
		$this->assertTrue($em->select_all());
		$this->assertTrue($this->view->show('em_index'));
	}
	public function testDelete()
	{
		// test input $_POST
		//
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertInstanceOf($this->view, new employeeView());
		$this->assertArrayHasKey('param', $_GET);
		
	}
	public function testInsert()
	{
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertInstanceOf($this->view, new employeeView());
	}
	public function testInsertKq()
	{
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertInstanceOf($this->view, new employeeView());
	}
	public function testUpdate()
	{
		$this->assertNull('_POST');
		$this->assertNull("_SESSION['token']");
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertInstanceOf($this->view, new employeeView());
		$this->assertArrayHasKey('param', $_GET);
	}
	public function testSelectById()
	{
		$this->assertNull('_POST');
		$this->assertNull("_SESSION['token']");
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertInstanceOf($this->view, new employeeView());
		$this->assertArrayHasKey('param', $_GET);
	}
	public function testSelect_all()
	{
	}
}