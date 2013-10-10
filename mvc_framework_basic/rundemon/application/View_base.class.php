<?php

Class baseView {

private $vars = array();


 public function __set($index, $value)
 {
        $this->vars[$index] = $value;
 }
//viet lai ham: showemployee($process)
// showsalary($process)
//if($process == 'delete') { $path = __SITE_PATH.'/view'.'/'.$process.'.php'}
/*
function show($name) {

	$path = __SITE_PATH . '/views' . '/' . $name . '.php';

//	echo '<br/>'.$path;
	
	if (file_exists($path) == false)
	{
		throw new Exception('Template not found in '. $path);
		return false;
	}

	// Load variables
	foreach ($this->vars as $key => $value)
	{
		$$key = $value;
	}

	include ($path);               
}
*/
 public function showEmployee($process)
 {
	 if($process == 'delete')
	 {
		 $path = __SITE_PATH.'/view/em_'.$process.'.php';
	 }
	 if($process == 'insert')
	 {
		 $path = __SITE_PATH.'/view/em_'.$process.'.php';
	 }
	 if($process == 'update')
	 {
		 $path = __SITE_PATH.'/view/em_'.$process.'.php';
	 }
	 if($process == 'selectById')
	 {
		 $path = __SITE_PATH.'/view/em_'.$process.'.php';
	 }
	 if($process == 'select_all')
	 {
		 $path = __SITE_PATH.'/view/em_'.$process.'.php';
	 }
 }
 
 public function showSalary($process)
 {
	
	 if($process=='delete')
	 {
		 $path = __SITE_PATH.'/view/sa_'.$process.'.php';
	 }
	 if($process=='insert')
	 {
		 $path = __SITE_PATH.'/view/sa_'.$process.'.php';
	 }
	 if($process == 'update')
	 {
		 $path = __SITE_PATH.'/view/sa_'.$process.'.php';
	 }
	 if($process == 'selectById')
	 {
		 $path = __SITE_PATH.'/view/sa_'.$process.'.php';
	 }
	 if($process == 'sa_index')
	 {
		 $path = __SITE_PATH.'/views/sa_index.php';
		 echo $path;
		 echo "</br>";
		 if (file_exists($path) == false)
		{
			echo "error--- template";
		}
		foreach ($this->vars as $key => $value)
		{
			$$key = $value;
		}
		include ($path);
	 }
 }

}



?>
