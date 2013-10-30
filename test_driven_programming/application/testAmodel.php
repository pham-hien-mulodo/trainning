<?php
require_once('/Library/WebServer/Documents/rundemon/application/aModel.php');
class testControllerBase extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$this->assertClassAttribute('host', 'aModel');
		$this->assertClassAttribute('user', 'aModel');
		$this->assertClassAttribute('passwork', 'aModel');
		$this->assertClassAttribute('dbname', 'aModel');
		$this->assertClassAttribute('mysqli', 'aModel');
		$this->assertClassHasStaticAttribute('instance', 'aModel');
	}
	public function testGetInstance()
	{
		$this->assertInstanceOf('instance', new aModel);
	}
	public function testGet($name)
	{
		$file = __SITE_PATH.'/model/'.str_replace("model","",strtolower($name))."Model.php";
		$this->assertFileExists($file);
		include ($file);
		$class = str_replace("model","",strtolower($name))."Model";
		$this->assertInstanceOf(new class, $this->get($name));
	}
	public function testErrorGet()
	{
		$file = __SITE_PATH.'/model/'.str_replace("model","",strtolower($name))."Model.php";
		$this->assertFalse($this->assertFileExists($file));
		include ($file);
		$class = str_replace("model","",strtolower($name))."Model";
		$this->assertNull($this->get($name));
	}
	public function testCalldbConnect()
	{
		$this->assertInstanceOf('this->mysqli' , new mysqli());
		$this->assertTrue($this->calldbConnect());
	}
	public function testErrorConnect()
	{
		$this->assertEquals('Error happened in the process. Please try again.', $this->calldbConnect());
	}
	
}