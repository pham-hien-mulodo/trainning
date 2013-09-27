<?php 
Abstract Class baseController
{
	protected $registry;
	function __contruct($registry)
	{
		$this->registry = $registry;
		
	}
	abstract function index();
}