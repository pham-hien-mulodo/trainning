<?php

class SalaryView extends baseView
{
	 public function show($process)
 {
	
	 if($process=='em_delete')
	 {
		  $path = __SITE_PATH.'/views/'.$process.'.php';
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
	 if($process=='sa_insertkq')
	 {
		  $path = __SITE_PATH.'/views/'.$process.'.php';
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
	 if($process=='sa_insert')
	 {
		  $path = __SITE_PATH.'/views/'.$process.'.php';
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
	 if($process == 'update')
	 {
		  $path = __SITE_PATH.'/views/'.$process.'.php';
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
	 if($process == 'selectById')
	 {
		  $path = __SITE_PATH.'/views/'.$process.'.php';
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
	 if($process == 'sa_index')
	 {
		 $path = __SITE_PATH.'/views/sa_index.php';
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
	  if($process == 'error')
	 {
		 $path = __SITE_PATH.'/views/error.php';
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
