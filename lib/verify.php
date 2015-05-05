<?php
session_start();
include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
if(isset($_GET['r']) && isset($_GET['v'])) 
{
	$r=$_GET['r'];
	$v=$_GET['v'];
	echo $r;
	echo $v;
	//echo $v;
	$q="Select * from users where reg_no='$r' AND status='$v' limit 1;";
	$res= $mysqli->query($q) or die("Error 1");
	if($res)
	{
		$q2="UPDATE users set status='verified' where reg_no='$r';";
		//echo $q2;
		$res2= $mysqli->query($q2)  or die("Error 2");
		if($res2) {
			//session_destroy();
			echo "Your Account has been verified. Good luck!";?> 
			<a href="index.php"> Click here to continue</a>
	<?php	}
		else {
		$_SESSION['msg'] = "Error in verification. Please check again!";
		echo $_SESSION['msg'];
		}
	}
} 
else {
	if(isset($_SESSION['login'])) {
	$userid=$_SESSION['login'];
	} else {
	    session_destroy();
		echo "Login again";
	}
}
?>