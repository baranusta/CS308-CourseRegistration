<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once 'StudentPackage/Student.php';
include_once 'DBFunctions.php';
	session_start();
	session_destroy();
	$tableName = 'schedule.user';
	$username=$_POST['myusername']; 
	$password=$_POST['mypassword']; 
	if(UserIsExist($username,$password,$User,$tableName)){
		// Register $myusername, $mypassword and redirect to file "login_success.php"
		
		// if(!isset($_SESSION)){
			session_start();
		// }
		$_SESSION['userName'] = $username;
		$_SESSION['myUser'] = $User;
		$_SESSION['ActiveTerm'] = '201402';
		header("location:login_success.php");
	}
	else {
		echo "Wrong Username or Password";
	}
	
	
	
	
	function UserIsExist(&$userName,&$password,&$User,$tableName){
		$currentTerm = '201402';
		DBFunctions::SetRemoteConnection();
		$userName = stripslashes($userName);
		$password = stripslashes($password);
		$userName = mysql_real_escape_string($userName);
		$password = mysql_real_escape_string($password);
		$sql="SELECT * FROM $tableName WHERE username='$userName' and password='$password'";
		
		$result=mysql_query($sql);
		DBFunctions::CloseConnection();
		
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		if($count==1){
			while($row = mysql_fetch_assoc($result)) {
				$type = $row['type'];
				switch ($type)
				{
					case 'S':
						try
						{
							$User = new Student($row['user_id'],$currentTerm);
							// echo var_dump($User->getTakenCourses());
						}
						catch(Exception $e)
						{
							echo $e->getMessage();
						}
						break;
					// case 'P':
						// $_SESSION['myUser'] = new Professor();
						// break;
					// case 'A':
						// $_SESSION['myUser'] = new Admin();
						// break;
				}
			return true;
			}
		}
		// If result matched $myusername and $mypassword, table row must be 1 row
		return false;
	}
?>