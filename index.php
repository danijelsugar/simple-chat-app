<?php include_once "config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Chat me</title>
	<link rel="stylesheet" href="<?php echo $pathAPP; ?>css/style.css">
</head>
<body>
	<div class="wrapper">
		<div class="login-form">
			<h2>Login here:</h2>
			<form action="auth.php" method="POST">
				<div class="form-field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username">
				</div>
				<div class="form-field">
					<label for="password">Password</label>
					<input type="password" id="password" name="password">
				</div>
				<input type="submit" value="Login">
			</form>
		</div>
	</div>
</body>
</html>