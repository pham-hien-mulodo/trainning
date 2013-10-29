<?php
////// test pass  ////////////////

class testRundemon extends PHPUnit_Framework_TestCase
{
/*	public function testDelete()
	{
		$data= array();
		$data['process'] = 'delete';
		$data['colum'] = 'employee';
		$data['colums'] = 'salary';
		$data['id'] = 200;
		$sa = new SalaryModel();
		$result= $sa->delete($data);
		$this->assertEquals($result, 1);
	}
*/
	public function testDelete1()
	{
		$data= array();
		$data['id'] = 76;
		$data['process'] = 'delete';
		$data['colum']= 'salary';
		$data['colums'] = 'employee';
		$em = new EmployeeModel();
		$result = $em->delete($data);
		$this->assertInstanceOf($em, new EmployeeModel);
		$this->assertArrayHasKey('id', $data);
		$this->assertEquals(1,$result);
	}
	public function testInsertEm()
	{
		$data = array();
		$this->assertArrayHasKey('name', $data);
		$this->assertArrayHasKey('title', $data);
		$em = new EmployeeModel();
		$result = $em->insert($data);
		$this->assertArrayNotHasKey('id', $data);
		$maxid = $this->mysqli->query("select max(id) from employee");
		$this->assertLessThan($result, $maxid);
	}
	public function testInsertSa()
	{
		$data = array();
		$this->assertArrayHasKey('employee_code' , $data);
		$this->assertArrayHasKey('year', $data);
		$this->assertArrayHasKey('month', $data);
		$this->assertArrayHasKey('payment', $data);
		$sa= new SalaryModel();
		$result = $sa->insert($data);
		$maxid = $this->mysqli->query("select max(id) from employee");
		$this->assertLessThan($result, $maxid);
		
	}
	public function testUpdateEm()
	{
		$data= array();
		$em = new EmployeeModel();
		$result = $em->update($data);
		$this->assertEquals(1, $result);
		
	}
	public function testUpdateSa()
	{
		$data = array();
		$sa = new SalryModel();
		$result = $sa->update();
		$this->assertEquals(1, $result);
	}
	public function testSelectByIdEm()
	{
		$data= array();
		$this->assertArrayHasKey('id', $data);
		$em= new EmployeeModel();
		$result = $em->selectById($data);
		$this->assertInternalType('array', $result);
		$this->assertArrayHasKey('id', $result);
		$this->assertArrayHasKey('name', $result);
		$this->assertArrayHasKey('title', $result);
		$this->assertArrayHasKey('created', $result);
		$this->assertArrayHasKey('modified', $result);
	}
	public function testSelectByIdSa()
	{
		$data = array();
		$sa = new SalaryModel();
		$this->assertArrayHasKey('id', $data);
		$result = $sa->selectById($data);
		$this->assertInternalType('array', $result);
		$this->assertArrayHasKey('employee_code', $result);
		$this->assertArrayHasKey('year' , $result);
		$this->assertArrayHasKey('month', $result);
		$this->assertArrayHasKey('payment', $result);
	}
	public function testselect_all()
	{
		$data= array();
		$em = new EmployeeModel();
		$result = $em->select_all();
		
	}
	
}