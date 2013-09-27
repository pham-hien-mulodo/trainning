<?php
class indexController extends baseController
{
	public function index()
	{
		$this->registry->template->wellcome = 'wellcome hehe';
		$this->registry->template->show('index');
	}
}
?>
