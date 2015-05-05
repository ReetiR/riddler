<?php 
    include_once 'globals.php';
    include_once 'connection.php';
    include_once 'functions.php';
    include_once 'leaderboardclass.php';
    if(!isset($_SESSION))
        session_start(); 
		
		$useremail=$_SESSION['login'];
		$query1= "SELECT *  FROM  `users`  WHERE email='$useremail'";
		$res = $mysqli->query($query1);
		$row=$res->fetch_array();
		
		if($row['last_level']<31)
			$finish=false;
		if(!$finish)
			echo "<script>window.location.href='question.php';</script>";
		
	$query2 = "SELECT *  FROM  `users`  WHERE 1  ORDER BY last_level DESC , last_level_time ASC";
	$res1 = $mysqli->query($query2);
	$i=0;
	while($row1=$res1->fetch_array())
	{
		$i++;
		if($row1['email']==$useremail)
		{
			$rank=$i;
		}
	}  ?>
		
		<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Riddler</title>
        <meta charset="utf-8" />
		<script type="text/javascript" src="jquery.js">     //MAJOR RENDERING ERROR IN FIREFOX          </script>
		<style type="text/css">
			.rectangle{
				height: 15px;
				width: 15px;
				background-color: #042664;
				position: absolute;
			}
		</style>
	</head>
	<body onload="animate1()" style="background-image: url(Images/light.jpg);">

	<div style="margin:auto; position:absolute; left:0; right:0; top:0; bottom:0; padding:10px; border: 0px solid grey; height:300px; width: 300px; box-shadow: 0px 3px 5px grey; background-color: whitesmoke;" id="rContainer">
		<div style="margin:auto; position:absolute; left:0; right:0; top:0; bottom:0; height:200px; width: 140px;">
		<div id="r1" class="rectangle"></div>
		<div id="r2" class="rectangle"></div>
		<div id="r3" class="rectangle" style="top:80px; width:0;"></div>
		<div id="r4" class="rectangle" style="left:125px; height:0;"></div>
		<div id="r5" class="rectangle" style="top:85px; left:10px; opacity:0; transform: rotate(42deg); -webkit-transform: rotate(45deg);"></div>
		</div>
        <img src="Images\R.png" alt="." id="finalR" style="position:absolute; opacity:0; height:300px; width:300px;">
	</div>
	
    <div style="position:absolute; margin:auto; left:0; right:0; top:0; bottom:30px; height:80px; width:551px; opacity:0; font-size:70px; color:#0094ff; text-shadow: 3px 3px 3px #b0b0b0; font-family: Roboto, 'Segoe UI'; font-weight: 600;" id="congo"> 
        Congratulations!</div>
    <div style="position:absolute; margin:auto; left:0; right:0; top:0; bottom:0; height:35px; width:551px; opacity:0; font-size:25px; color:#042664; text-shadow: 1px 1px 1px #b0b0b0; font-family: Roboto, 'Segoe UI'; font-weight: 400; text-align: left;" id="congoText">
            You've completed Riddler. Thank you for playing!<br><br><span style="color:#373535; opacity: 0;" id="rank">Final Rank: <b style="color: #000"># <?php echo $rank; ?></b></span>
        </div>

        <div style="position: absolute; bottom: 10px; left: 0; right: 0; margin:auto; width: 280px; height: 40px; text-align: center; font-family: Roboto; opacity: 0; font-size: 14px;" id="watermark"><a style="text-decoration: none; color: darkgrey;" href="http://vit.csivellore.net/" target="_blank">Computer Society of India<br>VIT Chapter</a></div>

<script type="text/javascript">
    function animate1() {
        $('#r1').animate({
            height: "170px"
        }, 1200, animate2());
    }

    function animate2() {
        $('#r2').animate({
            width: "125px"
        }, 1200, animate3());
    }


    function animate3() {
        $('#r3').delay(540).animate({
            width: "125px"
        }, 1100, animate4());
    }

    function animate4() {
        $('#r4').delay(1050).animate({
            height: "95px"
        }, "slow", animate5());
    }

    function animate5() {
        $('#r5').delay(1300).animate({
            opacity: 1,
            top: "+=32px",
            width: "110px",
            left: "+=26px"
        }, "slow", animate6());

        $('#finalR').delay(2100).animate({
            opacity: 1
        }, 500);
    }

    function animate6() {
        $('#rContainer').delay(3500).animate({
            right: "550px",
            left: "10px"
        }, 1200, animate7());
    }

    function animate7() {

        $('#congo').delay(3500).animate({
            left: "+=380px",
            opacity:1
        }, 1200, anim8());
        $('#congo').delay(1000).animate({
            bottom: "100px"
        }, 800);
    }

    function anim8() {
        $('#congoText').animate({
            left: "+=380px"
        }, 1200);
        $('#congoText').delay(4400).animate({
            top: "+=40px",
            opacity: 1
        }, 900);
        $('#rank').delay(7000).animate({
            opacity: 1
        }, 900);
        $('#watermark').delay(8000).animate({
            opacity: 1
        }, 900);

    }

		</script>

	</body>
</html>