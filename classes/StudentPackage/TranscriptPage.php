<?php
include_once 'Student.php';
session_start();
	if(!isset($_SESSION['userName'])){
		header("location:../../main_login.php");
	}
	else{
	}
	$transcript = $_SESSION['Student']->getTranscript();
?>