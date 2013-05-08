<?php
	include_once('config.php');
	include_once('functions.php');
	db_connect();
	session_start();

		if(isset($_POST['submit'])){
		switch ($_POST['request']) {
		case 'reg':
			echo regUser($_POST['login'], $_POST['pass'], $_POST['email']);
			break;
	
		case 'login':
			echo loginUser($_POST['login'], $_POST['pass']);
			break;
		
		case 'logout':
			session_destroy();
			break;
		}
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<title>Main</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	</head>
<?php 
	if(isset($_SESSION['sessionid']) $userid = checkUserLogin($_SESSION['sessionid'];
	if(!isset($_SESSION['sessionid']) && $userid == false){
		?>
	<form method="POST">
		<input type="text" name="login" placeholder="Your login...">
		<input type="password" name="pass" placeholder="Your password...">
		<input type="email" name="email" placeholder="Your email...">
		<input type="hidden" name="request" value="reg">
		<input type="submit" value="Proceed" name="submit">
	</form>

	<form method="POST">
		<input type="text" name="login" placeholder="Your login...">
		<input type="password" name="pass" placeholder="Your password...">
		<input type="hidden" name="request" value="login">
		<input type="submit" value="Proceed" name="submit">
	</form>
	<?php
	} else{
	?>
	<p>UserID:</p><?=$userid?>
	<form method="POST">
		<input type="hidden" name="request" value="logout">
		<input type="submit" value="Logout" name="submit">
	</form>
	<?php } ?>
</html>
