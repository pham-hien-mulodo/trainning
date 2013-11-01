<?php
////// test pass  ////////////////
require_once("/Library/WebServer/Documents/rundemon/model/employeeModel.php");
require_once("/Library/WebServer/Documents/rundemon/model/salaryModel.php");
class testRundemon extends PHPUnit_Framework_TestCase
{
	private $host = 'localhost';
	private $user = 'root';
	private $password = "root";
	private $dbname = 'php_basics';
	protected $mysqli;
	protected static $instance;
		protected function calldbConnect()
	{
		
		try
		{
			$this->mysqli = new mysqli($this->host, $this->user, $this->password, $this->dbname);
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			mysqli_set_charset($this->mysqli,'utf8');
		} catch(Exception $e)
		{
			date_default_timezone_set('Asia/Bangkok');
			$error = error_log(date('m/d/Y H:i:s').' '.$e->getmessage().':');
			echo $error;
			print_r($e->getTrace());
			echo 'Error happened in the process. Please try again.';
		}
		return true;
	
	}
	protected function dbClose()
	{
		$result = $this->mysqli->close();
		if($result)
		{
			return true;
		}
	}
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

	public function testDelete1()
	{
		$data= array();
		$data['id'] = 76;
		$data['process'] = 'delete';
		$data['colum']= 'salary';
		$data['colums'] = 'employee';

		$em = new EmployeeModel();
		$result = $em->delete($data);
		$this->assertInstanceOf('EmployeeModel', $em);
		$this->assertArrayHasKey('id', $data);
		$this->assertEquals(1,$result);
	}

	public function testInsertEm()
	{
		$data = array(
			'name' => 'hien insert',
			'title' => 'user',
			'colum' => 'salary',
			'colums' => 'employee',
			'process' => 'insert'
			);
		date_default_timezone_set('Asia/Bangkok');
		$day = time();
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$this->assertArrayHasKey('name', $data);
		$this->assertArrayHasKey('title', $data);
		$this->assertNotNull("data['name']");
		$this->assertNotNull("data['title']");
		$this->assertArrayNotHasKey('id', $data);
		$em = new EmployeeModel();
//		$this->calldbConnect();
//		$maxid = $this->mysqli->query("select name from employee where id = 6");
//		var_dump($maxid);
//		$this->mysqli->commit();
//		$this->mysqli->close();
		$result = $em->insert($data);
	//	var_dump($result);
		$this->assertGreaterThan(0, $result);
	//	$this->assertGreaterThan($maxid, $result);
	}
*/
	public function testInsertSa()
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
		$this->assertArrayHasKey('employee_code' , $data);
		$this->assertArrayHasKey('year', $data);
		$this->assertArrayHasKey('month', $data);
		$this->assertArrayHasKey('payment', $data);
		$this->assertNotNull("data['employee_code']");
		$this->assertNotNull("data['year']");
		$this->assertNotNull("data['month']");
		$this->assertNotNull("data['payment']");
		$sa= new SalaryModel();
		$result = $sa->insert($data);
		var_dump($result);
//		$this->assertLessThanOrEqual(0, $result);
		$this->assertGreaterThan(0, $result);
//		$maxid = $this->mysqli->query("select max(id) from employee");
//		$this->assertLessThan($result, $maxid);
		
	}
/*
	public function testUpdateEm()
	{
		$data= array();
		$em = new EmployeeModel();
		$result = $em->update($data);
		$this->assertGreaterThan(0, $result1);
		
	}
	public function testUpdateSa()
	{
		$data = array();
		$sa = new SalaryModel();
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
	*/
}