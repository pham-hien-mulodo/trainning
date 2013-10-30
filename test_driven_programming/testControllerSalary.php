<?php 
require_once("/Library/WebServer/Documents/rundemon/controller/salaryController.php");
class testControllerSalary extends PHPUnit_Framework_TestCase
{
	public function testIndex()
	{
		$this->assertInstanceOf($sa, new SalaryModel);
		$this->assertInstanceOf($this->view, new salaryView());
	}
	public function testDelete()
	{
		// test input $_POST
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($sa, new SalaryModel);
		$this->assertInstanceOf($this->view, new salaryView());
		$this->assertArrayHasKey('param', $_GET);
	}
	public function testInsert()
	{
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($sa, new SalaryModel);
		$this->assertInstanceOf($this->view, new salaryView());
	}
	public function testInsertKq()
	{
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($sa, new SalaryModel);
		$this->assertInstanceOf($this->view, new salaryView());
	}
	public function testUpdate()
	{
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($sa, new SalaryModel);
		$this->assertInstanceOf($this->view, new salaryView());
		$this->assertArrayHasKey('param', $_GET);
	}
	public function testSelectById()
	{
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertInstanceOf($sa, new SalaryModel);
		$this->assertInstanceOf($this->view, new salaryView());
		$this->assertArrayHasKey('param', $_GET);
	}
	public function testSelect_all()
	{
	}
}