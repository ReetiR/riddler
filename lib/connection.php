<?php
 /*define( "DB_SERVER",    $_ENV['OPENSHIFT_MYSQL_DB_HOST'] );

    define( "DB_USER",      $_ENV['OPENSHIFT_MYSQL_DB_USERNAME'] );

    define( "DB_PASSWORD",  $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD'] );

    define( "DB_DATABASE",  $_ENV['OPENSHIFT_APP_NAME'] );*/


     //$mysqli = new mysqli(DB_SERVER,DB_USER,DB_PASSWORD,"ankit_csi_online");
//$mysqli = new mysqli("csiriddler.db.11831022.hostedresource.com", "csiriddler", "Abcd1234#", "csiriddler");
    $mysqli = new mysqli("localhost", "root", "root", "ankit_csi_online");
if (mysqli_connect_errno())
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

 //define( "DB_SERVER",    $_ENV['OPENSHIFT_MYSQL_DB_HOST'] );

    //define( "DB_USER",      $_ENV['OPENSHIFT_MYSQL_DB_USERNAME'] );

    //define( "DB_PASSWORD",  $_ENV['OPENSHIFT_MYSQL_DB_PASSWORD'] );

    //define( "DB_DATABASE",  $_ENV['OPENSHIFT_APP_NAME'] );
//$con = mysqli_connect("riddler-rotvic.rhcloud.com","adminl2Kn4VL","rUTH5sIgCYF8");

/*$con = mysqli_connect("localhost","root","");
if($con == false)
{
   echo "Connection Not Established Please Check!";
   exit;
}
$dbselect = mysqli_select_db($con,"sample");
if($dbselect == false)
{
	echo "Please Select Database!";
	exit;
}
if(!isset($_SESSION))
session_start();*/
 
?>