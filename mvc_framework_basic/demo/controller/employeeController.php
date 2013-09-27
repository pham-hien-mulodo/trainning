<?php
class index_em_controller Extends aController
{
	public funtion index()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show('em_index');
		
	}
	public function delete()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show('delete'); 
	}
	public function insert()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show('em_insert');
	}
	public function update()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show(em_update);
	}
	public function selectById()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show(em_selectById);
	}
	public function select_all()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show(em_select_all);
	}
}