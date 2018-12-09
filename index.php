<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat me</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo $pathAPP; ?>css/style.css">
</head>
<body>
	<div class="wrapper">
		<div class="login-form">
			<h2>Login here:</h2>
			<form action="auth.php" method="POST">
				<div class="form-field">
					<i class="far fa-user fa-2x"></i><input autocomplete="off" type="text" id="username" name="username">
				</div>
				<div class="form-field">
					<i class="fas fa-lock fa-2x"></i><input type="password" id="password" name="password">
				</div>
				<input type="submit" value="Login">
			</form>
			<p>Dont have account? Register <a href="signup.php">here</a></p>
			<div class="error-msg">
				<?php 

					if(isset($_GET["msg"])){

						switch($_GET["msg"]){
							case "1":
								echo "<p>Username doesn't match our records. Please try again.</p>";
								break;
							case "2":
								echo "<p>Please enter a username.</p>";
								break;
							default:
								echo "";
								break;
						}

					}

				?>
			</div>
		</div>
	</div>
</body>
</html>