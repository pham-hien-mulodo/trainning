<?php 
require_once("/Library/WebServer/Documents/rundemon/application/View_base.class.php");
require_once("/Library/WebServer/Documents/rundemon/views/em_insert.php");
require_once("/Library/WebServer/Documents/rundemon/controller/salaryController.php");
require_once("/Library/WebServer/Documents/rundemon/model/salaryModel.php");
require_once("/Library/WebServer/Documents/rundemon/application/aModel.php");
class testControllerEmployee extends PHPUnit_Framework_TestCase
{

	public function testIndex()
	{
		$saCon = new salaryController();
		$this->assertInstanceOf('salaryController', $saCon);
		$result = $saCon->index();
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
			var_dump($result);
			$this->assertTrue(isset($result));
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
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$emCon = new employeeController();
		$result = $emCon->insert();
		$this->assertNotNull($token);
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/views/em_insert.php');
	}
	public function testInsertKq()
	{
		$_POST = array(
			'name' => 'hien pham',
			'title' => 'user',
			'token' => '12345asd6789');
		$_SESSION['token'] = '12345asd6789';
		$emCon = new employeeController();
		$this->assertNotNull('_POST');
		$this->assertArrayHasKey('name', $_POST);
		$this->assertArrayHasKey('title', $_POST);
		$this->assertNotNull("_SESSION['token']");
		$result = $emCon->insertkq($_POST, $_SESSION['token']);
	}

	public function testUpdate()
	{ 
		$param = array( 'id' => 5 );
		$_POST = array(
			'name' => ' hien update',
			'title' => 'user',
			'token' => '12345asd6789'
		);
		$_SESSION['token'] = '12345asd6789';
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertEquals($_POST['token'], $_SESSION['token']);
		$this->assertFalse(empty($_POST['name']));
		$this->assertFalse(empty($_POST['title']));
		$emCon = new employeeController();
		$result = $emCon->update($param, $_POST, $_SESSION['token']);
	}
	

	public function testSelectById()
	{
		$param = array( 'id' => 5 );
		$_POST['token'] = '12345asd6789';
		$_SESSION['token']  = '12345asd6789';
		$this->assertNotNull('_POST');
		$this->assertNotNull("_SESSION['token']");
		$this->assertEquals($_POST['token'], $_SESSION['token']);
		$emCon = new employeeController();
		$result = $emCon->selectById($param, $_POST, $_SESSION['token']);
	}
/*
	public function testSelect_all()
	{
		$emCon = new employeeController();
		$result = $emCon->select_all();
	}
*/
}