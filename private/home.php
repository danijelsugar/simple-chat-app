<?php include_once "../config.php"; 
if(!isset($_SESSION["user"])){
	header("location: " . $pathAPP . "logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="<?php echo $pathAPP ?>css/style.css">
	<title>Document</title>
</head>
<body>
	<div class="home-wrapper">
		<div class="top-bar">
			<p><?php echo $_SESSION["user"]->username; ?> - ONLINE</p>
			<a href="<?php echo $pathAPP ?>logout.php">Logout</a>
		</div>
		<div class="chat">
			<div class="output">
				<?php 

					$query = $connect->prepare("select a.id, a.msg, b.username, a.published from posts a 
												inner join signup b 
												on a.username=b.uid");
					$query->execute();
					$result = $query->fetchAll(PDO::FETCH_OBJ);
					foreach($result as $row):
				?>
				<div class="message">
					<p><?php echo $row->username; ?>:</p>
					<p><?php echo $row->msg; ?></p>
					<p><?php echo $row->published; ?></p>
				</div>
				<?php endforeach; ?>
			</div>
			<div class="input-area">
				<form action="#" method="POST">
					<textarea name="msg" id="msg" cols="30" rows="10"></textarea>
					<a href="#" class="send-msg" id="user_<?php echo $_SESSION["user"]->uid; ?>">Send</a>
				</form>
			</div>
		</div>
	</div>

	<script>
		$(document).ready(function(){
			var id;
			$(".send-msg").click(function(){
			    id=$(this).attr("id").split("_")[1];
			    
			    $.ajax({
			        type: "POST",
			        url: "sendMsg.php",
			        data: "uid=" + id + "&msg=" + msg,
			        success: function(data)
			    });
		    });
		}
	</script>
</body>
</html>