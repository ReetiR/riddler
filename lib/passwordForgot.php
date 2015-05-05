<?php

//CHECK CODE!
include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
   $msg ="";
   if(isset($_SESSION['login_status']))
   {
	   header("Location: question.php");
   }
	   if(!empty($_POST['mode']))
	   {
		   $useremail = $_POST['email'];
		   $q = "SELECT * FROM users WHERE email='$useremail'";
			$res = $mysqli->query($q) or die("DB Error!");
			 if($res->num_rows!=1)
			  {
			      $msg = "Check Email";
			  }
			 else
			 {
		   $resetPass = substr(md5(rand()),0,7);
		   $encResetPass = sha1($resetPass);
		   $q = "UPDATE users SET password='$encResetPass' WHERE email='$useremail';";
		   $res = $mysqli->query($q) or die("Error in DB!");
		   if($res)
		   {
			   $msg='<table style="width:500px;padding:0;margin:0;">
                                    <tr>
                                        <td>
                                                Hello,<br /><br />      
                                                Welcome to Riddler. Your reset password is : '.$resetPass.'<br/> <br/>        
                                                Yours Sincerely,<br />      
                                                Site Administrator,<br />       
                                                Riddler team    
                                        </td>
                                    </tr>
                                </table>';
                            
                           	$contact_email="support@csivit.com";
                            $subject="Riddler - New Password";
                            $to=$useremail;
                            $fr="From: $contact_email";
                            $headers="MIME-Version: 1.0\r\n";
                            $headers.= "Content-type: text/html; charset=ISO-8859-1\r\n";
                            $headers.= $fr . "\r\n"; 
                            /*echo $msg;
                            echo "<br>";
                            echo "subject :".$subject."<br>";
                            echo "To :".$email."<br>";
                            echo $headers;
                            exit;*/
                            $val=mail($to,$subject,$msg,$headers);
                            $message="Your password has been reset. Check your email";//.Check Email(and your spam folder.)!";      
                    }
                    else $message = "Failure! Duplicate entry(email, regno...)";
        }
}
	   //test:
   
	?>
    <?php require_once 'header1.php'; ?>
    <title>Riddler</title>
    
    <?php require_once 'header2.php'; ?>
    <div id="Question">
    <div style="position:relative; top:100px;">
    <center><div style="color:red; top:100px;"><?php echo $message; ?></div>
    <form id='forgotpw' class='form' method="post" action="passwordForgot.php">
    <input type="hidden" name="mode" value="1" />
    <table border="1">
  <tr>
    <th scope="row">*Enter email.</th>
    <td><input type="text" name="email" id="email"></td>
  </tr>
 
</table>
<input type="submit" value="submit" name="submit">
</form></center>
</div>
</div>

    
    <?php require_once 'footer.php'; ?>
