<?php
	include_once('config.php');
	include_once('functions.php');
	db_connect();

	if(isset($_POST['submit'])){
		switch ($_POST['request']) {
		case 'reg':
			echo regUser($_POST['login'], $_POST['pass'], $_POST['email']);
			break;
	
		case 'login':
			echo loginUser($_POST['login'], $_POST['pass']);
			break;
		}
		case 'logout':
			session_destroy();
			break;
	}
?>