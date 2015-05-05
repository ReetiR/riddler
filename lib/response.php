<?php 
include_once 'functions.php';
include_once 'connection.php';
include_once 'globals.php';
session_start();
$q = $_REQUEST["q"];
$a = $_REQUEST["a"];


if(isset($_SESSION['login'])) {
		$r=$_SESSION['login'];
		$q="SELECT * from users where `reg_no`='$r'";
		$res=$mysqli->query($q) or die("error 1");
		if($res) {
			$user=$res->fetch_array();
			$level = $user['last_level'];
			$point= $user['points'];
			if ($level==0)
			{ $level=1; }
			$q2="SELECT * from questions where level='$level'";
			$res2=$mysqli->query($q2)  or die("error 2");
			if($res2) {
				$ques=$res2->fetch_array();
				$ques_type=$ques['type'];
				$ques_ans=$ques['answer'];
				//$user_ans=$_POST['ans'];
				//echo ">".$ques_ans."<>".$user_ans."<".$level;
				$dt=date("Y-m-d H:i:s");
				
				//if($ques_ans==$user_ans) {
				if(str_replace(array(' ','.','-'),'',trim(strtolower($ques_ans)))==str_replace(array(' ','.','-'),'',trim(strtolower($a))))
				{
					echo "0"."You got it!";
					$point+=10;
					//update database
					$q2="UPDATE users set last_level='".++$level."',last_level_time='".$dt."', points='".$point."' where `reg_no`='$r'";
					//echo $q2;
					$res3=$mysqli->query($q2) or die("<h2>Cannot update level</h2>");
					if($res3) {
						//echo 0;
						//success updating
					}
					else{}
				}
				else
				{	
					//echo 1;
					echo '1'.'You are really really really really close!';
				//$flag= 1;				
					//$_SESSION['message'] = "Wrong answer!";
				}
			}
		}
		//echo 1;
		//$goto = "question.php";
		//$goto = "question.php"//getLoadPage($level);
		//header("Location: question.php");?>
<?php } //else
//$goto = "index.php";
//header("Location: login.php");

//echo 'window.location.href="'.$goto.'";';
?>