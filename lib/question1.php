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

    <?php include_once('header2.php');?><!--/head><body-->

     
    <div id="Question">
    	<div id="message" style="color:red"><?php if(isset($_SESSION['message']))
	echo $_SESSION['message'];
	unset($_SESSION['message']);  ?></div>
    <?php
	echo $ques_body;

	?>
	 <br>
    <br>
    <br>
    <br>
    <br>
                <!--img src="\images\light.jpg" alt="Error. Please reload the page or try again later. Keep checking our Facebook page for updates. If the problem persists, please contact us."-->
     </div>

    
  
		<form id = "ansForm" action="response.php" method="post">
            <h3 id="counter" style="display: inline"><?php echo $level; ?></h3>/30
            <input type="text" name="ans" placeholder="Answer" id="ans" style="margin-left: 8px;" required/>
            <button type="submit" id="subBtn"><img src="images\next.png" alt="Submit" id="subPic"></button>
        </form>

        <div>
           
        </div>
        <!--/div-->
    <!--div style="position:absolute; z-index:100; right:0px; bottom:0px; color:#fff; background:#000;">Answer: 
    <form action="response.php" method="post">
    <input type="text" name="ans"/>
    <input type="submit"/>
    </form>
    </div-->

    <?php require_once 'footer.php'; ?>
