<?php
session_start();
include_once 'functions.php';
include_once 'connection.php';  
include_once 'globals.php';

if(empty($_SESSION['login']))
		@header("Location: index.php");
		
$r=$_SESSION['login'];
		$q="SELECT * from users where `reg_no`='$r'";
		$res= $mysqli->query($q) or die("error 1");
		if($res) {
			/*$user=mysqli_fetch_array($res);*/
			$user= $res->fetch_array(); 
			if($user['last_level']!=26)
				@header("Location: question.php");
				}


?>

<!DOCTYPE html>
<html>
<title>Solve this FIRST to be at the foreFRONT of the game!</title>
<head>
</head>

<body>
<img src="media\Q26(a).jpg" width="400" height="600">
<p>If I was not called what I am right now...what would I be known as?</p>

<br>
<form action="q2.php" method="post">
Ans : <input type="text" name="ans" id="ans">
<input type="submit">
</form>
<b> </b>
</body>

</html>