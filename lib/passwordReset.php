<?php
session_start();
//CHECK CODE!
include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
   $msg ="";
	   if(isset($_POST['oldpass']))
	   {
		   if(!isset($_POST['pass'])||!isset($_POST['cpass']))
		   {
			   $msg = "Please fill in all required fields.";
			   //goto test;
		   }
		   else{
		   $userid = $_SESSION['login'];
		   $encOldPass = sha1($_POST['oldpass']);
		   $q = "SELECT * from users where `reg_no`='$userid' AND password='$encOldPass';";
		   $res = mysqli_query($q) or die("Error in db connectivity");
		   if(mysqli_num_rows($res)>=1)
		   {
			   $pass = mysqli_real_escape_string($mysqli,$_POST['pass']);
			   $cpass = mysqli_real_escape_string($mysqli,$_POST['cpass']);
			   if($pass==$cpass)
			   {
				   $enc = sha1($pass);
				   $q = "UPDATE users SET password='$enc' WHERE `reg_no`='$userid'";
				   $res = mysqli_query($q) or die("db error!");
				   $msg = "Password Reset done!";
				   unset($_SESSION['login']);
					session_destroy();
					$_SESSION['logout'] = true;
						header("Location: index.php?logout=1");
				exit();
			   }
			   else
				   $msg = "Mismatch in confirmation of pass";
		
		   }
		   else $msg = "Incorrect old password!";
		  }
		 
		   
	   }  else $msg = "Please fill in all fields!";
	   //test:
   
	?>
    <?php require_once 'header1.php'; ?>
    <title>Riddler</title>
    
    <?php require_once 'header2.php'; ?>
    <div id="Question">
    <div style="position:relative; top:100px;">
    <center><div style="color:red"><?php echo $msg; ?></div>
    <form method="post" action="passwordReset.php">
    <table border="1">
  <tr>
    <th scope="row">*Old Password:</th>
    <td><input type="password" name="oldpass" id="oldpass"></td>
  </tr>
  <tr>
    <th scope="row">*New password:</th>
    <td><input type="password" name="pass" id="pass"></td>
  </tr>
  <tr>
    <th scope="row">*Confirm password:</th>
    <td><input type="password" name="cpass" id="cpass"></td>
  </tr>
</table>
<input type="submit" value="submit" name="submit">
</form></center>
</div>
</div>

    
    <footer><a href="http://www.csivit.com" target="_blank" id="foot">© Computer Society of India | VIT Chapter</a></footer>
