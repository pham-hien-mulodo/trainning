<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/salaryModel.php");
class salaryController extends baseController
{
	public function index()
	{
	//	echo "access";
		$sa= new SalaryModel();
		
		$result = $sa->select_all();
		$this->view->token = sha1(uniqid(rand(),true));
		$this->view->result = $result;
		$this->view->showSalary('sa_index');
	}
	public function delete($id= 12)
	{
		$data['id'] = $id;
		$data = array();
		$data = $_POST;
		$token = $_SESSION['token'];
		echo $token;
		$data['process'] ='delete';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$sa = new SalaryModel();
		$result = $sa->delete($data);
		if(isset($result))
		{
		$this->view->result = $result;
		$this->view->show('deletes');
		}
		else return 0;
	}
	public function insert()
	{
		$sa = new salaryModel();
		$this->view->show('inserts');
		
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
		$this->view->result = $result;
		if(isset($result))
		{
			$this->view->show('insert_kq');
		}
		else return 0;}}
	}
	public function update()
	{
		$this->view->sa = new salaryModel();
		$this->view->show('updates');
	}
	public function selectById()
	{
		$this->view->sa = new salaryModel();
		$this->view->show('selects');
	}
	public function select_all()
	{
		$this->view->sa = new salaryModel();
		$this->view->show('sa_select_all');
	}

}

