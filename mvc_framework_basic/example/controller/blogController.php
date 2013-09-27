<?php
class blogController Extends baseController 
{
	public function index($args=array())
	{
		$this->view->data['blogs'] = $this->model->get('blogModel')->get_blogs();
		$this->view->data['blog_heading'] = 'this is the blog Index';
		$this->view->data('blog_index');
		
	}
	public function view($args[1])
	{
		$id_blog = 
		$blog_detail = $this->model->get('blogModel')->get_blog_detail($id_blog);
		$this->view->data['blog_heading'] = $blog_detail->name;
		$this->view->data['blog_title'] = $blog_detail->title;
		$this->view->show('blog_view');
	}
}
?>