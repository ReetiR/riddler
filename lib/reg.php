<?php
   //include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
   require_once('recaptchalib.php'); 
//require_once('sdk/src/facebook.php');

$publickey = "6LdHkc4SAAAAALgEvPlP8QWWwvJIShqGz0CfSu2C";
$privatekey = "6LdHkc4SAAAAAD49vlxyXqnrMlo-Dwv9PicSfJRm"; 
$resp = null; 
$error = null;

?>
<?php
    if(!isset($_SESSION))
    session_start();

    if(isset($_SESSION['login'])) {
        @header("Location: question.php");
    }
?>

<?php
/*$facebook = new Facebook($config);
$user_id = $facebook->getUser();
if($user_id!=0)
$isFBUser = isFBRegistered($user_id);
if($isFBUser)
{
    $_SESSION['login'] = getEmail($user_id);
}
$redirect_url = 'http://riddler.csivit.com/lib/redirect.html';
if($user_id)
{
    $FBUrl = $facebook->getLoginUrl( array('scope' => 'email','redirect_uri' => $redirect_url));
    //$FBUrl = $facebook->getLogoutUrl();//array('scope' => 'email','redirect_uri' => $redirect_url));
} 
else 
{
    $FBUrl = $facebook->getLoginUrl( array('scope' => 'email','redirect_uri' => $redirect_url));
}

//CHECK RETURN 
if(isset($_GET['fb']))
{
try{
$user_profile = $facebook->api("/me","GET");
$email = $user_profile['email'];
//echo $name = $user_profile['name'];
if(!$isFBUser)
{
  addFacebookUser($name,$user_id,$email);
  $message = 'You have been registered. Click <a href="question.php">Here</a> to start playing';
}

}
catch(exception $e)
{
    //$facebook->destroySession();
    $FBUrl = $facebook->getLoginUrl( array('scope' => 'email','redirect_uri' => $redirect_url));
   //echo $e;
}
}*/

if(!empty($_POST['mode']))
{ 

if (isset($_POST["recaptcha_response_field"]))
     {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) 
        {
                /*Code For Insert*/
         $name = mysqli_real_escape_string($mysqli,$_POST['name']);        
         $phone = mysqli_real_escape_string($mysqli,$_POST['number']);
         $email = $_POST['email'];
         $reg_no = mysqli_real_escape_string($mysqli,$_POST['reg_no']);
         //$emailrest="@vit.ac.in";
         //$email =$emailft.$emailrest;
         $password = mysqli_real_escape_string($mysqli,$_POST['pw']);
         $pcon = mysqli_real_escape_string($mysqli,$_POST['pwconfirm']);
         $reg_date = date("Y-m-d H:i:s");
          $encryptPassword = sha1($password);
         ($encrypt_id = substr(md5(rand()),0,7));
         
         
        
    //  $fetchreg=trim($regno," ");  
        $sql_check = $mysqli->query("SELECT reg_no FROM users WHERE email='$email'");
        //$qry_check=$mysqli->query($sql_check);
        $finalcount= $sql_check->num_rows;
        if($finalcount == '1')
        {
                 $message="Please check Registration Number!";
        }
        else
        { 
                    $dtime =date("Y-m-d H:i:s");
                     $sql_con="INSERT INTO users SET
                     `reg_no`='$reg_no',
                     `email`='$email',
                     `password`='$encryptPassword',
                     `registered_on`='$reg_date',
                     `last_level_time`='$dtime',
                     `status`='$encrypt_id',
                     `type`='aspirant',
                     `name`='$name',
                     `phoneno`='$phone';";
                    
                    // echo $sql_con;
                    $res= $mysqli->query($sql_con); 
                    //$fetchlastid=mysql_insert_id();
                    if($res)
                    {  
                    $linkCreation   = "http://riddler.csivit.com/Riddler_check/lib/verify.php?r=".$reg_no."&v=".$encrypt_id; 
                                
                                
                            $msg='<table style="width:500px;padding:0;margin:0;">
                                    <tr>
                                        <td>
                                                Dear '.$name.'<br /><br />      
                                                Welcome to Riddler. Thank you for signing up.Your account has not been activated.<br />
                                                Please <a href='.$linkCreation.'>click here</a> to activate your account.<br />                 
                                                Your login details are given below.<br /><br />         
                                                <strong>Username:</strong>'.$email.'<br />       
                                                <strong>Password:</strong>'.$password.'<br />
                                                <strong>Activation code:'. $encrypt_id.'</strong><br><br />         
                                                Yours Sincerely,<br />      
                                                Site Administrator,<br />       
                                                Riddler team    
                                        </td>
                                    </tr>
                                </table>';
                            
                            $contact_email="support@csivit.com";
                            $subject="Riddler - Sign Up - Account Verification";
                            $to=$email;
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
                            $message="Thank you for signing up. Your account is activated";//.Check Email(and your spam folder.)!";      
                    }
                    else $message = "Failure! Duplicate entry(email, regno...)";
        }
        }
    else
    {
         $message =  "check Capcha!";
                //exit;
    }
}
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Riddler - Registration</title>
        <link rel="stylesheet" href="styleSheet.css" type="text/css" />
        <script>
        <?php if(isset($_SESSION['login'])) {
        echo "window.location.href='question.php'";
        }
        ?>
        </script>
    </head>
    <body>
        <div id="headDiv">
            <a href="index.php"><h1 id="riddlerHead">RIDDLER</h1></a>
            <img src="Images\CroppedLogo.gif" alt="CSI" id="logo">
        </div>

        <div style="margin-left: auto; margin-right: auto; margin-top: 5%; width: 630px; align: centre;">
        <form id="regForm" class="form" method="post" action="reg.php">
            <?php if(isset($message)) echo $message."</br>";?>
            <input type="hidden" name="mode" value="1" />
            <div style="text-align: center; width: auto;">
                <label for="name" class="contact">Name: </label><input class="ip" name="name" type="text" id="name" required autofocus="true" /><br/>
                <label for="reg_no" class="contact">Registration Number: </label><input class="ip" name="reg_no" type="text" id="reg_no" pattern="[0-9]{2}[A-Z]{3}[0-9]{4}" required autofocus="true" /><br/>
                <label for="email" class="contact">Email: </label><input class="ip" name="email" type="email" id="email" required /><br/>
                <label for="pw" class="contact">Password: </label><input class="ip" type="password" name="pw" id="pw" required /><br/>
                <label for="pw" class="contact">Password Confirm: </label><input class="ip" type="password" name="pwconfirm" id="pw" required /><br/>
                <label for="number" class="contact">Mobile: </label><input class="ip" name="number" type="tel" pattern="[0-9]{10}" id="number" required /><br/>
                <!--label for="univ" class="contact">University: </label><input class="ip" name="univ" type="text" id="univ" required /><br/!-->
				 <div id="captcha"><?php echo recaptcha_get_html($publickey, $error); ?></div>
            <input type="submit" value="REGISTER" class="subBtn"/></div>
            <!--hr>    
            <a href="<?php echo $FBUrl; ?>"><button type="button" id="fbBtn" class="subBtn">Or use Facebook</button></a!-->
        </form>
        </div>
        
        <footer id="foot"><a href="http://vit.csivellore.net" target="_blank" style="color: #808080;">Computer Society of India<br>VIT University</a></footer>
    </body>
</html>
