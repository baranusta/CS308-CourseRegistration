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
		return $conn;
	}
	public static function SetRemoteConnection()
	{
		self::$conn = mysql_connect("94.73.146.238", "siyabo", "qwerfdsa", "schedule");
		if (!self::$conn) {
			die('Connect Error ('.mysql_error().')');
		}
mysql_query("SET NAMES utf8");
		mysql_query("SET CHARACTER SET utf8");
	}
	public static function CloseConnection()
	{
		mysql_close(self::$conn);
	}
}
?>