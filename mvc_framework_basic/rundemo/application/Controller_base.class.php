<?php
Abstract class baseController
{
	protected $registry;
	protected $view;
	protected $model;

	function __construct($registry)
	{
		$this->registry= $registry;
		$this->view    = new baseView($registry);
		$this->model   = new baseModel;
		
	}
	abstract function index();
}
?>
