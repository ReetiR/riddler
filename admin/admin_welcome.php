<?php
session_start();
if(empty($_SESSION['login_stat']) || empty($_SESSION['admin']))
{
		header("Location: index.php");
		exit();
}
	include("../lib/connection.php");    
?>
<html>
<head>
<title>Admin Area</title>
<link href="../styles/admin_style.css" rel="stylesheet" type="text/css">
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
							<td colspan="4" class="black" align="center">&nbsp;</td>
							</tr>
							<tr height="10"><td colspan="2"></td></tr>
							<tr>		
							<td align="center" width="15%">&nbsp;</td>
							<td colspan="2" class="mysty4" align="center" width="70%">&nbsp;</td>
							<td align="center" width="15%">&nbsp;</td>
							</tr>
					</table>						
					<table  align="center" border="0" cellpadding="0" cellspacing="1" width="100%">
								<tr class="list" height="18">
								<td colspan="4" align="center" style=" font-size:26px; color:#000000;">Welcome to the Administrator Zone</td>
								</tr> 
					</table>
		</td>
		</tr>
</table>
<p><img src="../images/white_px.jpg" border="0" height="10"></p>
</body>
</html>
  