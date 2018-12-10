<?php 
	
	include_once "../../config.php";

	


	$query = $connect->prepare("select a.id, b.username as reciver, c.username as sender, a.msg, a.timesent from privatemsg a
								inner join signup b 
								on a.toid=b.uid 
								inner join signup c 
								on a.fromid=c.uid where b.username=:reciver and c.username=:sender 
								or b.username=:sender and c.username=:reciver 
								order by a.timesent");
	
	$query->execute(array(
		"reciver"=>$_POST["reciver"],
		"sender"=>$_POST["sender"]
	));
	$result = $query->fetchAll(PDO::FETCH_OBJ);
	
	echo json_encode($result);