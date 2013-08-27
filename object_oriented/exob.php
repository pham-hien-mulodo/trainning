<?php
class Person
{
	private $_name;
	private $_job;
	private $_age;
	
	public function __construct($name,$job,$age)
	{
		$this->_name= $name;
		$this->_job = $job;
		$this->_age = $age;
	}
	public function changeJob($newjob)
	{
		$this->_job = $newjob;
	}
	public function happyBirthday()
	{
		++$this->_age;
	}
}

$person1 = new Person("hien 1 ", "IT", 24);
$person2 = new Person("hien 2" , "information Technology", 25);

echo "<pre>person 1:", print_r($person1, TRUE),"</pre>";
echo "<pre>person 2:", print_r($person2, TRUE),"</pre>";

$person1 -> changeJob('Information Technology');
$person1 -> happyBirthday();

$person2 -> happyBirthday();

echo "<pre> Person 1 : " , print_r($person1, TRUE), "</pre>";
echo "<pre> Preson 2 : ", print_r($person2, TRUE), "</pre>";
/*
class A
{
	static private $autoSave;
	static public function init($autoSave)
	{
		self::$autoSave = $autoSave;
	}
	static public function save()
	{
		return save();
	}
	
}

class B
{
	static public function init($autoSave)
	{
		self::$autoSave = $autoSave;
		new B();
	}
	static public function destruct()
	{
		if(self::$autoSave)
		self::save();
	}
	public function __destruct()
	{
		B::destruct();
	}
}


/**
*Class example object
* @author Pham Hien <pham.hien@mulodo.com>
* @copyright 2013
* @license
*/
/*
class Myclass
{
	public $key = " test class";
	public static $count = 0;
	public function __construct()
	{
		echo 'the class "',__CLASS__, '" was initiated ! '."\n";
	}
	public function __destruct()
	{
		echo 'The class "',__CLASS__,'" was destroyed'."\n";
	}
	public function __toString()
	{
		echo "using the to string method: ";
		return $this->getproperty();
	}
	public function setproperty($newval)
	{
		/**
		* set property
		* @param string $newval 
		* @return string
		*//*
		$this->key = $newval;
	}
	private function getproperty()
	{
		return $this->key."\n";
	}
	public static function plusOne()
	{
		return "the count is ". ++self::$count ." \n";
	}
}


class MyOtherClass extends MyClass
{
	public function __construct()
	{
		parent::__construct();
		echo " A new constructor in ".__CLASS__."  \n";
	}
	public function newMethod()
	{
		echo "From a new method in ".__CLASS__."  \n";
	}
	public function callProtected()
	{
		 return $this->getproperty();
	}
}

do
{
	echo MyClass::plusOne();
}while ( MyClass::$count<10 );

$newobj = new MyOtherClass;
//echo $newobj->newMethod();
echo $newobj->callProtected();

$object = new Myclass;
//$obj = new Myclass;

echo $object;

unset($object);

echo "end of file  ";
//echo $obj->getproperty();
$object->setproperty("i'm a new  property value ! ");
$obj->setproperty("ibelong to the second instance !");
echo $object->getproperty();
echo $obj->getproperty();
//var_dump($object);
//echo $object->key;*/
