<?php
require_once("/Library/WebServer/Documents/rundemon/model/employeeModel.php");
require_once("/Library/WebServer/Documents/rundemon/model/salaryModel.php");
require_once("/Library/WebServer/Documents/rundemon/application/aModel.php");
class testError extends PHPUnit_Framework_TestCase
{
	public function testErrorDelete1()
	{
		$data = array(
			'id' => 8,
			'colum' => 'salary',
			'colums' => 'employee',
			'process' => 'delete'
			);
	//	$this->assertArrayHasKey('name', $data);
		$this->assertNotNull('id', $data);
		$em = new EmployeeModel();
		$result = $em->delete($data);
		$this->assertEquals('id no exit', new Exception);
		$this->assertLessThan(1,$result);
		
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
//		$this->assert......('Exception', 'select employee no access');
//		$this->assert.......('Exception', 'select salary no access');
	}
	public function testErrorInsert_1()
	{
		$data = array(
			'employee_code' => 10,
			'year' => 2013,
			'month' => '',
			'payment' => 10000,
			'colum' => 'salary',
			'colums' => 'employee',
			'process' => 'insert'
			);
		date_default_timezone_set('Asia/Bangkok');
		$day = time();
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$sa= new SalaryModel();
		$result = $sa->insert($data);
		var_dump($result);
		$this->assertLessThanOrEqual(0, $result);
		// Exception : valid khong dung dinh dang
	}
	public function testErrorInsert_2()
	{
		$data = array(
			'employee_code' => 1000,
			'year' => 2013,
			'month' => 8,
			'payment' => 10000,
			'colum' => 'salary',
			'colums' => 'employee',
			'process' => 'insert'
			);
		date_default_timezone_set('Asia/Bangkok');
		$day = time();
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$sa= new SalaryModel();
		$result = $sa->insert($data);
		$this->assertLessThanOrEqual(0, $result);
		// Exception : employee_code no exit
	}
	public function testErrorInsert_3()
	{
		$data = array(
			'employee_code' => 10,
			'year' => 2013,
			'month' => 8,
			'payment' => 10000,
			'colum' => 'salary',
			'colums' => 'employee',
			'process' => 'insert'
			);
		date_default_timezone_set('Asia/Bangkok');
		$day = time();
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$sa= new SalaryModel();
		$result = $sa->insert($data);
		$this->assertLessThanOrEqual(0, $result);
		// Exception : insert no access
	}
}