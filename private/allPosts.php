<?php 
	
	include_once "../config.php";

	$query = $connect->prepare("select a.id, a.msg, b.username, a.published from posts a 
								inner join signup b 
								on a.username=b.uid");
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_OBJ);
	echo json_encode($result);
