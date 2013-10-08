<?php
Abstract class baseController
{
	protected $dispatch;
	protected $view;
	protected $model;

	function __construct()
	{
	//	$this->dispatch= $dispatch;
		$this->dispatch = new dispatch();
		$this->view    = new baseView();
		$this->model   = new baseModel;
		
	}
	abstract function index();
}
?>
