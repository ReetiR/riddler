<?php
session_start();
if(empty($_SESSION['login_stat']))
{
		header("Location: index.php");
		exit();
}
$msgdisplay="";
include("../lib/connection.php");  
 
$fetchid=$_REQUEST['id'];
$result = $mysqli->query("SELECT * FROM `questions` WHERE `id`='$fetchid' ");
$fetch_data=$result->fetch_array(); 
  		
?>
<html>
<head>
<title>Admin Area</title>
<link href="../styles/admin_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../jwplayer/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="8VKZWYxM1+BE36OSpH9mE9B+r8iLk9Kp0Uv6xQ==";</script>
</head> 

<body style="margin:0px; padding:0px;"> 
<?php include("header.php");    ?>



<table align="left" border="0" cellpadding="0" cellspacing="0" width="90%"  >
		<tr>
		<td align="left" valign="top" width="20%"> 
					 <?php include("left.php");    ?>
		</td>
		<td align="center" valign="top" width="68%">
		
					<table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
							<tr height="20"><td colspan="2"></td></tr>
							<tr>
							<td colspan="4" class="black" align="center"><b>View Question</b></td>
							</tr>
							<tr height="10"><td colspan="2"></td></tr>
							<tr>		
							<td align="center" width="15%">&nbsp;</td>
							<td colspan="2" class="mysty4" align="center" width="70%" style="color:#FF0000;">&nbsp;</td>
							<td align="center" width="15%">&nbsp;</td>
							</tr>
					</table>	
 		
					<table   align="center"  cellpadding="0" cellspacing="1" width="100%" style="border:1px solid #000000;">
		 <tr class="mysty2" bgcolor="#A9B63D" height="18">
    				<td colspan="2" class="mysty2" align="center" bgcolor="#000000"><span class="style2"><strong><font color="#ffffff">View Resource</font></strong></span></td>
		  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>
 
<td class="mysty1" align="center"><?php echo $fetch_data['q_body']; ?></td>

    <tr>
      <td colspan="2" style="padding-left: 50px;" align="center">
	   <input type="button" value="BACK" name='submit' onClick="window.location.href='ques_mgt.php'"></td>
    </tr>
	
<tr><td colspan="2">&nbsp;</td></tr>
	
	</table>
	 
		</td>
		</tr>
</table>
<p><img src="../images/white_px.jpg" border="0" height="10"></p>
</body>
</html>
 