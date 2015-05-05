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
        <link rel="stylesheet" href="stylesheet.css" type="text/css" />
        <style>
            .ip{
                width: 275px;
            }
            
        </style>
    </head>
    <body>
        <div class="wrapper">
        <div id="headDiv">
            <a href="index.php"><h1 id="riddlerHead">RIDDLER</h1></a>
            <img src="images\croppedlogo.png" alt="CSI" id="logo">
        </div>

        <div style="position: absolute; margin: auto; height: 410px; width: 445px; left: 0; top: 0; bottom: 0; right: 0;">
        <form id="regForm" class="form" style="width: 380px;">
            <div style="text-align: center;">
                <label for="name" class="contact">Full Name: </label><input class="ip" name="name" type="text" id="name" required autofocus="true" /><br/>
                 <label for="reg_no" class="contact">Registration Number: </label><input class="ip" name="reg_no" type="text" id="reg_no" pattern="[0-9]{2}[A-Z]{3}[0-9]{4}" required autofocus="true" /><br/>
                <label for="email" class="contact">Email: </label><input class="ip" name="email" type="email" id="email" required /><br/>
                <label for="pw" class="contact">Password: </label><input class="ip" type="password" name="pw" id="pw" required /><br/>
                <label for="number" class="contact">Phone Number: </label><input class="ip" name="number" type="tel" pattern="[0-9]{10}" id="number" required /><br/>
                <div id="captcha" style="width: 380px; height: 129px; margin-top: 5px; border: 1px solid grey;"><?php echo recaptcha_get_html($publickey, $error); ?></div>
            <input type="submit" value="REGISTER" style="width: 382px; height: 40px; margin-top:15px;" class="subBtn"/></div>
        </form>
        </div>

        <div class="push"></div></div>
        
        <footer><a href="http://www.csivit.com" target="_blank" style="color: #808080;">Computer Society of India<br>VIT University</a></footer>
    </body>
</html>
