<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/employeeModel.php");
class employeeController Extends baseController
{
	public function index()
	{
		$em = new EmployeeModel();
		$this->view = new employeeView();
		$result = $em->select_all();
		$_SESSION['token'] =sha1(uniqid(rand(),true));
		$this->view->result = $result;
		$this->view->token = $_SESSION['token'];
		$this->view->show('em_index');
		
	}
	public function delete($param)
	{
		
		date_default_timezone_set('Asia/Bangkok');
		$data = array();
		$data['process']= 'delete';
		$data['id'] = (int)$param['id'];
		$data['token'] = $_POST['token'];
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$em = new employeeModel();
		$this->view = new employeeView();
		if(!empty($data['token']) && $data['token'] == $_SESSION['token']){
		$this->view->result = $em->delete($data);
		$this->view->id = $data['id'];
		$this->view->show('em_delete'); }
		else $this->view->show('error');
	}
	public function insert()
	{
		$result = null;
		$this->view = new employeeView();
		if($_POST['token'] == $_SESSION['token'])
		{
			$this->view->result = $result;
			$token = sha1(uniqid(rand(),true));
			$_SESSION['token'] = $token;
			$this->view->token = $token;
			$this->view->show('em_insert');
		}
		else $this->view->show('error');
	}
	public function insertkq()
	{
		$data = array();
		if($_POST['token'] == $_SESSION['token']){
		$day = time();
		date_default_timezone_set('Asia/Bangkok');
		$data['name']= $_POST['name'];
		$data['title'] = $_POST['title'];
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$em = new employeeModel();
		$this->view = new employeeView();
		$result = $em->insert($data);
		$token = sha1(uniqid(rand(),true));
		$_SESSION['token'] = $token;
		if(isset($result))
		{
			$this->view->result = $result;
			$this->view->token = $_POST['token'];
			$this->view->show('em_insertkq');
		}
		else $this->view->show('error');
	}
	}
	public function update($param)
	{
		$data = array();
		foreach($param as $key=>$value)
		{
			$data[$key] = $value;
		}
		$em = new EmployeeModel();
		$this->view = new employeeView();
		if($_POST['token'] == $_SESSION['token']){
			if (isset($_POST['name']) || isset($_POST['title']) ){
			$result['id'] = (int)$param['id'];
			$result['process'] = 'update';
			date_default_timezone_set('Asia/Bangkok');
			$result['colum'] = 'salary';
			$result['colums'] = 'employee';
			$result['name'] = $_POST['name'];
			$result['title'] = $_POST['title'];
			$day = time();
			$result['modified'] = date('Y-m-d H:i:s', $day);
			$result1 = $em->update($result);
			$this->view->result= $result1;
		if($result1>0)
		{
			$this->view->id = $data['id'];
			$this->view->token = $_POST['token'];
			$this->view->show('update');
		}
		else $this->view->show('error');
			}
		}
	}
	public function selectById($param)
	{
		foreach($param as $key=>$value)
		{
			$data[$key] = $value;
		}
	if($_POST['token'] == $_SESSION['token'])
	{
		$token = $_POST['token'];
		$data['process'] = 'selectById';
		date_default_timezone_set('Asia/Bangkok');
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$em = new EmployeeModel();
		$this->view = new employeeView();
		$result= $em->selectById($data);
		$this->view->data = $result;
		$token = sha1(uniqid(rand(),true));
		$_SESSION['token'] = $token;
		if(isset($result))
		{
			$this->view->token = $token;
			$this->view->show('em_selectById');
		}
		else echo "error";
	}
	else $this->view->show('em_index'); 
	}
	public function select_all()
	{
		$this->view = new employeeView();
		$this->view->em = new employeeModel();
		$this->view->show('em_select_all');
	}
}