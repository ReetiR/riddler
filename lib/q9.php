<!DOCTYPE html>
<html>
<title>Solve this FIRST to be at the foreFRONT of the game!</title>
<head>
<?php
$goto = "Q26(a).php";
if(isset($_POST['ans']))
{
   $ans = $_POST['ans'];
   if($ans != "invincible" && $ans!="Invincible")
   {
       $goto = "Q26(a).php";
   }
   else $goto="#";
} 
if($goto!="#")
echo "<script>window.location.href='".$goto."'</script>";
?>
</head>

<body>


<br>

<!--b>You've done a great job. Want a clue? I will give you 3!</b><br>
<ul>

<li><b> You might wanna go back and check the previous unused clues.</b></li><br>
<li><b> And all these pages...<i> we have something in common</i>, what are we?</b></li><br>
<li><b> If the 2nd clue did not help, then the 2nd keyword that you are looking for, has been given in that clue itself.</b></li>
<br><br>
</ul!-->
<em>Look carefully and then go forth, go to question.php to avail your reward!</em>
</body>

</html>