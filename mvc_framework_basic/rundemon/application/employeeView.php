<?php
class EmployeeView extends baseView
{
	public function show($process)
{
	 if($process == 'em_delete')
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
	 if($process == 'em_insert')
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
	  if($process == 'em_insertkq')
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
		 $path = __SITE_PATH.'/views/em_'.$process.'.php';
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
	 if($process == 'em_index')
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
	 if($process == 'em_selectById')
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
}
}