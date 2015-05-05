<?php
$message ="";
include_once 'functions.php';
   include_once 'connection.php';
   include_once 'globals.php';
   if(isset($_POST['ans']))
   {
	   ;
	   $level = $_POST['level'];
	   $head = $_POST['head'];
	   $body = $_POST['body'];
	   $answer = $_POST['ans'];
	   $date = date("Y-m-d H:i:s");
	   $query = "SELECT * from questions where level = '$level' ";
	   $res = mysqli_query($con,$query);
	   $n = mysqli_num_rows($res);
	   if($n>=1)
	   {
		   $message = "Level $level exists!";
	   }
	   else
	   {
		   $query = "INSERT INTO questions(added_on,q_head,q_body,answer,level)
		   values('$date','$head','$body','$answer','$level');";
		   $res = mysqli_query($con,$query);
		   if($res)
		   $message = "Success!";
		   else $message = "Failure to insert into DB";
	   }
   }
   else $message = "Fill all fields";
   
  
?>

<?php include_once 'header1.php';?>

<?php include_once 'header2.php';?>
<div id="qfeed">
<h1>Question feed</h1>
<?php echo $message; $message=""; ?>
<form action="test.php" method="post" name="qfeed">
<table width="563" height="331" border="1">
  <tr>
    <th width="123" scope="row">Question Head:</th>
    <td width="184"><textarea name="head" id="head"></textarea></td>
  </tr>
  <tr>
    <th scope="row">Question Body:</th>
    <td><textarea name="body" id="body"></textarea></td>
  </tr>
  <tr>
    <th scope="row">Answer:</th>
    <td><input type="text" name="ans" id="ans"></td>
  </tr>
  <tr>
    <th scope="row">Level:</th>
    <td><input type="text" name="level" id="level"></td>
  </tr>
</table>
<input type="submit" value="submit" name ="submit">

</form>
</div>

<?php include_once 'footer.php';?>