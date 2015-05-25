<html>
<head>
    <title>Admin - Search and Delete Users</title>
    <meta charset="utf-8" /> 
	
</head>
<body>
<?php
set_include_path(get_include_path() . PATH_SEPARATOR . 'C:\xampp\htdocs\CS308-CourseRegistration\classes');
include_once '../CoursePackage/CourseController.php';
include_once 'AdminPackage/Admin.php';


$Admin = new Admin();//new admin object created

/* $new = array(
'asd' => array(),
1 => 2,
2 => 3,
3 => 4,
4 => 5
);
$asd = array(55,66);
var_dump($asd);
echo "<br>";
array_push($new['asd'], $asd);
$new = json_encode($new);

var_dump($new); */



if(isset($_POST['deleteIds']))
{
	$deleteUserIds = $_POST['deleteIds'];
	$Admin->DeleteUserById($deleteUserIds);
	unset($_POST['deleteIds']);

}

if(isset($_POST['clr']))
{
	unset($_POST['firstname']);
	unset($_POST['lastname']);
	unset($_POST['username']);
}



if(!isset($_POST['firstname']) || !isset($_POST['lastname'])|| !isset($_POST['username'] ))
{
?>
<!--Search via Original Name Surname--->
<form action="AdminUser.php" method="POST">
User name:<br>
<input type="text" name="username">
<br>
First name:<br>
<input type="text" name="firstname">
<br>
Last name:<br>
<input type="text" name="lastname">
<br><br>
<input type="submit" value="Search">
</form>

<!---END OF FORM POST REQUEST---->
<?php
}
else//post request has been sent
{
/* 	echo "<br>user:".$_POST['username'];
	echo "<br>first:".$_POST['firstname'];
	echo "<br>last:".$_POST['lastname']."<br>"; */
	
	$userInfoArray = array();//store posted info
	if(!empty($_POST['firstname']) && empty($_POST['lastname']))//if just first name entered
	{	//echo "LOL1<br>";
		$userInfoArray['firstname'] = $_POST['firstname'];
	}
	else if(!empty($_POST['lastname']) && empty($_POST['firstname']))//if just first surname entered
	{//echo "LOL2<br>";
		$userInfoArray['lastname'] = $_POST['lastname'];
	}
	else if(!empty($_POST['lastname']) && !empty($_POST['firstname']))//both name and and surname entered
	{//echo "LOL3<br>";
		$userInfoArray['lastname'] = $_POST['lastname'];
		$userInfoArray['firstname'] = $_POST['firstname'];
	}
	else if(!empty($_POST['username']))//if username entered
	{//echo "LOL4<br>";
	//echo $_POST['username']."<br>";
		$userInfoArray['username'] = $_POST['username'];
	}
	else//list all users
	{//echo "LOL5<br>";
		$resultSet = $Admin->ListAllUsers(null);//all users object called
	}
	
	if(!empty($userInfoArray))
	{//echo "LOL6<br>";
		$resultSet = $Admin->SearchUser($userInfoArray);
	}
	
	
	echo "<form id='userInfo' action='AdminUser.php' method='POST'>";
	foreach($resultSet as&$value)
	{
		//var_dump($value[0][0]);
		$userId = $value[0][0];
		echo "<input type='checkbox' name='deleteIds[]' value='$userId' />";
		echo "UserId: ".$value[0][0]."<br>";
		echo "First Name: ".$value[0][1]."<br>";
		echo "Last Name: ".$value[0][2]."<br>";
		echo "User Name: ".$value[1][1]."<br>";
		echo "Password: ".$value[1][2]."<br>";
		echo "User Type: ".$value[1][3]."<br>";
		echo "------------------------<br>";

		
		//echo "id: ".$value[0]."---firstname: ".$value[1]."---lastname: ".$value[2]."<br>";
		
	}
	echo "<input id='userInfo' type='submit'  value='Delete' '>";
	echo "<form id='selectedUsers' action='AdminUser.php' method='POST'>";
	echo "<input type='text' name='clr' hidden='true'>";
	echo '<input type="submit" value="Go Back"></form>';

	//echo "<br><br><input type='submit' value='Delete'>

	
}



?>


</body>
</html>