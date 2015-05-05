<?php
session_start();
include("connection.php");
if(!isset($_SESSION['login']))
{
	header("Location: index.php");
}
	$id= $_SESSION['login'];
	$q="Select * from users where `reg_no`='$id'";
	$res= $mysqli->query($q);
	$fetch_data= $res->fetch_array();
	//exit();

?>




<!DOCTYPE html>

<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Player Profile</title>
        <!--link rel="shortcut icon" href="../CSI_Website/favicon.ico"/!-->
        <link href="styles/style1.css" rel="stylesheet" type="text/css" />
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,600' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/jquery.js"></script>
    </head>
    <body onload="foots()" onresize="foots()">
        <script type="text/javascript">
function foots() {
           var w = window.innerWidth; $('#footer').css("width", w - 17); $('#headerSmall').css("width", w - 17); $('#arrow').css("left", w / 2);
       }

function bigger() {
           $('#headerSmall').css("height", 35); $('#arrow').css("top", 37);
           $('#headText').css("display", 'block');
           $('#arrow').css('opacity', 0).css('cursor', 'default'); ;
       }

/*function nameChange(x){
          if(x === 1){ $('#nameChangeForm').fadeIn('fast', function() {});}
          else {$('#nameChangeForm').css('opacity', '0')}
}*/
       </script>
        <header class="headSmall" id="headerSmall"><p id="headText" style="cursor: pointer; margin-top: 9px; font-family:Arial;">To go back, close this tab or click <a href="question.php"><b>here</b></a></p></header><img src="Images/arrow.png" alt="Click to expand" id="arrow" onclick="bigger()">
        
        <h1 id="name"style="cursor: pointer; font-family:'Titillium Web', 'Arial', sans-serif; color:grey; font-size:50px; margin-top: 60px; margin-left: 70px; margin-bottom: 0;">PLAYER PROFILE</h1>
        <br>

        <h6 id="name"style="cursor: pointer; font-family:'Titillium Web', 'Arial', sans-serif; color:grey; font-size:50px; margin-top: 30px; margin-left: 70px; margin-bottom: 0;"><?php echo $fetch_data['name'];?></h1>
        <br>
        <h6 id="name"style="cursor: pointer; font-family:'Titillium Web', 'Arial', sans-serif; color:grey; font-size:50px; margin-top: 10px; margin-left: 70px; margin-bottom: 0;">LEVEL <?php echo $fetch_data['last_level'];?></h1>
         
        <br>
        
        
        <ul class="memberList">
            <li class="member">MOBILE NUMBER: <p class="data"><?php echo $fetch_data['phoneno'];?></p></li>
            <!--li class="member">SMS NOTIFICATIONS <button id="enable" type="button" value="Enable" class="smsBtn">Enable</button><button class="smsBtn" type="button" id="disable" value="Disable" disabled>Disable</button></li!-->
        </ul>

        <ul class="memberList">
            <li class="member">EMAIL: <p class="data"><?php echo $fetch_data['email'];?></p></li>   
        </ul>
        
         <ul class="memberList">
            <li class="member">UNIVERSITY: <p class="data"><?php echo $fetch_data['reg_no'];?></p></li>   
        </ul>
        
		
        


        <?php require_once 'footer.php'; ?>
        
    </body>
</html>
