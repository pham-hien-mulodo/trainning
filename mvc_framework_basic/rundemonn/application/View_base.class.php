<?php

class baseView {

private $vars = array();


 public function __set($index, $value)
 {
        $this->vars[$index] = $value;
 }
 abstract function show($process);
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
 
 

}



?>
