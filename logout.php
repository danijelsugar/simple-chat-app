<?php 
	include_once "config.php";
/*
	==============================
		Destroy session and 
		redirects to home page
	==============================
*/
	unset($_SESSION["user"]);
	header("location: index.php");