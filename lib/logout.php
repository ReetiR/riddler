<?php
		session_start();
		include_once 'connection.php';
        include_once 'globals.php';
        require_once('sdk/src/facebook.php');	
        $facebook = new Facebook($config);
        $facebook->destroySession();
		unset($_SESSION['login']);
		session_destroy();
		$_SESSION['logout'] = true;
		header("Location: index.php?logout=1");
		exit();
?>