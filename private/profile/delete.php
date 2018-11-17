<?php 

	include_once "../../config.php";

	if(!isset($_SESSION["user"])){
		header("location: " . $pathAPP . "logout.php");
	}

	if(!isset($_GET["uid"])){
		header("location: " . $pathAPP . "logout.php");
	}

	$query = $connect->prepare("delete from signup 
							where uid=:uid");
	$query->execute($_GET);
	header("location: ../../index.php");
