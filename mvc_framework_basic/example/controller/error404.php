<?php
class error404Controller Extends baseController
{
	public function index()
	{
		$this->view->data['blog_heading'] = this is the 404';
		$this->view->show('error404');
	}
}