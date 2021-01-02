<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href='css/style.css'>
	<title>kakeibo login</title>
</head>
<body>
	<?php include("header.php"); ?>
	
	<div class="contentwrap">
	<div class="inputWindow">
	<form method="post" action="./logincheck.php">
	<p>Login with your email</p>
	<input type="text" placeholder="Email or ID" name="inputUsername">
	<input type="password" placeholder="password" name="inputPassword">
	<input type="submit" value="login">
	</form>
	<a href="" class="link">Forgot password?</a></br>
	<a href="./signup.php" class="link">Do not have Kakeibo ID?</a></br>
	</div>
	</div>
</body>
</html>