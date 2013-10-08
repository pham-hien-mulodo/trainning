<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/salaryModel.php");
class salaryController Extends baseController
{
	public function index()
	{
		$sa= new SalaryModel();
		
		$result = $sa->select_all();
		$this->view->token = sha1(uniqid(rand(),true));
		$this->view->result = $result;
		$this->view->show('indexsalary');
	}
	public function delete()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('deletes');
	}
	public function insert()
	{
		$sa = new salaryModel();
		$this->registry->view->show('inserts');
		
		$data = array();
		$data = $_POST;
		$token = $_SESSION['token'];
		if(empty($_POST)){
		$_SESSION['token'] =sha1(uniqid(rand(),true));
		}
		else {
		if($data['token'] == $token){
		$day = time();
		date_default_timezone_set('Asia/Bangkok');
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$result = $sa->insert($data);
		$this->registry->view->result = $result;
		if(isset($result))
		{
			$this->registry->view->show('insert_kq');
		}
		else return 0;}}
	}
	public function update()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('updates');
	}
	public function selectById()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('selects');
	}
	public function select_all()
	{
		$this->registry->view->sa = new salaryModel();
		$this->registry->view->show('sa_select_all');
	}
}