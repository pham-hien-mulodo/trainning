<?php 

class testController extends PHPUnit_Framework_TestCase
{
	public function testIndex()
	{
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assert
	}
	public function testDelete()
	{
		// test input $_POST
		//
		$this->assertNull('_POST');
		$this->assertNull("_SESSION['token']");
	}
	public function testInsert()
	{
		$this->assertNull('_POST');
		$this->assertNull("_SESSION['token']");
	}
	public function testUpdate()
	{
		$this->assertNull('_POST');
		$this->assertNull("_SESSION['token']");
	}
	public function testSelectById()
	{
		$this->assertNull('_POST');
		$this->assertNull("_SESSION['token']");
	}
	public function testSelect_all()
	{
	}
}