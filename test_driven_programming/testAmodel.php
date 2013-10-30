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
	public function testGet()
	{
	}
	public function testCalldbConnect()
	{
		$this->assertInstanceOf('this->mysqli' , new mysqli());
	}
	public function testError()
	{
		
	}
	
}