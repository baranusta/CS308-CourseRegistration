<?php
class PersonalInfo
{
	private $Name;
	private $LastName;
	private $Address;
	private $EnteredYear;
	private $Nationality;
	private $TelephoneNum;
	
	public function __construct($name, $LName, $entY, $address = null, $nation = null, $telNum = null)
	{
		$this->Name = $name;
		$this->LastName = $LName;
		$this->Address = $address;
		$this->Nationality = $nation;
		$this->TelephoneNum = $telNum;
		$this->EnteredYear = $entY;
	}
}
?>