<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/employeeModel.php");
//class index_em_controller Extends baseController
class employeeController Extends baseController
{
	public function index()
	{
		//http://localhost/rundemo/index.php?rt=employee/index
		$em = new EmployeeModel();
		$result = $em->select_all();
		//$this->registry->view->em = new employeeModel();
		$_SESSION['token'] =sha1(uniqid(rand(),true));
		// var_dump($result);
		// truyen gia tri sang view
		// trong view KHONG BAO GIO goi truc tiep den model
		// moi xu ly du lieu voi Model PHAI DUOC THUC HIEN TAI CONTROLLER
	//	$this->result = $result;
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
		var_dump($param['token']);
		var_dump($_SESSION['token']);
		if($param['token'] == $_SESSION['token'])
		{
			$this->view->result = $result;
			$token = sha1(uniqid(rand(),true));
			$_SESSION['token'] = $token;
			$this->view->token = $token;
		
			$this->view->show('em_insert');
		}
	}
	public function insertkq($param)
	{
		$data = array();
		foreach($param as $key=>$value)
		{
			$data[$key] = $value;
		}
		if($data['token'] == $_SESSION['token']){
		$day = time();
		date_default_timezone_set('Asia/Bangkok');
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
			$this->view->token = $token;
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
	//	if($data['token'] == $_SESSION['token']){
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
		$result = $em->update($result);
		$this->view->result= $result;
		if(isset($result))
		{
			$this->view->token = $param['token'];
			$this->view->show('em_update');
			
		}
		else $this->view->show('error');
	//	}
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
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show('em_select_all');
	}
}