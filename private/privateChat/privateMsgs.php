<?php include_once "../../config.php"; 
if(!isset($_SESSION["user"])){
	header("location: " . $pathAPP . "logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo $pathAPP ?>css/style.css">
	<style>
		.form-field {
			padding: 0;
			margin: 0px;
			border: none;
			display: flex;
		}
		.form-field input {
			flex-basis: 80%;
			height: 25px;
			border: none;
		}
		.form-field a {
			flex-basis: 20%;
			background-color: #fff;
			color: #336699;
			text-decoration: none;
			text-align: center;
		}
		.fa-2x {
		    font-size: 1.5rem;
		}
	</style>
	<title>Document</title>
</head>
<body>
	<div class="home-wrapper">
		<div class="home-chat">
			<div class="sidebar">
				<div class="sidebar-top">
					<p><?php echo $_SESSION["user"]->username; ?></p>
					<ul>
						<?php 

							$query = $connect->prepare("select * from signup");
							$query->execute();
							$result = $query->fetchAll(PDO::FETCH_OBJ);
							foreach($result as $row):
						?>
						<li><a href="#"><?php echo $row->username; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
				<div class="sidebar-bottom">
					<a href="<?php echo $pathAPP; ?>logout.php"><i class="fas fa-power-off"></i> Logout</a>
				</div>
			</div>
			<div class="chat">
				<div class="output" id="output"></div>
				<div class="input-area">
					<form action="#" method="POST">
						<div class="form-field">
							<input autocomplete="off" type="text" name="msg" id="msg" placeholder="Enter your message">
							<a href="#" class="send-msg" id="user_<?php echo $_SESSION["user"]->username; ?>"><i class="far fa-share-square fa-2x"></i></a>
						</div>
					</form>
				</div>
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
			        url: "sendPrivateMsg.php",
			        data: {id:uid,msg:msg}
			        
			    });
			    return false;
		    });

		   	
		   	

	   		var oldscrollHeight = $("#output")[0].scrollHeight;

	   		var reciver = '<?php echo $_GET["user"] ?>';
	   		var sender = $(".send-msg").attr("id").split("_")[1];
	   		console.log(sender);
	    	$.ajax({
	        type: "POST",
	        url: "allPrivateMsgs.php",
	        //data: "reciver=" + reciver + "," + "sender=" + sender,
	        data: {reciver: reciver, sender: sender},
	        	success: function(data){
	        		console.log(data);
	        		if(data != $("#output").text()){
				        $("#output").append(data);
				    }

		        	/*var posts = JSON.parse(data);
			           
		        	var message = "";
		        	$.each(posts,function(key,value){

		        		message += "<div>";
		        		message += "<p>" + value.username + ": </p>";
		        		message += "<p>" + value.msg + "</p>";
		        		message += "<p>" + value.published + "</p>";
		        		message += "</div>";


		        	});

		        	$("#output").append(message);*/

		        	var newscrollHeight = $("#output")[0].scrollHeight;
			            if(newscrollHeight > oldscrollHeight){
			                $("#output").scrollTop($("#output")[0].scrollHeight);
			            }

	        	}
		        
		    });
			

		});

		
		



	</script>

	
</body>
</html>