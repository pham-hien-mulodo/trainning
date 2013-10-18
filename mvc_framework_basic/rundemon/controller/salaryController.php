<?php
require_once(__SITE_PATH."/application/Controller_base.class.php");
require_once(__SITE_PATH."/model/salaryModel.php");
//require_once(__SITE_PATH."/model/employeeModel.php");
class salaryController extends baseController
{
	public function index()
	{
	//	echo "access";
		$sa= new SalaryModel();
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
	var_dump($data['id']);
	$data['process'] ='delete';
	$data['colum'] = 'salary';
	$data['colums'] = 'employee';

	date_default_timezone_set('Asia/Bangkok');
	$sa = new SalaryModel();
	if(!empty($data['token']) && $data['token'] == $_SESSION['token']){
	$sa = $sa->delete($data);
	if(!isset($sa))
	{
		echo "error !";
	}
	else echo $sa;
	}
}


	public function insert($param)
	{	foreach($param as $key=>$value)
		{
			$data[$key] = $value;
		}
		var_dump($param);
		$sa = new salaryModel();
		$this->view->token = $param['token'];
		$this->view->show('inserts');
	}
	public function insertkq($param)
	{
		echo "vao dc insert kw";
		var_dump($param);
		foreach($param as $key=>$value)
		{
			$data[$key] = $value;
		}
	//	$token = $_SESSION['token'];
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
			$this->view->token = $token;
			var_dump($result);
			$this->view->show('insert_kq');
		}
		else return 0;}}
	}
	public function update($param)
{
	foreach($param as $key=>$value)
	{
		$data[$key] = $value;
	}
//	$token = $_SESSION['token'];
	var_dump($data);
		$salary = new SalaryModel();
	if($data['token'] == $_SESSION['token']){
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
	$result= $salary->update($result);
	if(!isset($result))
	{
		echo "error";
	}
	else echo $result;

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
	$sa = new SalaryModel();
	$result= $sa->selectById($data);
	$this->view->data = $result;
	if(isset($result))
	{
		$this->view->token = $token;
		$this->view->show('selects');
		$token = sha1(uniqid(rand(),true));
		echo $token;
	}
	else echo "error";
	}
	public function select_all()
	{
		$this->view->sa = new salaryModel();
		$this->view->show('sa_select_all');
	}

}

