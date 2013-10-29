<?php
class testView extends PHPUnit_Framework_TestCase
{
	public function test($process)
	{
		$this->assertClassHasAttribute();
		$path = __SITE_PATH.'/views/'.$process.'.php';
		$this->assertFileExists($path);
	}
}