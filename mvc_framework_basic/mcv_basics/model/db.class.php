<?php
	class db
	{
		private static $instance = NULL;
		public function __constuct()
		{
			
		}
		public static function getInstance()
		{
			if(!self::$instance)
			{
				self::$instance = new PDO("mysql:host = localhost; dbname = php_basics", 'root','');
				self::$instance -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
			}
			return self::$instance;
		}
		private function __clone()
		{
		}
	
	}
	
?>