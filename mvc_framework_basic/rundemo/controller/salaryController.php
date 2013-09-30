<?php
class index_sa_controller
{
	public function index()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_indexSalary');
	}
	public function delete()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_deletes');
	}
	public function insert()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_inserts');
	}
	public function update()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_update');
	}
	public function selectById()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_selectById');
	}
	public function select_all()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_select_all')
	}
}