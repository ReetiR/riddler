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
$fetchid=$_REQUEST['id']; 

$result = $mysqli->query("SELECT * FROM `questions`  WHERE `id`='$fetchid' ");
$resultk = $mysqli->query("SELECT * FROM `resource_level`  ORDER BY  `id` ASC ");


$fetch_data= $result->fetch_array();



if(!empty($_REQUEST['mode']))
{ 

     $id = $_REQUEST['id'];		
	$created_at=date("Y-m-d H:i:s");
	$fetchqhead= $_REQUEST['q-head'];
		$fetchqbody=($_REQUEST['q_body']);
		$fetchans= $_REQUEST['ans'];	
		$fetchlevelval= $_REQUEST['level_id'];	
		$hint= $_REQUEST['hint'];
			$sql_con="Update `questions` SET 
							`level`='$fetchlevelval',
							`q_head`='$fetchqhead',
							`q_body`='$fetchqbody',
							`answer`='$fetchans',
							`added_on`='$created_at',
							`hint`='$hint'
							  WHERE `id`='$id' ";  
			$res=$mysqli->query($sql_con);	 
			if($res)	
			{
				@header("Location: ques_mgt.php?msg=Sucessful Edit");
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

	if(document.getElementById('q_body').value=='')
	{
		document.getElementById('q_body').style.backgroundColor='#70B3E0';q_body.focus();
		return false;
	}
	else
	{
		document.getElementById('q_body').style.backgroundColor ='';
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
<input type="hidden"  name="id" id="id" value="<?php echo $fetch_data['id']; ?>" />			
					<table   align="center"  cellpadding="0" cellspacing="1" width="100%" style="border:1px solid #000000;">
		 <tr class="mysty2" bgcolor="#A9B63D" height="18">
    				<td colspan="2" class="mysty2" align="center" bgcolor="#000000"><span class="style2"><strong><font color="#ffffff">Edit Question</font></strong></span></td>
		  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>


 
<tr>
<td class="mysty1"   width="250" align="right">Select Level :</td>
<td width="332">
<select name="level_id"  id="level_id" style="width:195px" onChange="window.location.href='ques_edit.php?id=<?php echo $fetchid; ?>&level='+this.value"  > 
			 <option value="0">SELECT LEVEL</option> 
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
<td width="332"><input name="q_head" size="48" id="q_head" type="text"value="<?php echo $fetch_data['q_head']; ?>"/></td>
</tr>

<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 

<tr>
<td class="mysty1"   width="250" align="right" valign="top">Question Body :</td>
<td width="332">
<textarea name="q_body" id="q_body" cols="50" rows="10"><?php echo ($fetch_data['q_body']); ?> </textarea>

</td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 

<tr>
<td class="mysty1"   width="250" align="right">Answer:</td>
<td width="332"><input name="ans" size="48" id="ans" type="text"value="<?php echo $fetch_data['answer']; ?>"/></td>
</tr>

<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 

 
<tr>
<td class="mysty1"   width="250" align="right">Hint:</td>
<td width="332"><input name="hint" size="48" id="hint" type="text"value="<?php echo $fetch_data['hint']; ?>"/></td>
</tr>

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
 