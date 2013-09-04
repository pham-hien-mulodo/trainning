<?php
require_once('interface.php');
require_once('Salary.php');
require_once('abstractModel.php');
class vidu extends aModel
{
	//private $mysqli;
	public function __construct(){

	}
	protected function calldbConnect()
	{
		return $this->dbConnect();
	}
	protected function calldbClose()
	{
		return $this->dbClose();
	}
	public function delete($data)
	{
		$mysqli = new mysqli('localhost', 'user', 'pass','databse');
		$mysql->autocommit(FALSE);
		$stmt->$mysqli->prepare("");
		$stmt->bind_param();
		$stmt->execute();
		$stmt->close();
		
	}
}