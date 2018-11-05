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
			<div class="output" id="output"></div>
			<div class="input-area">
				<form action="#" method="POST">
					<textarea name="msg" id="msg" cols="30" rows="10"></textarea>
					<a href="#" class="send-msg" id="user_<?php echo $_SESSION["user"]->uid; ?>">Send</a>
				</form>
			</div>
		</div>
	</div>
	<script src="<?php echo $pathAPP ?>js/jquery.js"></script>
	<script>


		$(document).ready(function(){
		    var uid;
		    var msg;
		    $(".send-msg").click(function(){
			    uid = $(this).attr("id").split("_")[1];
			    msg = $("#msg").val();
			    $("form").trigger("reset");
			    
			    $.ajax({
			        type: "POST",
			        url: "sendMsg.php",
			        data: {id:uid,msg:msg}
			        
			    });
			    return false;
		    });

		    setInterval(function () {
		    	$.ajax({
		        type: "POST",
		        url: "allPosts.php",
		        success: function(data){

		        	var posts = JSON.parse(data);
			           
		        	var message = "";
		        	$.each(posts,function(key,value){

		        		message += "<div>";
		        		message += "<p>" + value.username + ": </p>";
		        		message += "<p>" + value.msg + "</p>";
		        		message += "<p>" + value.published + "</p>";
		        		message += "</div>";


		        	});

		        	$("#output").append(message);

		        }
		        
		    	});
		    }, 3000);

			$.ajax({
		        type: "POST",
		        url: "allPosts.php",
		        success: function(data){

		        	var posts = JSON.parse(data);
			           
		        	var message = "";
		        	$.each(posts,function(key,value){

		        		message += "<div>";
		        		message += "<p>" + value.username + ": </p>";
		        		message += "<p>" + value.msg + "</p>";
		        		message += "<p>" + value.published + "</p>";
		        		message += "</div>";


		        	});

		        	$("#output").append(message);

		        }
		        
		    });

		});

		window.onload=function () {
		    var objDiv = document.getElementById("output");
		    objDiv.scrollTop = objDiv.scrollHeight;
		}

	</script>

	
</body>
</html>