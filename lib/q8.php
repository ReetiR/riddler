<!DOCTYPE html>
<html>
<title>Solve this FIRST to be at the foreFRONT of the game!</title>
<head>
<?php
$goto = "Q26(a).php";
if(isset($_POST['ans']))
{
   $ans = $_POST['ans'];
   if($ans != "16" && $ans!="sixteen" && $ans!="Sixteen")
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
<img src="media\Q26(h).jpg" width="400" height="600">
<!--<iframe src="..\lib\Q21(i).html"></iframe>-->

<br>
<b>No-one can see him. He’s invisible.
No-one can defeat me. I’m.....?
</b>
<form action="q9.php" method="post">
Ans : <input type="text" name="ans" id="ans">
<input type="submit">
</form>
</body>

</html>