<?php 
	
	include_once "../../config.php";

	


	$query = $connect->prepare("select a.id, b.username as reciver, c.username as sender, a.msg, a.timesent from privatemsg a
								inner join signup b 
								on a.toid=b.uid 
								inner join signup c 
								on a.fromid=c.uid where b.username=:reciver and c.username=:sender or b.username=:sender and c.username=:reciver");
	$query->execute(array(
		"reciver"=>$_POST["reciver"],
		"sender"=>$_POST["sender"]
	));
	$result = $query->fetchAll(PDO::FETCH_OBJ);
	foreach($result as $row){
		echo "<div>";
		echo "<p class='username'>" . $row->sender . "</p>" . "<p class='msg'>" . $row->msg . "</p>" . "<p class='published'>" . $row->timesent . "</p>";
		echo "</div>";
	}
	//echo json_encode($result);