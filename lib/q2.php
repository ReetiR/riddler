<!DOCTYPE html>
<html>
<title>Solve this FIRST to be at the foreFRONT of the game!</title>
<head>
<?php
$goto = "Q26(a).php";
if(isset($_POST['ans']))
{
   $ans = $_POST['ans'];
   if($ans != "Trimalchio in west egg" && $ans!="Trimalchio In West Egg" && $ans!="trimalchio in west egg")
   {
       $goto = "Q26(a).php";
   }
   else $goto="#";
} 
if($goto!="#")
echo "<script>window.location.href='".$goto."'</script>";
?>
</head>
</head>

<body>
<img src="media\Q26(b).jpg" width="400" height="600">

<br>
<b> Followed By? </b>

<!--> ALPHA <!-->
<form action="q3.php" method="post">
Ans : <input type="text" name="ans" id="ans">
<input type="submit">
</form>
</body>

</html>