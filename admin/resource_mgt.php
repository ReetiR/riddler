<?php
session_start();
if(empty($_SESSION['login_stat']))
{
		header("Location: index.php");
		exit();
}
include("../lib/connection.php");   
$presentsql= "SELECT resource_entry.id AS id, 
							resource_entry.level_id AS level_id, 
							resource_entry.category_id AS category_id, 
							resource_entry.file_nm AS file_nm, 
							resource_entry.text_embed_code AS text_embed_code, 
							resource_entry.created_at AS created_at, 
							resource_category.cat_name AS cat_name, 
							resource_level.level AS level
							FROM `resource_entry`
							INNER JOIN `resource_category` ON resource_entry.category_id = resource_category.id
							INNER JOIN `resource_level` ON resource_entry.level_id = resource_level.id
							ORDER BY `resource_entry`.`level_id`,`resource_entry`.`category_id`,`resource_entry`.`id`  ASC";

$resultk=$mysqli->query($presentsql);	
$num_rows=$resultk->num_rows;
							
if(!empty($_GET['p']))
{
	$p=$_GET['p'];
	$link_page=$p; 
}	
else
{  
		$p=1; 
}
/*Define Number of Rows You want to Display*/
		$list=6;
		$num=(integer)($num_rows/$list);
		if(($num_rows%$list)!=0)
		{
			$num=$num+1;
		}
		$not_found=$list*($p-1); 
		$no_list=11;
		$no_mid=intval($no_list/2);
		$first=$p-$no_mid;
		if($first<=0)
		{
			$first=1;
		}
		$last=$first+$no_list-1;
		if($last>$num)
		{				
			$last=$num;	
			$first=$last-$no_list+1;	
			if($first<=0)
			{
				$first=1;
			}		
		}
//////////////////////For Paging ------End Here////////////////////////////

$presentsql.="  LIMIT $not_found,$list"; 
$resnew =$mysqli->query($presentsql);
							
if(!empty($_REQUEST['msg']))
{
	$msg = $_REQUEST['msg'];
}
else
{
	$msg = "";
}
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
							<td colspan="4" class="black" align="center"><b>Resource Management</b></td>
							</tr>
							<tr height="10"><td colspan="2"></td></tr>
							<tr>		
							<td align="center" width="15%">&nbsp;</td>
							<td colspan="2" class="mysty4" align="center" width="70%" style="color:#FF0000;">&nbsp;<?php echo $msg; ?></td>
							<td align="center" width="15%">&nbsp;</td>
							</tr>
					</table>	
					
					
					<table width="52%" height="99" border="0" align="center" cellpadding="0" cellspacing="1" class="tab_sty1">
								<tr class="list" height="18">
								<td height="34" colspan="6" align="center" bgcolor="#000000" class="mysty2"><font color="#FFFFFF" size="2"><b>Resource Details</b></font>&nbsp;&nbsp;&nbsp;&nbsp;<a href="add_resource.php"><img src="../images/add.jpg" alt="" border="0" height="15" width="16"></a></td>
					  </tr>
								
								
								<tr bgcolor="#D4DCE4" height="18">        
								<td class="mysty1" align="center" ><b>Resource</b></td>  
                                <td class="mysty1" align="center" ><b>Level</b></td>  
								<td class="mysty1"  align="center"><b>Action</b></td>
								</tr>
<?php 
while($fetch_resource= $resnew->fetch_assoc())
{  
?>	 							
<tr bgcolor="#eeeeee">        
<td class="mysty1" align="center"><?php echo $fetch_resource['cat_name']; ?></td>  
<td class="mysty1" align="center"><?php echo $fetch_resource['level']; ?></td>    

<td align="center" ><a href="resource_details.php?id=<?php echo $fetch_resource['id']; ?>&level=<?php echo $fetch_resource['level_id']; ?>&catid=<?php echo $fetch_resource['category_id']; ?>" class="A3"  ><img src="../images/details.png" border="0"></a>&nbsp;<a href="resource_edit.php?id=<?php echo $fetch_resource['id']; ?>&level=<?php echo $fetch_resource['level_id']; ?>&catid=<?php echo $fetch_resource['category_id']; ?>" class="A3"  ><img src="../images/edit.png" border="0"></a>&nbsp;&nbsp;<a href="resource_delete.php?id=<?php echo $fetch_resource['id']; ?>" class="A3" onClick="return(confirm('Do you really want to Delete?'))"  ><img src="../images/delete.png" border="0"></a></td>							      
</tr>
<?php
}
?>								
								
		 </table>
         
          <!--No Need to Change Anything here Start-->
<p>&nbsp;</p>
<table align="center" border="0" cellpadding="0" cellspacing="0" width="52%">
               <tr>
                 <td class="paging">
				 <ul>
				<?php
				if($p!=1)
				{					
				?>				 
				<li><a href="resource_mgt.php?p=<?=$p-1?>" class="pre_nxt" >Previous</a></li>
				<?php
				}		
				?>	
		<li style="width:300px">
			<ul>
						<?php	
						for($i=$first;$i<=$last;$i++)
						{
							if($i==$p)
							{
							?>    			
								<li class="current"><a href="resource_mgt.php?p=<?php echo $i; ?>')" class="current"><?php print $i; ?></a></li>
							<?php
							}				
							if($i!=$p)
							{
							?>
								<li class="other"><a href="resource_mgt.php?p=<?php echo $i; ?>" class="other">
								<?php print $i; ?></a></li>
							<?php
							}
						}
						?>	 
			</ul>
		</li>
					<?php
					if($p!=$last)
					{					
					?>	
					<a href="resource_mgt.php?p=<?=$p+1?>" class="pre_nxt"><li>Next</li></a>
					<?php
					}
					?>
				 </ul>
				 </td>
               </tr>
</table>
<!--No Need to Change Anything here  end-->
         
		</td>
		</tr>
</table>




<p><img src="../images/white_px.jpg" border="0" height="10"></p> 
</body>
</html>
 