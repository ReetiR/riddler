<?php
	session_start();
	unset($_SESSION['login_stat']);
	unset($_SESSION['admin']);
	session_destroy();
	header("Location: index.php");
	exit();
?>