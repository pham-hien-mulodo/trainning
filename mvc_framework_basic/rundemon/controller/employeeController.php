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
	public function delete()
	{
		echo "access";
		date_default_timezone_set('Asia/Bangkok');
		$data = array();
		$data['process']= 'delete';
		$data['id'] = (int)$_POST['id'];
		$data['token'] = $_POST['token'];
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$em = new employeeModel();
		if(!empty($data['token']) && $data['token'] == $_SESSION['token']){
		$this->registry->view->result = $em->delete($data);
		$this->registry->view->show('index.php?rt=employee/em_delete'); }
	}
	public function insert()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show('em_insert');
		$data = array();
		$data = $_POST;
		var_dump($data);
		if(empty($_POST)){
		$_SESSION['token'] =sha1(uniqid(rand(),true));
		}
		else {
		$em = new EmployeeModel();
		if($data['token'] == $_SESSION['token']){
		$day = time();
		date_default_timezone_set('Asia/Bangkok');
		$data['process'] ='insert';
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$data['created'] = date('Y-m-d H:i:s', $day);
		$data['modified'] = date('Y-m-d H:i:s', $day);
		$result = $em->insert($data);
		$this->registry->view->result = $result;
		if(isset($result))
		{
			$this->registry->view->show('em_insertkq');
		}
		else $this->registry->view->show('error');
	}
}
	}
	public function update()
	{
		$data = array();
		var_dump($_GET);
		$data['id'] = $_GET['rt'];
		$data['token'] = $_POST['token'];
		$data['process'] = 'selectById';
		date_default_timezone_set('Asia/Bangkok');
		$data['colum'] = 'salary';
		$data['colums'] = 'employee';
		$em = new EmployeeModel();
		$data= $em->selectById($data);
		$em = new EmployeeModel();
	//	if($data['token'] == $_SESSION['token']){
		if (isset($_POST['name']) || isset($_POST['title']) ){
		$result['id'] = $data['id'];
		$result['process'] = 'update';
		date_default_timezone_set('Asia/Bangkok');
		$result['colum'] = 'salary';
		$result['colums'] = 'employee';
		$result['name'] = $_POST['name'];
		$result['title'] = $_POST['title'];
		$day = time();
		$result['modified'] = date('Y-m-d H:i:s', $day);
		$$this->registry->view->result= $em->update($result);
		if(!isset($result))
		{
			$this->registry->view->show('error');
		}
		else $this->registry->view->show('em_update');
	//	}
		}
		
	}
	public function selectById($param)
	{
		foreach($param as $key=>$value)
	{
		$data[$key] = $value;
	}
	$token = $_SESSION['token'];
	var_dump($token);
	$data['process'] = 'selectById';
	date_default_timezone_set('Asia/Bangkok');
	$data['colum'] = 'salary';
	$data['colums'] = 'employee';
	$em = new EmployeeModel();
	$result= $em->selectById($data);
	$this->view->data = $result;
	if(isset($result))
	{
		$this->view->token = $token;
		$this->view->show('em_selectById');
		$token = sha1(uniqid(rand(),true));
		echo $token;
	}
	else echo "error";
	}
	public function select_all()
	{
		$this->registry->view->em = new employeeModel();
		$this->registry->view->show('em_select_all');
	}
}