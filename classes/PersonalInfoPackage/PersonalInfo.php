<?php
class PersonalInfo
{
	private $Name;
	private $LastName;
	private $Address;
	private $EnteredYear;
	private $Nationality;
	private $TelephoneNum;
	
	public function __construct($id)
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