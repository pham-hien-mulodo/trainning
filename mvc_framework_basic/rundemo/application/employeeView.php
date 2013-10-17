<?php
class EmployeeView extends baseView
{
	public function show($process)
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
}