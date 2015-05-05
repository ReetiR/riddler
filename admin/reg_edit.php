<?php
session_start();
if(empty($_SESSION['login_stat']))
{
		header("Location: index.php");
		exit();
}
include("../lib/connection.php");
	$id=$_REQUEST['id'];  
	if(!empty($_REQUEST['mode']))
	{
		$fetch_pid=$_REQUEST['id'];
		$fetchstatus= $_REQUEST['status']; 
		$sql_insert="UPDATE `users` SET
					`status`= '$fetchstatus'
					WHERE `id`='$fetch_pid'";
		$res_insert=$mysqli->query($sql_insert);
		if($res_insert)
					{
							header("Location: reg_mgt.php?msg=Successful edit");
							exit();
					}		 
	}	 
$sql_student="SELECT * FROM `users` WHERE `id`='$id'";
$rs_student= $mysqli->query($sql_student);
$row_student= $rs_student->fetch_array();				
?>
<html>
<head>
<title>Admin Area</title>
<link href="../styles/admin_style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function validate()
{ 
						if(document.f1.status.value=='0')
						{
							alert("Please Select Status");
							document.f1.status.focus();
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
							<td colspan="4" class="black" align="center"><b>Registration Management</b></td>
							</tr>
							<tr height="10"><td colspan="2"></td></tr>
							<tr>		
							<td align="center" width="15%">&nbsp;</td>
							<td colspan="2" class="mysty4" align="center" width="70%" style="color:#FF0000;">&nbsp; </td>
							<td align="center" width="15%">&nbsp;</td>
							</tr>
					</table>	
<form name="f1" id="f1" method="post" action="" enctype="multipart/form-data" onSubmit="return validate();"> 					
<input type="hidden"  name="mode" id="mode" value="1" >		
<input type="hidden"  name="id" id="id" value="<?php echo $id; ?>" >	 
					<table class="tab_sty1" align="center" border="0" cellpadding="0" cellspacing="1" width="100%">
		 <tr class="mysty2" bgcolor="#999999" height="18">
    				<td colspan="2" class="mysty2" align="center" bgcolor="#999999"><span class="style2"><strong><font color="#ffffff">Edit User</font></strong></span></td>
		  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>

<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 

<tr>
<td class="mysty1"   width="250" align="right">Name :</td>
<td width="332"><input name="name" size="48" id="name" type="text" value="<?php echo $row_student['name']; ?>" readonly></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 


<tr>
<td class="mysty1"   width="250" align="right">University :</td>
<td width="332"><input name="univ" size="48" id="univ" type="text" value="<?php echo $row_student['university']; ?>" readonly></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 


<tr>
<td class="mysty1"   width="250" align="right">Email:</td>
<td width="332"><input name="email" id="email" cols="36" rows="10" value="<?php echo $row_student['email']; ?>" readonly>
</td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 


<tr>
<td class="mysty1"   width="250" align="right">Phone No:</td>
<td width="332"><input name="phoneno" size="48" id="phoneno" type="text" value="<?php echo $row_student['phoneno']; ?>" readonly></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 

<tr>
<td class="mysty1"   width="250" align="right">Status:</td>
<td width="332"><select name="status" id="status" style="width:318px;">
		<option value="0">Please select</option>
		<option value="verified" <?php if($row_student['status']=="verified") { echo "selected"; }?>>Verified</option>
        <option value="unverified" <?php if($row_student['status']=="unverified") { echo "selected"; }?>>Unverified</option>
		</select>
		</td>
</tr>

    <tr>
      <td colspan="2" style="padding-left: 50px;" align="center">
	   <input type="submit" value="Submit" name='submit'></td>
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