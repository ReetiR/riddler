<?php 
session_start(); 
include("../lib/connection.php");  
	$fetch_id= $_REQUEST['id']; 
	$sql_con="DELETE FROM `questions` WHERE `id` ='$fetch_id'";  
	$res=$mysqli->query($sql_con);	 
	if($res)	
	{ 
		@header("Location: ques_mgt.php?msg=Sucessful Delete");
	exit();
	}
?>