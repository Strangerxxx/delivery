<?php
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<title>Main</title>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	</head>
<?php if(!$userid = checkUserLogin($_SESSION['sessionid'], $_SESSION['hash'])): ?>
	<form action="request.php" method="POST">
		<input type="text" name="login" placeholder="Your login...">
		<input type="password" name="pass" placeholder="Your password...">
		<input type="email" name="email" placeholder="Your email...">
		<input type="hidden" name="request" value="reg">
		<input type="submit" value="Proceed">
	</form>

	<form action="request.php" method="POST">
		<input type="text" name="login" placeholder="Your login...">
		<input type="password" name="pass" placeholder="Your password...">
		<input type="hidden" name="request" value="login">
		<input type="submit" value="Proceed">
	</form>
	<?php
	else:
	?>
	<p>UserID:</p><?=$userid?>
	<?php endif; ?>
</html>