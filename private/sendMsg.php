<?php

	include_once "../config.php";


	$msg = $_POST["msg"];
	$msg = htmlspecialchars($msg);

	$query = $connect->prepare("insert into posts(msg,username) values 
								(:msg,:username)");
	$query->execute(array(
		"msg"=>$msg,
		"username"=>$_POST["id"]
	));

