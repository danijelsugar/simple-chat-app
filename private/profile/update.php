<?php include_once "../../config.php"; 
	if(!isset($_SESSION["user"])){
		header("location: " . $pathAPP . "logout.php");
	}

	if(!isset($_GET["uid"]) && !isset($_POST["uid"])){
	  	header("location " . $pathAPP . "logout.php");
	}

	$error = array();
	if(isset($_POST["Update"])){

		if(trim($_POST["username"])===""){
		    $error["username"] = "Required entry!";
		}

		if(strlen($_POST["username"])>50){
		    $error["username"] = "The username contains too many characters.";
		}

		$imageError = array();

		if(isset($_FILES["image"])){

			$file = $_FILES["image"];

			$fileName = $file["name"];
			$fileTmpName = $file["tmp_name"];
			$fileSize = $file["size"];
			$fileError = $file["error"];
			$fileType = $file["type"];

			$fileExt = explode(".", $fileName);
			$fileActualExt = strtolower(end($fileExt));

			$allowed = array("jpeg","jpg","png");

			if(in_array($fileActualExt, $allowed)){
				if($fileError === 0){
					if($fileSize < 1500000){
						$fileNewName = $_SESSION["user"]->uid . "." . $fileActualExt;
						$fileDestination ="../../img/uploads/" . $fileNewName;
						move_uploaded_file($fileTmpName, $fileDestination);
					}else{
						$imageError[] = "Size too big";
					}
				}else{
					$imageError[] = "Error";
				}
			}else{
				$imageError[] = "Extension not allowed, please choose a JPEG or PNG file.";
			}
		}
		   

		if(count($error)===0){
			$query = $connect->prepare("update signup set username=:username, 
										description=:description, 
										image=:image 
										where uid=:uid");
			$query->bindParam(":uid",$_POST["uid"]);
			$query->bindParam(":username",$_POST["username"]);

			if($_POST["description"]===""){
				$query->bindValue(":description",null,PDO::PARAM_STR);
			}else{
				$query->bindParam(":description",$_POST["description"]);
			}

			if($fileSize===0){
				$query->bindValue(":image", $pathAPP . "img/uploads/" . "nepoznato.png" );
			}else {
				$imagePath = $pathAPP . "img/uploads/" . $fileNewName;
				$query->bindParam(":image", $imagePath);
			}

			$query->execute();
			header("location: index.php");
			
			
			
		}


	} else {
		$query = $connect->prepare("select * from signup where uid=:uid");
		$query->execute($_GET);
		$_POST = $query->fetch(PDO::FETCH_ASSOC);
	}
	
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
					<input type="text" name="username" value="<?php echo $_POST["username"]; ?>">
				</div>
				<div class="form-field">
					<label for="email">email</label>
					<input type="email" name="email" value="<?php echo $_POST["email"]; ?>">
				</div>
				<div class="form-field">
					<label for="description">Description</label>
					<textarea name="description" id="description" cols="30" rows="10""><?php echo $_POST["description"]; ?></textarea>
				</div>
				<div class="form-field">
					<label for="image">Profile image</label>
					<input type="file" name="image">
				</div>
				<input type="hidden" name="uid" value="<?php echo $_POST["uid"]; ?>">
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