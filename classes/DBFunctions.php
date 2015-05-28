<?php

class DBFunctions
{
	
	private static $conn;
	
	public static function SetConnection()
	{
		$host="localhost";
		$username="root";
		$password="312152"; 
		$db_name="CS308"; 
		$conn = mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
		mysql_select_db("$db_name")or die("cannot select DB");
		
		mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
		return $conn;
	}
	public static function SetRemoteConnection()
	{
		self::$conn = mysql_connect("94.73.146.238", "siyabo", "qwerfdsa", "schedule");
		mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
		if (!self::$conn) {
			die('Connect Error ('.mysql_error().')');
		}
	}
	public static function CloseConnection()
	{
		mysql_close(self::$conn);
	}
}
?>