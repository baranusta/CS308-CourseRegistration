<?php
include_once '../User.php';

class PersonalInfo
{
	private $Name;
	private $LastName;
	private $Address;
	private $EnteredYear;
	private $Nationality;
	private $TelephoneNum;
	private $Faculty;
	
	public function __construct($id)
	{
		$this->Name = $name;
		$this->LastName = $LName;
		$this->Address = $address;
		$this->Nationality = $nation;
		$this->TelephoneNum = $telNum;
		$this->EnteredYear = $entY;
		$this->Faculty = $faculty;
	}
	public function getName()
	{
		return $this->Name;
	}
	public function getLastName()
	{
		return $this->LastName;
	}
	public function getAddress()
	{
		return $this->Address;
	}
	public function getEnteredYear()
	{
		return $this->EnteredYear;
	}
	public function getTelephoneNum()
	{
		return $this->TelephoneNum;
	}
	public function getFaculty()
	{
		return $this->Faculty;
	}
}
?>