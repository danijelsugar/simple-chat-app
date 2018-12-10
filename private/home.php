<?php include_once "../config.php"; 
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
					<div class="siderbar-top-user-profile">
						<ul class="user">
							<li>
								<a href="#"><?php echo $_SESSION["user"]->username; ?> <i class="fas fa-sort-down"></i></a>
								<ul>
									<li><a href="profile/index.php">Profile</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="siderbar-top-users">
						<ul>
							<?php 
								// Lists all registered users 

								$query = $connect->prepare("select * from signup");
								$query->execute();
								$result = $query->fetchAll(PDO::FETCH_OBJ);
								foreach($result as $row):
									if($row->username===$_SESSION["user"]->username){
										continue;
									}
							?>
							<li>
								<a href="<?php echo $pathAPP; ?>private/privateChat/privateMsgs.php?user=<?php echo $row->username; ?>
								&uid=<?php echo $row->uid; ?>"><?php echo $row->username; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<div class="sidebar-bottom">
					<a href="<?php echo $pathAPP; ?>logout.php"><i class="fas fa-power-off"></i> Logout</a>
				</div>
			</div>
			<div class="chat">
				<form action="">
					<div class="search-bar">
						<input type="search" name="condition" id="condition">
					</div>
				</form>
				<div class="output" id="output"></div>
				<div class="input-area">
					<form action="#" method="POST">
						<div class="form-field">
							<input autocomplete="off" type="text" name="msg" id="msg" placeholder="Enter your message">
							<a href="#" class="send-msg" id="user_<?php echo $_SESSION["user"]->uid; ?>"><i class="far fa-share-square fa-2x"></i></a>
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
		    //send msg with ajax
		    $(".send-msg").click(function(){
			    uid = $(this).attr("id").split("_")[1];
			    msg = $("#msg").val();
			    $("form").trigger("reset");
			    
			    $.ajax({
			        type: "POST",
			        url: "sendMsg.php",
			        data: {id:uid,msg:msg},
			        	success: function(response){
			        		var lastID = response;
			        	}
			    });
			    return false;
		    });

		   	
		   	

		   		var oldscrollHeight = $("#output")[0].scrollHeight;
		   		//retrives all messages with ajax
		   		$.ajax({
		        type: "POST",
		        url: "allPosts.php",
		        	success: function(data){
	 		        	var jsonData = JSON.parse(data);
	 		        	var jsonLength = jsonData.length;
				           
			        	var message = "";
			        	for ( var i = 0; i < jsonLength; i++ ){
			        			var result = jsonData[i];
		 		        		message += "<div>";
				        		message += "<p class='username'>" + result.username + ": </p>";
				        		message += "<p class='msg'>" + result.msg + "</p>";
				        		message += "<p class='published'>" + result.published + "</p>";
				        		message += "</div>";
		 		        	
			        	}
			        	
	 		        	$("#output").append(message);

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