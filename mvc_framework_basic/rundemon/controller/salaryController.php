<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/salaryModel.php");

class salaryController extends baseController
{
	public function index()
	{
		$sa= new SalaryModel();
		$this->view = new salaryView();
		$result = $sa->select_all();
		$_SESSION['token'] = sha1(uniqid(rand(),true));
		$this->view->token = $_SESSION['token'];
		$this->view->result = $result;
		$this->view->show('sa_index');
	}
	public function delete($param)
	{
	foreach($param as $key=>$value)
	{
		$data[$key] = $value;
	}
	$data['id'] = (int)$data['id'];
	$data['process'] ='delete';
	$data['colum'] = 'salary';
	$data['colums'] = 'employee';
	date_default_timezone_set('Asia/Bangkok');
	$sa = new SalaryModel();
	$this->view = new salaryView();
	if(!empty($_POST['token']) && $_POST['token'] == $_SESSION['token']){
	$sa = $sa->delete($data);
	if(isset($sa))
	{
		$this->view->result = $sa;
		$this->view->id = $data['id'];
		$this->view->show('em_delete');
	}
	else $this->view->show('error');
	}
}
	public function insert()
	{	
		$result = null;
		$this->view = new salaryView();
		if($_POST['token'] == $_SESSION['token'])
		{
			$this->view->result = $result;
			$token = sha1(uniqid(rand(),true));
			$_SESSION['token'] = $token;
			$this->view->token = $token;
			$this->view->show('sa_insert');
		}
		else $this->view->show('error');
	}
	public function insertkq()
	{
		if(empty($_POST)){
		
		$_SESSION['token'] =sha1(uniqid(rand(),true));
		}
		else {
		$data= array();
		$data = $_POST;
		if($data['token'] == $_SESSION['token']){
		$day = time();
		
		date_default_timezone_set('Asia/Bangkok');
		$data['employee_code'] = (int)$_POST['employee_code'];
		$data['year'] = (int)$_POST['year'];
		$data['month'] = (int)$_POST['month'];
		$data['payment'] = (int)$_POST['payment'];
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$sa = new SalaryModel();
		$this->view = new salaryView();
		$result = $sa->insert($data);
		$this->view->result = $result;
		if($result>0)
		{
			$token = sha1(uniqid(rand(),true));
			$_SESSION['token'] = $token;
			$this->view->token = $token;
			$this->view->show('sa_insertkq');
		}
		else $this->view->show('error');}}
	}
	public function update($param)
{
	foreach($param as $key=>$value)
	{
		$data[$key] = $value;
	}
	$salary = new SalaryModel();
	$this->view = new salaryView();
	if($_POST['token'] == $_SESSION['token']){
		$result['id'] = (int)$data['id'];
		$result['process'] = 'update';
		date_default_timezone_set('Asia/Bangkok');
		$result['colum'] = 'salary';
		$result['colums'] = 'employee';
		$result['employee_code'] = (int)$_POST['employee_code'];
		$result['year'] = (int)$_POST['year'];
		$result['month'] = (int)$_POST['month'];
		$result['payment'] = (int)$_POST['payment'];
		$day = time();
		$result['modified'] = date('Y-m-d H:i:s', $day);
		$sa= $salary->update($result);
	if($sa>0)
	{
		$this->view->result = $sa;
		$this->view->id = $data['id'];
		$this->view->show('update');
	}
	else $this->view->show('error');
	}
}
	public function selectById($param)
	{
	foreach($param as $key=>$value)
	{
		$data[$key] = $value;
	}
	$token = $_POST['token'];
	$data['process'] = 'selectById';
	date_default_timezone_set('Asia/Bangkok');
	$data['id'] = (int)$data['id'];
	$data['colum'] = 'salary';
	$data['colums'] = 'employee';
	$sa = new SalaryModel();
	$this->view = new salaryView();
	if($_POST['token'] == $_SESSION['token'])
	{
		$result= $sa->selectById($data);
		$this->view->data = $result;
		if(isset($result))
		{
			$this->view->token = $token;
			$this->view->show('selectById');
			$token = sha1(uniqid(rand(),true));
		}
		else $this->view->show('error');
	}
	}
	public function select_all()
	{
		$this->view->sa = new salaryModel();
		$this->view->show('sa_select_all');
	}

}

