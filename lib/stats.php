<?php 
    include_once 'globals.php';
    include_once 'connection.php';
    include_once 'functions.php';
    include_once 'leaderboardclass.php';

	$query = "SELECT count(*) AS c FROM  `users`  WHERE 1";
        $res = $mysqli->query($query);
		$row=$res->fetch_array();
		echo $row['c'];
		?>