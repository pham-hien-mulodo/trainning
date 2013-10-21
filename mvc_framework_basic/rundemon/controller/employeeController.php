<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/employeeModel.php");
//class index_em_controller Extends baseController
class employeeController Extends baseController
{
	public function index()
	{
		$em = new EmployeeModel();
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
		$data['token'] = $param['token'];
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$em = new employeeModel();
		if(!empty($data['token']) && $data['token'] == $_SESSION['token']){
		$this->view->result = $em->delete($data);
		$this->view->show('em_delete'); }
		else $this->view->show('error');
	}
	public function insert($param)
	{
		$result = null;
		if($param['token'] == $_SESSION['token'])
		{
			$this->view->result = $result;
			$token = sha1(uniqid(rand(),true));
			$_SESSION['token'] = $token;
			$this->view->token = $token;
			$this->view->show('em_insert');
		}
		else $this->view->show('error');
	}
	public function insertkq($param)
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
		if($data['token'] == $_SESSION['token']){
		if (isset($param['name']) || isset($param['title']) ){
		$result['id'] = (int)$param['id'];
		$result['process'] = 'update';
		date_default_timezone_set('Asia/Bangkok');
		$result['colum'] = 'salary';
		$result['colums'] = 'employee';
		$result['name'] = $param['name'];
		$result['title'] = $param['title'];
		$day = time();
		$result['modified'] = date('Y-m-d H:i:s', $day);
		$result1 = $em->update($result);
		$this->view->result= $result1;
		if(isset($result1))
		{
			$this->view->token = $param['token'];
			$this->view->show('em_update');
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
	if($param['token'] == $_SESSION['token'])
	{
	$token = $param['token'];
	$data['process'] = 'selectById';
	date_default_timezone_set('Asia/Bangkok');
	$data['colum'] = 'salary';
	$data['colums'] = 'employee';
	$em = new EmployeeModel();
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
		$this->view->em = new employeeModel();
		$this->view->show('em_select_all');
	}
			// var_dump($result);
		// truyen gia tri sang view
		// trong view KHONG BAO GIO goi truc tiep den model
		// moi xu ly du lieu voi Model PHAI DUOC THUC HIEN TAI CONTROLLER
	//	$this->result = $result;
}