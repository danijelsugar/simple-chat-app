<?php

	include_once "../config.php";

	

	$query = $connect->prepare("insert into posts(msg,username) values 
								(:msg,:username)");
	$query->execute(array(
		"msg"=>$_POST["msg"],
		"username"=>$_POST["id"]
	));

