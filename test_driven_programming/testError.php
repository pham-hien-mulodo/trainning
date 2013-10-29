<?php

class testError extends PHPUnit_Framework_TestCase
{
	public function testErrorDelete1()
	{
		$data = array();
	//	$this->assertArrayHasKey('name', $data);
		$this->assertNull('name', $data);
		$em = new EmployeeModel();
		$result = $em->delete($data);
		///// có trả về exception thì trả về pass ok
		$this->assertEquals('Error happened in the process. Please try again.' , $result);
	}
	public function testErrorDelete2()
	{
		$data = array();
		$em = new EmployeeModel();
		$result = $em->delete($data);
		$this->assertEquals(0, $result);
		throw new Exception('no record delete');
		$this->assertEquals(-1, $result);
		throw new Exception('error in process delete');
	}
	public function testErrorSelect()
	{
		$data = array();
		$em = new EmployeeModel();
		$result = $em->selectById($data);
		///// kiểm tra cái gì , lỗi khi nào ? ///////////
		$this->assertArrayHasKey('id', $result);
		$this->assertArrayHasKey('name' , $result);
		$this->assertArrayHasKey('title', $result);
	}
	public function test
}