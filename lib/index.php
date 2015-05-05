<?php
  session_start();
        if(isset($_SESSION['login'])) {
        @header("Location: question.php");
         }
include_once 'functions.php';
include_once 'connection.php';
include_once 'globals.php';
$message="";

if(!empty($_REQUEST['reg_no']))
{
 
                    $reg_no=$_REQUEST['reg_no']; 
                    
                    $user_pass=$_REQUEST['pw'];
                    
                    $encryptPassword = sha1($user_pass);
                    $sql_chk="SELECT * FROM `users` WHERE `reg_no`= '$reg_no' AND `password`='$encryptPassword';";     
                                 
                    $rs_chk= $mysqli->query($sql_chk);
                    $checking = $rs_chk->num_rows;
                    if($checking==1)
                    {    
                                                $fetch_data= $rs_chk->fetch_array(); 
                                                
                                                $loginid = $fetch_data['reg_no'];
                                                $status = $fetch_data['status'];
                                                $level = $fetch_data['last_level'];
                                                $_SESSION['level']=$level;
                                                $_SESSION['login']=$loginid;
                                         
                                                if($status=='verified') 
                                                { 
                                                    $_SESSION['verify_status']='verified';
                                                    $_SESSION['login_status'] = true;                                                   
                                                    @header("Location: question.php");
                                                    exit();
                                                } 
                                                else 
                                                {
                                                    $_SESSION['verify_status']='unverified';  
                                                    header("Location: verify.php");
                                                }
                    }
                    else
                    {
                        $message="Either 'Username' or 'Password' is incorrect.";
                    
                    ?>
<script>
    alert("Either your 'Username' or 'Password' isn't correct.");
</script>
<?php
     } } 
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Riddler</title>
        <link rel="stylesheet" href="stylesheet.css" type="text/css" />
    </head>

    <body>

        <div class="wrapper">

        <div id="cover"></div>
        <h1 id="openingHeader" onclick="intro()">3.0</h1>

        <div id="hide" style="visibility: hidden;">

        <div id="headDiv">
            <a href="/index.png"><h1 id="riddlerHead">RIDDLER</h1></a>
            <img src="images\croppedlogo.png" alt="CSI" id="logo">
        </div>

        <div id="bigDiv" style="position: absolute; margin: auto; left: 0; right: 0; top: 0; bottom: 0; height: 230px; width: 670px;">
        <form id="loginForm" class="form">
            <div style="text-align: center;">
                 <?php echo $message; ?>
                <label for="email" class="contact">Registration Number: </label><input class="ip" name="reg_no" pattern="[0-9]{2}[A-Z]{3}[0-9]{4}" id="reg_no" required autofocus="true" /><br/>
                <label for="pw" class="contact">Password: </label><input class="ip" type="password" name="pw" id="pw" required /><br/>
                <input type="submit" value="LOGIN" class="subBtn"/>
            </div>
            <a href="passwordForgot.php" id="forgot">Forgot Password?</a>
        </form>

        <ul id="nav">
            <li><a href="rules.html" class="navLinks">RULES</a></li>
            <li><a href="registration.php" class="navLinks">REGISTER</a></li>
            <li><a href="https://www.facebook.com/csiriddler" target="_blank" class="navLinks">FACEBOOK</a></li>
            <li><a href="mailto:askcsivit@gmail.com" class="navLinks">CONTACT US</a></li>
        </ul>
        </div>

        
        </div>
        <div class="push"></div></div>
        
        <footer><a href="http://www.csivit.com" target="_blank" style="color: #808080; position: absolute; left: 0; right: 0; z-index: 105;">Computer Society of India<br>VIT University</a></footer>

        <script type="text/ecmascript">
            function intro() {
                document.getElementById('hide').style.visibility = "visible";
                var h = document.getElementById('openingHeader');
                var c = document.getElementById('cover');
                h.style.color = "#fff";
                h.style.height = "10px";
                h.style.width = "10px";
                h.style.fontSize = "5px";
                c.style.opacity = "0";
                c.style.visibility = "hidden";
                h.style.opacity = "0";
                h.style.visibility = "hidden";
            }
        </script>
    </body>
</html>