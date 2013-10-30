<?php
require_once('/Library/WebServer/Documents/rundemon/application/Controller_base.class.php');
class testControllerBase extends PHPUnit_Framework_TestCase
{
	public function test()
	{
		$this->assertClassAttribute('dispatch', 'baseController');
		$this->assertInstanceOf('dispatch', new Dispatch);
	}
}