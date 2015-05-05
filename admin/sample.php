<?php
include("../lib/connection.php"); 
/*$sql_chk="SELECT * FROM `riddler_admin` WHERE `adm_user`='riddler_csi' AND `adm_pass`='csi@vit_2013'";
$rs_chk=mysql_query($sql_chk);
while($row=mysql_fetch_array($rs_chk))
{
		echo $row['adm_user'];
}*/
for($i=1;$i<=31;$i++)
{
$str="Level ".$i;
		$query="INSERT INTO `resource_level` SET 
				`level`='$str'";
		$mysqli->query($query);
}
