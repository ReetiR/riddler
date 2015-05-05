<!DOCTYPE html>
<html>
<title>Solve this FIRST to be at the foreFRONT of the game!</title>
<head>
<?php
$goto = "Q26(a).php";
if(isset($_POST['ans']))
{
   $ans = $_POST['ans'];
   if($ans != "length" && $ans!="Length")
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
<img src="media\Q26(f).jpg" width="400" height="600">

<br>

<!--Aleph-->
<b>Have you seen me before?</b>
<form action="q7.php" method="post">
Ans : <input type="text" name="ans" id="ans">
<input type="submit">
</form>
</body>

</html>