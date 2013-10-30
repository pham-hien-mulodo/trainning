<?php

class testSaValidate extends TestInterface
{
	public function test()
	{
		$this->assertClassHasAttribute('data', 'Validate');
		$this->assertArrayHasKey('state', $data);
	}
	public function testValidate($data)
	{
		$this->assertNotNull($data['process']);
		if($this->assertEqulas('delete', $data['process']) || $this->assertEquals('selectById', $data['process']))
		{
			$this->assertTrue($this->testValid_int($data['id'], 1,11));
			$sa = new Salary();
			$result = $sa->validate();
			$this->assertEquals(1, $result);
		}
		if($this->assertEquals('insert', $data['process']))
		{
			$this->assertNull($data['id']);
			$this->assertTrue($this->testValid_int($data['employee_code'], 1,11));
			$this->assertTrue($this->testValid_int($data['payment'], 1, 11));
			$this->assertTrue($this->testValid_int($data['year'], 1, 4);
			$this->assertTrue($this->testValid_month($data['month']);
			$sa = new Salary();
			$result = $sa->validate();
			$this->assertEquals(1, $result);
		}
		if($this->assertEquals('update', $data['process']))
		{
			$this->assertTrue($this->testValid_int($data['id'],1,11));
			$this->assertTrue($this->testValid_int($data['employee_code'], 1,11));
			$this->assertTrue($this->testValid_int($data['payment'], 1, 11));
			$this->assertTrue($this->testValid_int($data['year'], 1, 4);
			$this->assertTrue($this->testValid_month($data['month']);
			$sa = new Salary();
			$result = $sa->validate();
			$this->assertEquals(1, $result);
		}
	}
}