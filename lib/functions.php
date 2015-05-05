<?php
function es($v) {
	return $mysqil->real_escape_string($v);
}


function addFacebookUser($name,$fbid,$email)
{
    global $mysqli;
     $res = $mysqli->query("SELECT * FROM users WHERE fb_id=$fbid");
    if($res->num_rows>0)
        return;
    $dtime =date("Y-m-d H:i:s");
    $reg_date = date("Y-m-d H:i:s");
    $sql_con="INSERT INTO users(email,password,registered_on,name,phoneno,status,type,last_level_time,fb_id) values('$email',' ',
                     '$reg_date',
                    '$name' , 
                    ' ',
                    'verified',
                    'aspirant','$dtime','$fbid');";
    $res = $mysqli->query($sql_con);
    return $res;
}

function isFBRegistered($id)
{
    global $mysqli;
    $res = $mysqli->query("SELECT count(*) as c FROM users WHERE fb_id='$id'");
    $row = $res->fetch_array();
    if($row['c']>0)
    	return true;
    return false;
}

function getEmail($id)
{
     global $mysqli;
    $res = $mysqli->query("SELECT * FROM users WHERE fb_id=$id");
    $row = $res->fetch_array();
    return $row['email'];
}
?>