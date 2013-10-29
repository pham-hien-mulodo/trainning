<?php
class testDispatch extends PHPUnit_Framework_TestCase
{
	public function testAnalyzURI()
	{
		// /index.php?uri=salary/selectById&param[id]=47
		$uri = salary/selectById&param[id]=47;
		$this->assertNull('_GET');
		$this->assertArrayHasKey('uri', $_GET);
		if($action == 'delete' || $action == 'update' || $action == 'selectById')
		{
			$this->assertArrayHasKey('param', $_GET);
		}
		$dispatch = new Dispatch();
		$result = $dispatch->analyzURI();
	}
}
