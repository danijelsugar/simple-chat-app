<?php 
	
	include_once "../config.php";

	$query = $connect->prepare("select a.id, a.msg, b.username, a.published from posts a 
								inner join signup b 
								on a.username=b.uid 
								order by a.published");
	$query->execute();
	$result = $query->fetchAll(PDO::FETCH_OBJ);
	foreach($result as $row){
		echo "<div>";
		echo "<p class='username'>" . $row->username . "</p>" . "<p class='msg'>" . $row->msg . "</p>" . "<p class='published'>" . $row->published . "</p>";
		echo "</div>";
	}
	//echo json_encode($result);
