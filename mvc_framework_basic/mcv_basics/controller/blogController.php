<?php
class blogController extends baseController
{
	public function index()
	{
	$this->registry->template->blog_heading = 'this is log heading';
	$this->registry->template->show('blog_index');
	
	}
	public function view()
	{
		$this->registry->template->blog_heading = 'this is blog heading';
		$this->registry->template->blog_content = 'this is blog content';
		$this->registry->template->show('blog_view');
	}
}

?>