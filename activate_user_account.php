<?php
include("lib/connection.php");
$user_idfetch     =$_REQUEST['specific'];
$user_activation = "verified";
$user_id     = $user_idfetch-588756432;
$query="update `users` set `status`='$user_activation' where id='$user_id'";
$result=mysql_query($query);
					if($result)
					{ 
						echo "<script language='javascript'>window.location.href='login.php?message=Your account successfully activated!';</script>";
						exit();
					}

?>