<?php error_reporting(0); ?>
<!DOCTYPE html>
<html>
<body>
<?php

function getLoadPage($qno)
{
	$page ="page";
	for($i=1;$i<=30;++$i)
	{
		if($i==$qno)
		{
			$page = $page + (+""+$qno+".html");
			echo "test";
			echo "page"+$qno+".html";
			return "page"+$qno+".html";
		}
	}
	return "page1.html";
}

   include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
   if(!isset($_SESSION))
   	session_start();
if(isset($_SESSION['login'])) {
		$r=$_SESSION['login'];
		$q="select * from users where `reg_no`='$r'";
		$res=$mysqli->query($q) or die("error 1");
		if($res) {
			$user=$res->fetch_array();
			$level = $user['last_level'];
			$point= $user['points'];
			if ($level==0)
			{ $level=1; }
			$q2="select * from questions where level='$level'";
			$res2=$mysqli->query($q2)  or die("error 2");
			if($res2) {
				$ques=$res2->fetch_array();
				$ques_type=$ques['type'];
				$ques_ans=$ques['answer'];
				$user_ans=$_POST['ans'];
				//echo ">".$ques_ans."<>".$user_ans."<".$level;
				$dt=date("Y-m-d H:i:s");
				
				//if($ques_ans==$user_ans) {
				if(str_replace(array(' ','.','-'),'',trim(strtolower($ques_ans)))==str_replace(array(' ','.','-'),'',trim(strtolower($user_ans)))){
					$point+=10;
					//update database
					$q2="update users set last_level='".++$level."',last_level_time='".$dt."', points='".$point."' where `reg_no`='$r'";
					//echo $q2;
					$res2=$mysqli->query($q2) or die("<h2>Cannot update level</h2>");
					if($res2) {
						//success updating
					}
				}
				else
				{					
					$_SESSION['message'] = "Wrong answer!";
				}
			}
		}
		$goto = "question.php";
		//$goto = "question.php"//getLoadPage($level);
		//header("Location: question.php");?>
<?php } else
$goto = "index.php";
//header("Location: login.php");
?>
<script>
<?php
echo 'window.location.href="'.$goto.'";';
?>
</script>
</body>
</html>