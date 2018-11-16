<?php

	include_once "../../config.php";


	$msg = $_POST["msg"];
	$msg = htmlspecialchars($msg);

	$query = $connect->prepare("insert into privatemsg(toid,fromid,msg) values 
								(:toid,:fromid,:msg)");
	$query->execute(array(
		"toid"=>$_POST["recipientId"],
		"fromid"=>$_POST["senderId"],
		"msg"=>$msg
	));

