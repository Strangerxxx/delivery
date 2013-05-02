<?php
include('functions.php');
if($_POST['submit']){
	switch ($_POST['request']) {
	case 'reg':
		echo regUser($_POST['login'], $_POST['pass'], $_POST['email']);
		break;
	
	case 'login':
		echo loginUser($_POST['login'], $_POST['pass']);
		break;
	}
}
?>