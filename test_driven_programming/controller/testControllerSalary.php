<?php 
require_once("/Library/WebServer/Documents/rundemon/application/View_base.class.php");
require_once("/Library/WebServer/Documents/rundemon/views/em_insert.php");
require_once("/Library/WebServer/Documents/rundemon/controller/salaryController.php");
require_once("/Library/WebServer/Documents/rundemon/model/salaryModel.php");
require_once("/Library/WebServer/Documents/rundemon/application/aModel.php");
class testControllerSalary extends PHPUnit_Framework_TestCase
{
	public function testIndex()
	{
		$saCon = new salaryController();
		$this->assertInstanceOf('salaryController', $saCon);
		$result = $saCon->index();
	//	$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/sa_index.php');
	}
	
	public function testDelete()
	{
		$_POST['token'] = '12345asd6789';
		$_SESSION['token'] = '12345asd6789';
		$param['id']= 4;
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertArrayHasKey('id', $param);
		$saCon = new salaryController();
		$this->assertInstanceOf('salaryController', $saCon);
		try{
			$result = $saCon->delete($param);
	//		var_dump($result);
			$this->assertTrue(isset($result));
			$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/em_delete.php');
	
		}
		catch (Exception $e)
		{
			$error = $e->getmessage();
			echo $error;
		}
	}

	public function testInsert()
	{
		$_POST['token'] = '123456asd78';
		$_SESSION['token'] = '123456asd78';
		$token = '12345asdf6789';
		$result = null;
		$this->assertNotNull("_POST['token']");
		$this->assertNotNull("_SESSION['token']");
		$saCon = new salaryController();
		$result = $saCon->insert();
		$this->assertNotNull($token);
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/sa_insert.php');
	}
	public function testInsertKq()
	{
		$_POST = array(
			'employee_code' => 10,
			'year' => 2013,
			'month' => 8,
			'payment' => '10000000',
			'token' => '12345asd6789');
		$_SESSION['token'] = '12345asd6789';
		$saCon = new salaryController();
		$this->assertNotNull("_POST['token']");
		$this->assertArrayHasKey('employee_code', $_POST);
		$this->assertArrayHasKey('year', $_POST);
		$this->assertArrayHasKey('month', $_POST);
		$this->assertArrayHasKey('payment', $_POST);
		$this->assertArrayHasKey('token', $_POST);
		$this->assertNotNull("_POST['employee_code']");
		$this->assertNotNull("_POST['year']");
		$this->assertNotNull("_POST['month']");
		$this->assertNotNull("_POST['payment']");
		$this->assertNotNull("_POST['token']");
		$this->assertNotNull("_SESSION['token']");
		$result = $saCon->insertkq($_POST, $_SESSION['token']);
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/sa_insertkq.php');
	}

	public function testUpdate()
	{ 
		$param = array( 'id' => 5 );
		$_POST = array(
			'employee_code' => 10,
			'year' => 2013,
			'month' => 8,
			'payment' => '10000000',
			'token' => '12345asd6789'
		);
		$_SESSION['token'] = '12345asd6789';
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertEquals($_POST['token'], $_SESSION['token']);
		$this->assertArrayHasKey('employee_code', $_POST);
		$this->assertArrayHasKey('year', $_POST);
		$this->assertArrayHasKey('month', $_POST);
		$this->assertArrayHasKey('payment', $_POST);
		$this->assertArrayHasKey('token', $_POST);
		$this->assertNotNull("_POST['employee_code']");
		$this->assertNotNull("_POST['year']");
		$this->assertNotNull("_POST['month']");
		$this->assertNotNull("_POST['payment']");
		$this->assertNotNull("param['id']");
		$saCon = new salaryController();
		$result = $saCon->update($param, $_POST, $_SESSION['token']);
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/update.php');
	}
	

	public function testSelectById()
	{
		$param = array( 'id' => 5 );
		$_POST['token'] = '12345asd6789';
		$_SESSION['token']  = '12345asd6789';
		$this->assertNotNull("_POST['token']");
		$this->assertNotNull("_SESSION['token']");
		$this->assertNotNull("param['id']");
		$this->assertEquals($_POST['token'], $_SESSION['token']);
		$saCon = new salaryController();
		$result = $saCon->selectById($param, $_POST, $_SESSION['token']);
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/sa_selectById.php');
	}

	public function testSelect_all()
	{
		$emCon = new employeeController();
		$result = $emCon->select_all();
	}

}