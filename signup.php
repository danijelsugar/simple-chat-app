<?php include_once "config.php"; 

	$error = array();

	$mySqlUniqueIndexCheck = 1062;

	//check user inputs
	
	if(isset($_POST["register"])){

		if(trim($_POST["username"])===""){
		    $error["username"] = "Username is required.";
		}

		if(strlen($_POST["username"])>50){
		    $error["username"] = "The username contains too many characters.";
		}

		if(trim($_POST["email"])===""){
		    $error["email"] = "Email is required";
		}

		if(trim($_POST["password"])===""){
		    $error["password"] = "Password is required";
		}

		if(trim($_POST["cpassword"])===""){
		    $error["cpassword"] = "Confirm your password";
		}

		if($_POST["cpassword"]!=$_POST["password"]){
			$error["cpassword"] = "Wrong password";
		}



		if(count($error)===0){

			try {
			$query = $connect->prepare("insert into signup (username,email,pass,description,image) values 
								(:username,:email,:pass,:description,:image)");
			$query->execute(array(
				"username"=>$_POST["username"],
				"email"=>$_POST["email"],
				"pass"=>password_hash($_POST["password"],PASSWORD_BCRYPT,array("cost"=>12)),
				"description"=>"",
				"image"=>$pathAPP . "img/nepoznato.png"
			));
			header("location: index.php");
			}
			catch (PDOException $e) {
			    if ($e->errorInfo[1] == 1062) {
			        $error["email"] = "Email already in use.";
			    }
			}
			
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
	<style>
		.login-form input {
			background-color: #414452;
		    box-sizing: border-box;
		    color: #fff;
		    -webkit-box-sizing: border-box;
		    -moz-box-sizing: border-box;
		    display: block;
		    float: none;
		    font-size: 16px;
		    border: none;
		    border-bottom: 1px solid #000;
		    padding: 6px 10px;
		    height: 38px;
		    line-height: 1.3;
		    width: 200px;
		}
		.form-field {
			border: none;
		}
	</style>
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