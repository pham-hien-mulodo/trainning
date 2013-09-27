<?php 
class blogModel Extends baseModel 
{
	public function get_blogs()
	{
		global $db;
		$blog = $db->query('select id, name, title from employee');
		return $db->fetch_object();
		
	}
}
?>
