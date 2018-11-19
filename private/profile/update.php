<?php include_once "../../config.php"; 
if(!isset($_SESSION["user"])){
	header("location: " . $pathAPP . "logout.php");
}

	print_r($_POST);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo $pathAPP; ?>css/component.css">
	<link rel="stylesheet" href="<?php echo $pathAPP ?>css/style.css">
	<style>
		.form-field {
			border: none;
		}
	</style>
</head>
<body>
	<div class="menu-wrap">
		<div id="dl-menu" class="dl-menuwrapper">
			<button class="dl-trigger">Open Menu</button>
			<ul class="dl-menu">
				<li><a href="update.php">Profile settings</a></li>
				<li><a href="index.php">Back to profile</a></li>
				<li><a href="<?php echo $pathAPP ?>private/home.php">Back to chat</a></li>
				<li><a href="delete.php?uid=<?php echo $_SESSION["user"]->uid; ?>">Delete account</a></li>
			</ul>
		</div><!-- /dl-menuwrapper -->
	</div>

	<div class="profile-settings-wrap">
		<div class="profile-settings">
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST" enctype="multipart/form-data">
				<div class="form-field">
					<label for="username">username</label>
					<input type="text" name="username">
				</div>
				<div class="form-field">
					<label for="email">email</label>
					<input type="email" name="email">
				</div>
				<div class="form-field">
					<label for="desc">Description</label>
					<textarea name="desc" id="desc" cols="30" rows="10"></textarea>
				</div>
				<div class="form-field">
					<label for="image">Profile image</label>
					<input type="file" name="image">
				</div>
				<input type="submit" name="Update" value="Update">
			</form>
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