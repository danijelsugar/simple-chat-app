<?php 
	print_r($_POST);
	if(!isset($_POST["username"])){
		exit;
	}

	include_once "config.php";

	if($_POST["username"]===""){
		header("location: index.php?msg=2");
		exit;
	}

	$query = $connect->prepare("select * from signup where username=:username");
	$query->execute(array("username"=>$_POST["username"]));

	$user = $query->fetch(PDO::FETCH_OBJ);
	print_r($user);

	if($user !=null && $user->pass==password_verify($_POST["password"],$user->pass)){
		//pusti dalje
		$user->pass="";
		$_SESSION["user"]=$user;
		header("location: private/home.php");
	}else {
		header("location: index.php?msg=1");
	}