<?php include_once "../config.php"; 
if(!isset($_SESSION["user"])){
	header("location: " . $pathAPP . "logout.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php echo $_SESSION["user"]->username; ?>
	<a href="<?php echo $pathAPP ?>logout.php">Logout</a>
</body>
</html>