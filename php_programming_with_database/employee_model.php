<?php

session_start();

require_once 'insert.php';
require_once 'update.php';
require_once 'delete.php';
require_once 'select.php';
require_once 'connectdb.php';
class employee
{
    public $name = 'hien';
	public $title ='user';
	public $created = 'yyyy-mm-dd hh:ii:ss';
	public $modified = 'yyyy-mm-dd hh:ii:ss';
	public $data;
public function data()
{
	$data = array('name' => $name, 'title' => $title);
	return $data;
	}
public function delete($id)
{
    $sql = "DELETE FROM 'employee'
            WHERE 'id' = $id";
     $result = mysql_query($sql);
	 if(!mysql_error()) echo 'failed';
	return count($result);
}

public function insert($data)
{
	$sql = "INSERT INTO employee ('name' , 'title') VALUES ('".$this->data['name']."','".$this->data['title']."')";
    $result = mysql_query($sql);
	$sql1 = "SELECT LAST_INSERT_ID()";
    $result1 = mysql_query($sql1);
	return $result1;


}
public function update($data)
{
    $sql = "UPDATE 'employee' SET 'name' = '".$data['name']."', status = ".$data['status'].", modified = ".$data['modified']."";
         
    $result = mysql_query($sql);
 
    return count($result);
}
public function select_by_id($id=2)
{
   $sql = "SELECT * FROM 'employee' WHERE 'id'= $id";
   $result = mysql_query($sql);
	return $result;
}



}
public $employee =  employee();
$employee -> delete(2);
$employee -> insert();
$employee -> select_by_id();
$employee -> update();
