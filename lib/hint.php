<?php 
$q = $_REQUEST["q"];
include_once 'connection.php'; 
session_start();

$r=$_SESSION['login'];
$q1="SELECT * from users where `reg_no`='$r'";
$res= $mysqli->query($q1) or die("error 1");
if($res) {
			$q2="select * from questions where level='$q'";
			/*$res2=mysqli_query($con,$q2)  or die("error 2");*/
			$res2= $mysqli->query($q2);
			if($res2) {
				/*$ques=mysqli_fetch_array($res2);*/
				$ques=$res2->fetch_array(); 
				}
//$hint = "This is a sample Hint. This is a sample Hint. This is a sample Hint. This is a sample Hint. This is a sample Hint. ";
			//$hint= $ques['hint'];
			/*$user=mysqli_fetch_array($res);*/
			$user= $res->fetch_array(); 
			$level= $user['last_level'];
			if($user['points']<50)
				$hint= "Not enough points";
			else if($user['last_level']==$user['last_hint_used'])
				$hint= $ques['hint'];
			else
			{
				$points= $user['points'];
				$points= $points-50;
				$hint= $ques['hint'];
				$q3 = "UPDATE `users` SET `points` = '$points', `last_hint_used`= '$level' WHERE `reg_no` = '$r'";
 				$res3 = $mysqli->query($q3);
 				if($res3){}
 					//echo "updated";
			}
			//echo $r;
			//if($user['status']!='verified')
				//$goto = urlencode("index.php?message=Not verified");
			//$level = $user['last_level'];
		}

?>
<!--script type="text/javascript">
			var cur_level= <?php// echo $user['last_level']; ?>;
			var last_hint= <?php //echo $user['last_hint_used']; ?>;
			var points  = <?php //echo $user['points'];?> ;
			//var hint = "<?php //echo $ques_hint1=$ques['hint'];	?>" ;
			//var i = false;
			var xmlhttp = new XMLHttpRequest();
				if(cur_level==last_hint)
				{
					alert("Question hint already used!");
				}
				else if(points<50)
				{
					alert("Not enough points!")
				}
				else
				{
					points = points-50;
					var param = "id=<?php //echo $user['id']?>&pts="+points.toString();
					 xmlhttp.open("POST",'addpoints.php',true);
					 xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					  xmlhttp.setRequestHeader("Content-length", param.length);
                     xmlhttp.send(param);
				}
			</script!-->

<?php 
//reduce points and then echo hint

echo $hint;

?>