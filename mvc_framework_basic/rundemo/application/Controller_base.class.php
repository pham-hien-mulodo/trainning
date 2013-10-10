<?php
require_once(__SITE_PATH."/application/View_base.class.php");
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
