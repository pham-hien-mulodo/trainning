<?php
session_start();
	require_once 'model.php';
	$name = '';
	$name = '';
	$title = '';
	$created = time();
	$modified = time();	
	$day = '';
	$month = '';
	$year = '';

	
 	 if(isset($_POST['name']))
    {
        $name = $_POST['name'];
    }
	 if(isset($_POST['title']))
    {
        $title = $_POST['title'];
    }
	 if(isset($_POST['day']))
    {
        $day = $_POST['day'];
    }
	 if(isset($_POST['month']))
    {
        $month = $_POST['month'];
    }
	 if(isset($_POST['year']))
    {
        $year = $_POST['year'];
    }
	$created = mktime(0,0,0, $month, $day, $year);
	$modified = mktime(0,0,0, $month, $day, $year);
	if($name != '')
	{
		$data = array(
						'id' => $id,
						'name'=> $name,
						'title'=> $title,
						'created'=> $created,
						'modified'=> $modified);
		if(isset($_GET['id']))
		{
   			$user_id = $_GET['id'];
   			delete($id);
		}
	}
	else
	{
		$error_name ='again name';
	}