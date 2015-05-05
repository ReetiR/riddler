<?php
session_start();
//CHECK CODE!
include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
   $msg ="";
   if(!isset($_SESSION['login']))
   {
	   header("Location: login.php");
   }
	   if(isset($_POST['feedback']))
	   {
		   $fback = $_POST['feedback'];
		   $useremail = $_SESSION['login'];
		   $temp="SELECT * from users where email='$useremail'";
		   $tempres=$mysqli->query($temp);
		   $row=$tempres->fetch_array();
		   $username=$row['name'];
		   $q = "INSERT INTO feedback(username,message) values('$username','$fback');";
		   $res = $mysqli->query($q) or die("Error in DB!");
		   if($res)
		   {
			  $msg = "Thank you for your feedback!";
		   }		
		   else $msg = "Could not insert into database. ";  
		   
	   }else $msg = "";
	   //test:
   
	?>
    <?php require_once 'header1.php'; ?>
    <title>Riddler</title>
    
    <?php require_once 'header2.php'; ?>
    <<body style="font-family:'Roboto', 'Arial', sans-serif; background-image: radial-gradient(circle farthest-corner at center, #FFFFFF 0%, #E7F7FF 100%)">
    <h1 style="color: darkgray; font-family: 'Roboto'; margin-top: 0; font-size: 50px; margin-left: 10px; display: inline;">Feedback</h1>
	<form name="f1" id="f1" style="margin-left: auto; margin-right: auto; width: 570px; margin-top: 110px;" method="post" action="feedback.php"  enctype="multipart/form-data" onSubmit="return validate();">
    <input type="hidden" name="mode" id="mode" value="1" />
    Enter any suggestion/feedback below.Your feedback is very important to us.<br>
    <textarea name="feedback" cols="60" rows="10" style="font-family: 'Roboto', Arial; font-size: 17px; margin-top:5px;"></textarea>
  
<input type="submit" value="submit" name="submit">
</form></center>

    
    <?php require_once 'footer.php'; ?>
