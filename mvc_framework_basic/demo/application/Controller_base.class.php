<?php
Abstract class aController
{
	protected $registry;
	protected $view;
	protected $model;

	function __construct($registry)
	{
		$this->registry= $registry;
		$this->view    = new View($registry);
		$this->model   = new baseModel;
		
	}
	abstract function index();
}
?>
