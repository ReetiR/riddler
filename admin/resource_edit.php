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
if(!empty($_REQUEST['catid']))
{
	$fetchcat=$_REQUEST['catid'];
}
else
{
	$fetchcat="0";
}
$fetchid=$_REQUEST['id'];
$result = $mysqli->query("SELECT * FROM `resource_entry` WHERE `id`='$fetchid' ");
$fetch_data=$result->fetch_array(); 

$resultk = $mysqli->query("SELECT * FROM `resource_level`  ORDER BY  `id` ASC ");
$resultcategory = $mysqli->query("SELECT * FROM `resource_category`  ORDER BY  `id` ASC ");



if(!empty($_REQUEST['mode']))
{ 

     $id = $_REQUEST['id'];		
	$fetchlevelval=$_REQUEST['level_id'];
	$fetchcatval=$_REQUEST['category_id'];
	$created_at=date("Y-m-d H:i:s");
	
	if($fetchcat!=5 && $fetchcat!=1) 
	{		
			 //////////////////////////////////////////////// Code for upload Start //////////////////////////////
						$uploadlocation="../uploaded/";
						$fetchOldimage = $_REQUEST['oldimage'];
						$fetchFileName = $_FILES['image0']['name'];
						$rand_variable = rand(1111, 9999);
						$new_file=$rand_variable."_".$fetchFileName;
						if(is_uploaded_file($_FILES['image0']['tmp_name']))
						{
								// ~~~~~~~~~ Delete Previous image Start  ~~~~~~~~~~ //
								@unlink($uploadlocation.$fetchOldimage);
								// ~~~~~~~~~ Delete Previous image End  ~~~~~~~~~~ //
								@move_uploaded_file($_FILES['image0']['tmp_name'],$uploadlocation.$new_file);
								$updatedFileName=$new_file;
						}
						else
						{
								$updatedFileName=$fetchOldimage;
						}
			//////////////////////////////////////////////// Code for upload End //////////////////////////////
			$fetchtxtembedcode="";
	}
	else
	{
		$fetchtxtembedcode=addslashes($_REQUEST['text_embed_code']); 
		$updatedFileName="";
	}		
			
			$sql_con="Update `resource_entry` SET 
							`level_id`='$fetchlevelval',
							`category_id`='$fetchcatval',
							`file_nm`='$updatedFileName',
							`text_embed_code`='$fetchtxtembedcode',
							`created_at`='$created_at'  WHERE `id`='$id' ";  
			$res=$mysqli->query($sql_con);	 
			if($res)	
			{
				@header("Location: resource_mgt.php?msg=Sucessful Edit");
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
	
	if(document.getElementById('category_id').value=='0')
	{
		document.getElementById('category_id').style.backgroundColor='#70B3E0';
		document.f1.level_id.focus();
		return false;
	}
	else
	{
		document.getElementById('category_id').style.backgroundColor ='';
	} 	 
<?php if($fetchcat==5 || $fetchcat==1) { ?>	 
	if(document.getElementById('text_embed_code').value=='')
	{
		document.getElementById('text_embed_code').style.backgroundColor='#70B3E0';
		document.f1.text_embed_code.focus();
		return false;
	}
	else
	{
		document.getElementById('text_embed_code').style.backgroundColor ='';
	} 	
<?php } ?>	 				 																															
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
							<td colspan="4" class="black" align="center"><b>Resource Management</b></td>
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
<input type="hidden"  name="id" id="id" value="<?php echo $fetch_data['id']; ?>" >	
<input type="hidden" name="oldimage" value="<?php echo $fetch_data['file_nm']; ?>" />			
					<table   align="center"  cellpadding="0" cellspacing="1" width="100%" style="border:1px solid #000000;">
		 <tr class="mysty2" bgcolor="#A9B63D" height="18">
    				<td colspan="2" class="mysty2" align="center" bgcolor="#000000"><span class="style2"><strong><font color="#ffffff">Add Resource</font></strong></span></td>
		  </tr>
		<tr><td colspan="2">&nbsp;</td></tr>


 
<tr>
<td class="mysty1"   width="250" align="right">Select Level :</td>
<td width="332">
<select name="level_id"  id="level_id" style="width:195px" onChange="window.location.href='resource_edit.php?id=<?php echo $fetchid; ?>&level='+this.value"  > 
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
<td class="mysty1"   width="250" align="right">Select Type :</td> 
<td width="332">
<select name="category_id"  id="category_id" style="width:195px" onChange="window.location.href='resource_edit.php?id=<?php echo $fetchid; ?>&level=<?php echo $fetchlevel; ?>&catid='+this.value"   > 
			 <option value="0">--SELECT--</option> 
			 <?php while($category=$resultcategory->fetch_array())
			 { 
			 ?>
			  <option value="<?php echo $category['id']; ?>"  <?php if($fetchcat==$category['id'])  echo "selected";?> ><?php echo $category['cat_name']; ?></option>
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




 
<?php
if($fetchcat!=5 && $fetchcat!=1)
{
?>
<tr>
<td class="mysty1"   width="250" align="right">Upload :</td>
<td width="332"><input type="file" name="image0" id="image0"   ></td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5"><a href="viewfiles.php?id=<?php echo $fetch_data['id']; ?>&level=<?php echo $fetch_data['level_id']; ?>&catid=<?php echo $fetch_data['category_id']; ?>">View Files</a></td>
</tr> 
<?php
}
?>

<?php
if($fetchcat==5 || $fetchcat==1)
{
?>
<tr>
<td class="mysty1"   width="250" align="right" valign="top">Text/Embed Code :</td>
<td width="332">
<textarea name="text_embed_code" id="text_embed_code" cols="50" rows="10"><?php echo stripslashes($fetch_data['text_embed_code']); ?></textarea>

</td>
</tr>
<tr>
<td height="5">&nbsp;</td>
<td height="5">&nbsp;</td>
</tr> 
<?php
}
?>
 

 
 


 

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
 