<?php
session_start();
include_once 'functions.php';
include_once 'connection.php';  
include_once 'globals.php';

   //var_dump($_SESSION);
$goto = "#";
/*if(empty($_SESSION['login']))
{
	//header("Location: index.php");
	$goto = "index.php";
}*/
		$r=$_SESSION['login'];
		$q="SELECT * from users where `reg_no`='$r'";
		$res= $mysqli->query($q) or die("error 1");
		if($res) {
			/*$user=mysqli_fetch_array($res);*/
			$user= $res->fetch_array(); 
			//echo $r;
			//if($user['status']!='verified')
				//$goto = urlencode("index.php?message=Not verified");
			$level = $user['last_level'];
			if ($level==0)
			$level=1;
			
			$row['count']=LEVEL_COUNT;
			
			$sql_chk="SELECT count(*) as count FROM questions WHERE 1"; 
			$rcount= $mysqli->query($sql_chk);
			/*$rcount = mysqli_query($con,"SELECT count(*) as count FROM questions WHERE 1;");*/
			/*if($rcount)
			$row = mysqli_fetch_array($rcount);*/
			if($rcount)
			$row=$rcount->fetch_array(); 
			
			
			if(($level)>30)
			{
			   /*$_SESSION['msg'] = "You are done! Check out the <a href='leaderboard.php'>leaderboard</a>! Give us your feedback <a href='feedback.php'>here</a>";
			   $goto = "message.php";*/
			  
			   /*$_SESSION['msg'] = "You are done! Check out the <a href='leaderboard.php'>leaderboard</a>! Give us your feedback <a href='feedback.php'>here</a>";*/
			   $goto = "congratulations.php";
			   $finish=true;
			
			}
			$q2="select * from questions where level='$level'";
			/*$res2=mysqli_query($con,$q2)  or die("error 2");*/
			$res2= $mysqli->query($q2);
			if($res2) {
				/*$ques=mysqli_fetch_array($res2);*/
				$ques=$res2->fetch_array(); 
				$ques_type=$ques['type'];
				$ques_head=$ques['q_head'];
				$ques_body=$ques['q_body'];
			}
		}
?>


<script type="text/javascript">
			var cur_level= <?php echo $user['last_level']; ?>;
			var last_hint= <?php echo $user['last_hint_used']; ?>;
			var points  = <?php echo $user['points'];?> ;
			var hint = "<?php echo $ques_hint1=$ques['hint'];	?>" ;
			var i = false;
			var xmlhttp = new XMLHttpRequest();
			function func()
			{
				if(points>=50 && cur_level!=last_hint)
				{
					if(i==false)
					{
					var check = confirm("are u sure ??. it will reduce 50 points ??");
					if( check == false)
					{ 
					 	return;
					}
					document.getElementById("hint").innerHTML += "HINT  "+hint+"<br/>";
					points = points-50;
					i=true;
					var param = "id=<?php echo $user['id']?>&pts="+points.toString();
					 xmlhttp.open("POST",'addpoints.php',true);
					 xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					  xmlhttp.setRequestHeader("Content-length", param.length);
                     xmlhttp.send(param);
					}
					else
					{
						alert("question hint already used ");
					}
						
				}
				else
				{
					alert("Not enough points or hint used already!!")
				}
			}
			</script>


    <?php require_once 'header1.php';?>
    <?php 
         if($goto!="#")
         	echo "<script>window.location.href='".$goto."';</script>";

    if(isset($ques_head) and $ques_head!="")
	      echo $ques_head;
		  else echo "<title>Riddler</title>";
		  $_SESSION['logout'] = false;
		  
		  if($finish)
		{
			echo "<script>window.location.href='congratulations.php';</script>";
		}
		  
		  
		  ?>
		  
    <?php
	//echo $ques_head;
	?>

    <?php include_once('header2.php');?><!--/head><body-->

     
    <div id="Question">
    	<div id="message" style="color:red"><?php if(isset($_SESSION['message']))
	echo $_SESSION['message'];
	unset($_SESSION['message']);  ?></div>
    <?php
	echo $ques_body;

	?>
	<div id = "hint" style = "text-align:center;"></div>
	 <br>
    <br>
    <br>
    <br>
    <br>
                <!--img src="\images\light.jpg" alt="Error. Please reload the page or try again later. Keep checking our Facebook page for updates. If the problem persists, please contact us."-->
     </div>

     <div id="ansForm">
                <h3 id="counter" style="display: inline"><?php echo $level; ?></h3>/30
                <input type="text" name="answer" placeholder="Answer" id="ans" onkeypress="enterer(event)" style="margin-left: 8px;"/>
                <button id="subBtn" onclick="check(document.getElementById('ans').value)"><img src="Images\next.png" alt="Submit" id="subPic"></button>
                <button onclick = "func()">HINTS</button>
            </div>
        
    




        <div class="push"></div></div>
           <?php require_once 'footer.php'; ?>

           <script>
            var txtbx;
            txtbx = document.getElementById('ans');
            var clr, ques;
            ques = <?php echo $level; ?>;
            function enterer(e) {
                if (e.keyCode == 13)
                    document.getElementById('subBtn').click();
            }

            function check(answer) {
                var res;
                var req = new XMLHttpRequest();
                req.onreadystatechange = function () {
                    if (req.readyState == 4 && req.status == 200) {
                        console.log(req.responseText);
                        if (req.responseText == false)
                        {
                            wrongAns();
                        }
                        else
                       {
                            correctAns();
                        }
                    }
                }

                req.open("GET", "response.php?q=" +ques +"&a=" + answer, true);
                req.send();
            }

            function wrongAns() {
                console.log("wrong");
                txtbx.style.backgroundColor = "crimson";
                txtbx.style.border = "1px solid maroon";
                txtbx.style.color = "#fff";
                txtbx.style.animationPlayState = "running";
                txtbx.style.WebkitAnimationPlayState = "running";
                clr = setTimeout(stopAnim, 1300);
            }

            function correctAns() {
                console.log("correct");
                //txtbx.style.backgroundColor = "crimson";
                txtbx.style.backgroundColor = "#00cc00";
                txtbx.style.border = "1px solid #009900";
                txtbx.style.color = "#fff";
                txtbx.style.textAlign = "center";
                txtbx.setAttribute("disabled", "disabled");
                window.location.href="question.php";
            }

            function stopAnim() {
                txtbx.style.animationPlayState = "paused";
                txtbx.style.WebkitAnimationPlayState = "paused";
                txtbx.style.backgroundColor = "#fff";
                txtbx.style.border = "1px solid grey";
                txtbx.style.color = "#000";
                clearInterval(clr);
                var newtxtbx = txtbx.cloneNode(false);
                document.getElementById('ansForm').replaceChild(newtxtbx, txtbx);
                txtbx = document.getElementById('ans');
                txtbx.select();
            }

        </script>
    </body>
</html>