<?php
require_once('/Library/WebServer/Documents/rundemon/model/Salary.php');
require_once('/Library/WebServer/Documents/rundemon/model/Employee.php');
class TestInterface extends PHPUnit_Framework_TestCase
{
	// xem lại sự khác nhau giữa assertInternalType và assertStringMatchesFormat.
	public function test()
	{
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/model/Salary.php');
		$this->assertFileExists('/Library/WebServer/Documents/rundemon/model/Employee.php');
		$this->assertClassHasAttribute('process', 'Validate');
	}
	public function testValid_string($data, $minlength, $maxleng)
	{
		$this->assertNotNull($data);
		$this->assertNotNull($minlength);
		$this->assertNotNull($maxleng);
		$this->assertGreaterThanOrEqual($minlength, strlen($data));
		$this->assertLessThanOrEqual($maxlen, strlen($data));
		$this->assertInternalType('string', $data);
		$em = new Validate();
		$result = $em->valid_string($data,$minlength, $maxleng);
		$this->assertTrue($result);
	}
	
	public function testValid_int($data, $minlength, $maxleng)
	{
		$this->assertNotNull($data);
		$this->assertNotNull($minlength);
		$this->assertNotNull($maxleng);
		$this->assertGreaterThanOrEqual($minlength, strlen($data));
		$this->assertLessThanOrEqual($maxlen, strlen($data));
		$this->assertInternalType('int', $data);
		$em = new Validate();
		$result = $em->valid_int($data,$minlength, $maxleng);
		$this->assertTrue($result);
	}
	public function testValid_date($data)
	{
		$this->assertNotNull(trim($data));
		// kiểm tra định dạng chuỗi nhập vào. 
		$em = new Validate();
		$result = $em->valid_int($data,$minlength, $maxleng);
		$this->assertTrue($result);
	}
	public function testValid_month($data)
	{
		$this->assertLessThanOrEqual(12, $data);
		$this->assertGreaterThanOrEqual(1, $data);
		$em = new Validate();
		$result = $em->valid_month($data);
		$this->assertEquals(1, $result);
	}
	
	public function testValid_stringError_1($data, $minlength, $maxleng)
	{
		$em = new Validate();
		if($this->assertNull($data) || $this->assertNull($minlength) || $this->assertNull($maxleng))
		{
			
			$result = $em->valid_string($data,$minlength, $maxleng);
			$this->assertFalse($result);
			throw new Exception('data null');
		}
		if($this->assertGreaterThan($maxleng, strlen($data)) || $this->assertLessThan($minlength, strlen($data)))
		{
			$result = $em->valid_string($data,$minlength, $maxleng);
			$this->assertFalse($result);
			throw new Exception('data error length');
		}
		if($this->assertFalse($this->assertInternalType('int', $data)))
		{
			$result = $em->valid_string($data,$minlength, $maxleng);
			$this->assertFalse($result);
			throw new Exception('data error type format');
		}
	}
	
}