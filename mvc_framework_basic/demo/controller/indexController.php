<?php
class indexController Extends baseController
{
 public function index()
 {
	 $this->registry->view->welcome = 'welcome to employee and salary ' ;
	 $this->registry->view->show('index');
 }
}
?>
