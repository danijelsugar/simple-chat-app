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
	<link rel="stylesheet" href="<?php echo $pathAPP; ?>css/component.css">
	<link rel="stylesheet" href="<?php echo $pathAPP ?>css/style.css">
</head>
<body>
	<div class="menu-wrap">
		<div id="dl-menu" class="dl-menuwrapper">
			<button class="dl-trigger">Open Menu</button>
			<ul class="dl-menu">
				<li><a href="update.php?uid=<?php echo $_SESSION["user"]->uid; ?>">Profile settings</a></li>
				<li><a href="<?php echo $pathAPP ?>private/home.php">Back to chat</a></li>
				<li><a href="delete.php?uid=<?php echo $_SESSION["user"]->uid; ?>">Delete account</a></li>
			</ul>
		</div><!-- /dl-menuwrapper -->
	</div>
	

	<div class="user-profile-wrap">
		<div class="user-profile">
			<div class="user-prfile-img">
				<img src="
				<?php
				
				if(file_exists("../../img/uploads/" . $_SESSION["user"]->uid . ".jpg" )){
					echo $_SESSION["user"]->image;
				}else{
					echo $pathAPP . "img/nepoznato.png";
				}

				?>" alt="Profile picture">
			</div>
			<div class="user-profile-info">
				<p>username: <?php echo $_SESSION["user"]->username; ?></p>
				<p>email: <?php echo $_SESSION["user"]->email; ?></p>
				<p>description: <?php echo $_SESSION["user"]->description; ?> </p>
			</div>
			
		</div>
	</div>

	<!-- SCRIPTS -->
	<script src="<?php echo $pathAPP; ?>js/jquery.js"></script>
	<script src="<?php echo $pathAPP; ?>js/modernizr.custom.js"></script>
	<script src="<?php echo $pathAPP; ?>js/jquery.dlmenu.js"></script>
	
	<script>
		$( '#dl-menu' ).dlmenu({
		  	animationClasses : { classin : 'animation-class-name', classout : 'animation-class-name' }
		});
	</script>
</body>
</html>