<?php 

	session_start();

	switch($_SERVER["HTTP_HOST"]){
	    case "localhost":
		    $pathAPP="/chat_app/";
		    $connect = new PDO("mysql:host=localhost;dbname=chatapp","edunova","edunova");
	    break;
	    case "dsugar.byethost16.com":
		    $pathAPP="/Site/";
		    $connect = new PDO("mysql:host=sql304.byethost.com;port=3306;dbname=b16_21955356_croatia","b16_21955356","bogibatina13");
	    break;
	}

	$connect->exec("set names utf8;");