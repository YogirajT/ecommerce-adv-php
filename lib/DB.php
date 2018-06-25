<?php

class DB
{
	private $link ;
	private $result;


	function __construct()
	{
		$this->link = new mysqli("localhost","id4320056_ecom","admin123@","id4320056_ecom");
	}

	function query($sql)
	{
		$this->result = $this->link->query($sql) ;
		return $this->result ;
	}
	function rows()
	{
		return $this->result->num_rows ;
	}
	function toObject()
	{
		return $this->result->fetch_object();
	}

	function transact($transactions)
	{
		$this->link->autocommit(FALSE);
		foreach($transactions as $v):
		$this->result = $this->link->query($v) ;
		endforeach;
		$this->link->commit();
		$this->link->autocommit(TRUE);
		return $this->result;
	}
}

?>
