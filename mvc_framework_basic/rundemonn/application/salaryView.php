<?php

class SalaryView extends baseView
{
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
