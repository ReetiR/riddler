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
<?php include_once('header2.php');?>

    <div id="Question">
        <!--img src="images\tick.png" alt="Something isn't right. Try reloading the page and keep checking fb.com/csiriddler for updates. If the problem persists, please get in touch with us" id="questionImg"!-->
    	<?php echo $ques_body; ?>
    </div>
     
    <?php if(isset($_SESSION['message']))
	//echo $_SESSION['message'];
	//unset($_SESSION['message']);  ?></div!-->
    <?php
	//echo $ques_body;

	?>
	
     <div id="ansForm">
                <p id="closeness" style="margin-bottom: -7px; height: 21px;"></p>
                <h3 id="counter" style="display: inline"><?php echo $level; ?></h3>/30
                <input type="text" name="answer" placeholder="Answer" id="ans" onkeypress="enterer(event)" style="margin-left: 8px;">
                <button id="subBtn" onclick="check(document.getElementById('ans').value)"><img src="Images\next.png" alt="Submit" id="subPic"></button>
                <img src="Images\tick.png" alt="" style="position: relative; height: 30px; top: 5px; right: 35px;">
                <a href="question.php" id="nextqLink">Next question</a>
            </div>
        
            <div id="questionmark" style="position: relative; top: 35px; width: 130px; left: -88px; -webkit-transition: 0.3s all ease; transition: 0.3s all ease;">
                <button id="hintSwitch">Hint</button>
                <img src="Images\qm.png" alt="Hint" style="margin-left: 5px; height: 40px; display: inline-block;">
            </div>

            <div id="tint"></div> 
                <?php if($user['last_level']==$user['last_hint_used']) 
                {?>
                    <div id="hint">
                <h3 style="color: #808080; margin-bottom: 20px;">Hint</h3>
                <div id="nohint">
                    <h2 style="color: #535252; font-size: 30px;">You have <span id="currentPoints" style="color: #0094ff;"> <?php echo $user['points']; ?> </span> points</h2>
                    <h2 style="color: #535252; font-size: 30px; margin-bottom: 20px;">You have already seen hint! <!--span id="hintCost" style="color: #0094ff;">50</span!--> points</h2>
                   <button class="hintBtn" style="margin-right: 10px; background-color: #3fc951; border: 1px solid green;" onclick="buyHint()">See Hint Again</button>
                </div>
                   <?php } 
                   else 
                    {?>
                <div id="hint">
                <h3 style="color: #808080; margin-bottom: 20px;">Hint</h3>
                <div id="nohint" style="margin-bottom: 20px; opacity: 1; position: absolute; -webkit-transition: 0.3s all ease;">
                    <h2 style="color: #535252; font-size: 30px;">You have <span id="currentPoints" style="color: #0094ff;"> <?php echo $user['points']; ?> </span> points</h2>
                    <h2 style="color: #535252; font-size: 30px; margin-bottom: 20px;">This hint costs <span id="hintCost" style="color: #0094ff;">50</span> points</h2>
                
                    <button class="hintBtn" style="margin-right: 10px; background-color: #3fc951; border: 1px solid green;" onclick="buyHint()">Buy Hint</button><button class="hintBtn" style="background-color: crimson; border: 1px solid maroon;" onclick="closeHintsDiag()">Don't buy</button>
                </div>
                <?php } ?>
                <div id="showhint" style="position: absolute; visibility: hidden; -webkit-transition: 0.5s all ease;">
                    <p id="hintText" style="height: 150px; width: 460px; overflow-y: scroll;"></p>
                    <button class="hintBtn" style="display: block; margin: auto;" onclick="closeHintsDiag()">Close</button>
                </div>
            </div>

        <div class="push"></div></div>
        <footer><a href="http://www.csivit.com" target="_blank" id="foot">© Computer Society of India | VIT Chapter</a></footer>

<script>
            var ques = <?php echo $level; ?>;
            
</script>
<script src="questionsecma.js"></script>
</body>
</html>