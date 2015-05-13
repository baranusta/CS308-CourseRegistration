<?php
class User
{
	protected $username;
	protected $password;
	protected $userType;
	
	public function __construct($Username=null, $Password=null, $type=null)
	{
		$this->username = $Username;
		$this->password = $Password;
		$this->userType = $type;
	}
}
?>