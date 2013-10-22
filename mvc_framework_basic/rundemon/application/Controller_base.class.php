<?php

Abstract class baseController
{
	protected $dispatch;
	function __construct()
	{
		$this->dispatch = new dispatch();
	}
	abstract function index();
}
?>
