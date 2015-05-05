<?php
session_start();
if(empty($_SESSION['login_stat']))
{
		header("Location: index.php");
		exit();
}
$msgdisplay="";
include("../lib/connection.php");  
if(!empty($_REQUEST['level']))
{
	$fetchlevel=$_REQUEST['level'];
}
else
{
	$fetchlevel="0";
}


$resultk = $mysqli->query("SELECT * FROM `resource_level`  ORDER BY  `id` ASC ");

	if(!empty($_REQUEST['mode']))
	{ 	 
	$fetchlevelval=$_REQUEST['level_id'];
	$created_at=date("Y-m-d H:i:s");
	
		$fetchqbody=($_REQUEST['q_body']); 
		$fetchqhead=$_REQUEST['q_head'];
		$fetchans=$_REQUEST['answer'];	
		$hint=$_REQUEST['hint'];
			
			$sql_con="INSERT INTO `questions` SET 
							`level`='$fetchlevelval',
							`q_head`='$fetchqhead',
							`q_body`='$fetchqbody',
							`answer`='$fetchans',
							`added_on`='$created_at',
							`hint`='$hint'";  
			$res=$mysqli->query($sql_con);	 
			if($res)	
			{
				@header("Location: ques_mgt.php?msg=Sucessful Insert");
				exit();
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
	if(document.getElementById('level_id').value=='0')
	{
		document.getElementById('level_id').style.backgroundColor='#70B3E0';
		document.f1.level_id.focus();
		return false;
	}
	else
	{
		document.getElementById('level_id').style.backgroundColor ='';
	}		

	if(document.getElementById('q_body').value=='')
	{
		document.getElementById('q_body').style.backgroundColor='#70B3E0';q_body.focus();
		return false;
	}
	else
	{
		document.getElementById('q_head').style.backgroundColor ='';
	} 
	
	if(document.getElementById('q_head').value=='')
	{
		document.getElementById('q_head').style.backgroundColor='#70B3E0';q_body.focus();
		return false;
	}
	else
	{
		document.getElementById('q_head').style.backgroundColor ='';
	} 	
	
	if(document.getElementById('answer').value=='')
	{
		document.getElementById('answer').style.backgroundColor='#70B3E0';q_body.focus();
		return false;
	}
	else
	{
		document.getElementById('answer').style.backgroundColor ='';
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
							<td colspan="4" class="black" align="center"><b>Question Management</b></td>
							</tr>
							<tr height="10"><td colspan="2"></td></tr>
							<tr>		
							<td align="center" width="15%">&nbsp;</td>
							<td colspan="2" class="mysty4" align="center" width="70%" style="color:#FF0000;">&nbsp;<?php echo $msgdisplay; ?></td>
							<td align="center" width="15%">&nbsp;</td>
							</tr>
					</table>	
<form name="f1" id="f1" method="post" action="" enctype="multipart/form-data" onSubmit="return validate();"> 					
<input type="hidden"  name="mode" id="mode" value="1" >					
					<table   align="center"  cellpadding="0" cellspacing="1" width="100%" style="border:1px solid #000000;">
		 <tr class="mysty2" bgcolor="#A9B63D" height="18">
    				<td colspan="2" class="mysty2" align="center" bgcolor="#000000"><span class="style2"><strong><font color="#ffffff">Add Question</font></strong></span></td>
		  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>


 
<tr>
<td class="mysty1"   width="250" align="right">Select Level :</td>
<td width="332">
<select name="level_id"  id="level_id" style="width:195px" onChange="window.location.href='add_ques.php?level='+this.value"  > 
			 <option value="0">--SELECT--</option> 
			 <?php while($fetch_level=$resultk->fetch_array())
			 { 
			 ?>
			  <option value="<?php echo $fetch_level['id']; ?>" <?php if($fetchlevel==$fetch_level['id'])  echo "selected";?> ><?php echo $fetch_level['level']; ?></option>
			 <?php
			 }
			 ?>
</select> 
</td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 

<tr>
<td class="mysty1"   width="250" align="right">Question Head:</td>
<td width="332"><input name="q_head" size="48" id="q_head" type="text"></td>
</tr>

<tr>
<td class="mysty1"   width="250" align="right" valign="top">Question Body :</td>
<td width="332">
<textarea name="q_body" id="q_body" cols="50" rows="10"></textarea>

</td>
</tr>

<tr>
<td class="mysty1"   width="250" align="right">Answer:</td>
<td width="332"><input name="answer" size="48" id="answer" type="text"></td>
</tr>

<tr>
<td class="mysty1"   width="250" align="right">Hint:</td>
<td width="332"><input name="hint" size="48" id="hint" type="text"></td>
</tr>

<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
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
 