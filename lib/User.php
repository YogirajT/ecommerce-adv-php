<?php
require_once('DB.php');
class User extends DB
{
	private $data  ;
	public $error ;

	function __construct()
	{
		parent::__construct();
		$this->data = [];
		$this->error = false;
	}

	function __set($name,$value)
	{
		if(!empty($value))
			$this->data[$name] = $value ;
		else
			$this->error[$name] = "$name is required" ;
	}

	function __get($name)
	{
		return $this->data[$name] ;
	}

	function save()
	{
		$now = time();
		$sql = "INSERT INTO users VALUES (NULL,'{$this->data['full_name']}','{$this->data['email']}',sha1('{$this->data['password']}'),0,$now)" ;
		if($this->query($sql) == 1)
		{
			return true ;
		}else {
			return false ;
		}
	}

	function login()
	{
		$sql = "SELECT * FROM users WHERE email = '{$this->data['email']}' and password = sha1('{$this->data['password']}')" ;
		$this->query($sql);
		return $this->rows() ;
	}

}

?>
