<?php
include_once 'connection.php';
session_start();

$r=$_SESSION['login'];
		$q="SELECT * from users where `reg_no`='$r'";
		$res= $mysqli->query($q) or die("error 1");
		if($res) {
			/*$user=mysqli_fetch_array($res);*/
			$user= $res->fetch_array(); 
			//echo $r;
			//if($user['status']!='verified')
				//$goto = urlencode("index.php?message=Not verified");
			$level = $user['last_level'];
		}

if(isset($_POST['pts'])&&isset($_POST['id']))
{
 $id = $_POST['id'];
 $points = $_POST['pts'];
 $q = "UPDATE `users` SET `points` = '$points', `last_hint_used`= '$level' WHERE `id` = '$id'";
 $res = $mysqli->query($q);
 if($res)
 {
 	echo "data updated" ;
 }
}
?>