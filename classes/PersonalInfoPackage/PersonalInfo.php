<?php
include_once '../User.php';

class PersonalInfo extends User
{
	protected $Name;
	protected $LastName;
	protected $Address;
	protected $EnteredYear;
	protected $Nationality;
	protected $TelephoneNum;
	protected $Faculty;
	
	public function __construct($name = null, $LName = null, $entY = null, $address = null, 
	$nation = null, $telNum = null, $faculty = null)
	{
		$this->Name = $name;
		$this->LastName = $LName;
		$this->Address = $address;
		$this->Nationality = $nation;
		$this->TelephoneNum = $telNum;
		$this->EnteredYear = $entY;
		$this->Faculty = $faculty;
	}
}
?>