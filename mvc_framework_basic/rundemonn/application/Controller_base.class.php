<?php
Abstract class baseController
{
	protected $dispatch;
	protected $view;

	function __construct()
	{
		$this->dispatch = new dispatch();
		$this->view    = new baseView();
	}
	abstract function index();
}
?>
