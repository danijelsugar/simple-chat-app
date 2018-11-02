<?php include_once "config.php"; 

	$error = array();

	if(isset($_POST["register"])){

		if(trim($_POST["username"])===""){
		    $error["username"] = "Enter your username";
		}

		if(strlen($_POST["username"])>50){
		    $error["username"] = "Naziv može maksimalno imati 50 znakova.";
		}

		if(trim($_POST["email"])===""){
		    $error["email"] = "Enter your email";
		}

		if(trim($_POST["password"])===""){
		    $error["password"] = "Enter your password";
		}

		if(trim($_POST["cpassword"])===""){
		    $error["cpassword"] = "Confirm your password";
		}

		if($_POST["cpassword"]!=$_POST["password"]){
			$error["cpassword"] = "Wrong password";
		}



		if(count($error)===0){
			$query = $connect->prepare("insert into signup (username,email,pass) values 
								(:username,:email,:pass)");
			$query->execute(array(
				"username"=>$_POST["username"],
				"email"=>$_POST["email"],
				"pass"=>password_hash($_POST["password"],PASSWORD_BCRYPT,array("cost"=>12))
			));
			header("location: index.php");
		}
	}

?>
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
			<h2>Register here:</h2>
			<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
				<div class="form-field">

					<?php if(!isset($error["username"])): ?>

					<label for="username">Username</label>
					<input type="text" id="username" name="username" value="<?php echo isset($_POST["username"]) ? $_POST["username"] : "" ?>">

					<?php else: ?>

					<label class="is-invalid-label">
			            Username
			            <input type="text"
			            value="<?php echo $_POST["username"]; ?>" 
			            class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
			            aria-invalid="true" autocomplete="off" type="text" id="username" name="username">
			            <span class="form-error is-visible" id="nazivGreska">
			            	<?php echo $error["username"]; ?>
			            </span>
		            </label>

		              <?php endif;?>
				</div>
				<div class="form-field">

					<?php if(!isset($error["email"])): ?>

					<label for="email">Email</label>
					<input type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : "" ?>">

					<?php else: ?>

					<label class="is-invalid-label">
		                Email
		                <input type="text"
		                value="<?php echo $_POST["email"]; ?>" 
		                class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
		                aria-invalid="true" autocomplete="off" type="text" id="email" name="email">
		                <span class="form-error is-visible" id="nazivGreska">
		                	<?php echo $error["email"]; ?>
		                </span>
		            </label>

		            <?php endif;?>
				</div>
				<div class="form-field">

					<?php if(!isset($error["password"])): ?>

					<label for="password">Password</label>
					<input type="password" id="password" name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : "" ?>">

					<?php else: ?>

					<label class="is-invalid-label">
		                Password
		                <input type="text"
		                value="<?php echo $_POST["password"]; ?>" 
		                class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
		                aria-invalid="true" autocomplete="off" type="password" id="password" name="password">
		                <span class="form-error is-visible" id="nazivGreska">
		                	<?php echo $error["password"]; ?>
		                </span>
		            </label>

		            <?php endif;?>
				</div>
				<div class="form-field">

					<?php if(!isset($error["cpassword"])): ?>

					<label for="cpassword">Confirm password</label>
					<input type="password" id="cpassword" name="cpassword" value="<?php echo isset($_POST["cpassword"]) ? $_POST["cpassword"] : "" ?>">

					<?php else: ?>

					<label class="is-invalid-label">
		                Confirm password
		                <input type="text"
		                value="<?php echo $_POST["cpassword"]; ?>" 
		                class="is-invalid-input" aria-describedby="nazivGreska" data-invalid="" 
		                aria-invalid="true" autocomplete="off" type="password" id="cpassword" name="cpassword">
		                <span class="form-error is-visible" id="nazivGreska">
		                	<?php echo $error["cpassword"]; ?>
		                </span>
		            </label>

		            <?php endif;?>
				</div>
				<input type="submit" name="register" id="register" value="Register">
			</form>
		</div>
	</div>
</body>
</html>