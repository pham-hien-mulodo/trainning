<?php
Abstract class baseController
{
	protected $registry;
	function __construct($registry)
	{
		$this->registry = $registry;
		$this->model = &baseModel::getInstance();
		$this->view  = &baseView::getInstance();
	}
	abstract function index();
}