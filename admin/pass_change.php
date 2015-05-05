<?php
session_start();
if(empty($_SESSION['login_stat']))
{
		header("Location: index.php");
		exit();
}
include("../lib/connection.php");   
	if(!empty($_REQUEST['mode']))
	{
					$old_password=$_REQUEST['old_password'];
					$new_password=$_REQUEST['new_password'];
 
					$sql_chk="select * from `riddler_admin` where loginid='adm_user' and password='$old_password'";
					$rs_chk=$mysqli->query($sql_chk);
					$checking = $rs_chk->num_rows;
					if($checking == '1')
					{			
										$qry1="update  `riddler_admin` set password='$new_password' where id ='1'";
										$rs1=$mysqli->query($qry1);
										if($rs1)
										{
										unset($_SESSION['login_stat']);
										session_destroy(); 
										?>
													<script language="javascript">
													alert("Password successfully changed.");
													window.location.href='index.php';
													</script>
										<?php
										}
					}
					else
					{
					?>
								<script language="javascript">
								alert("Your old password is incorrect. Please verify ...");
								window.location.href='pass_change.php';
								</script>
					<?php
					}
	} 
?>
<html>
<head>
<title>Admin Area</title>
<link href="../styles/admin_style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function validate()
{
						var first =document.f1.new_password.value;
						var second = document.f1.con_password.value;
						if(document.f1.old_password.value=='')
						{
							alert("Please enter Old Password.");
							document.f1.old_password.focus();
							return false;
						}
						
						if(document.f1.new_password.value=='')
						{
							alert("Please enter New Password.");
							document.f1.new_password.focus();
							return false;
						}
						
						if(document.f1.con_password.value=='')
						{
							alert("Please enter Confirm Password.");
							document.f1.con_password.focus();
							return false;
						}
						if(first!=second)
						{					
							alert("New Password does not match with Confirm Password. Please verify...");
							document.f1.con_password.focus();
							return false;
						}
}
</script>
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
										
<form name="f1" id="f1" method="post" action="pass_change.php" onSubmit="return validate();">
<input type="hidden"  name="mode" id="mode" value="1" >
<table class="tab_sty1" align="center" border="0" cellpadding="0" cellspacing="1" width="50%">
		 <tr class="mysty2" bgcolor="#A9B63D" height="18">
    				<td colspan="2" class="mysty2" align="center" bgcolor="#A9B63D"><span class="style2"><strong><font color="#ffffff">Change Password</font></strong></span></td>
		  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>
 
<tr>
<td class="mysty1" style="padding-left: 6px;" width="250">Old Password : </td>
<td width="332"><input type="password" name="old_password" size="20" maxlength="20"></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 


<tr>
<td class="mysty1" style="padding-left: 6px;" width="250">New Password : </td>
<td width="332"><input type="password" name="new_password" size="20" maxlength="20"></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 
 
<tr>
<td class="mysty1" style="padding-left: 6px;" width="250">Confirm Password: </td>
<td width="332"><input type="password" name="con_password" size="20" maxlength="20"></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr>



    <tr>
      <td colspan="2" style="padding-left: 50px;" align="center">
	  <input type="submit" value="Submit" name='submit'>
	   </td>
    </tr>
	
<tr><td colspan="2">&nbsp;</td></tr>
	
	</table>
</form>	
		</td>
		</tr>
</table>
<p><img src="../images/white_px.jpg" border="0" height="10"></p>
</body>
</html>
 