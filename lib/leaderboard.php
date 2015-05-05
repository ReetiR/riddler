<?php 
    include_once 'globals.php';
    include_once 'connection.php';
    include_once 'functions.php';
    include_once 'leaderboardclass.php';
    if(!isset($_SESSION))
        session_start(); 
    
    $getdata       = new leaderboard($mysqli);  
    
	 $query = "SELECT *  FROM  `users`  WHERE 1  ORDER BY last_level DESC , last_level_time ASC  LIMIT 1";
        $res = $mysqli->query($query);
		
	$userreg=$_SESSION['login'];
	$query2 = "SELECT *  FROM  `users`  WHERE 1  ORDER BY last_level DESC , last_level_time ASC";
	$res1 = $mysqli->query($query2);
	$i=0;
	while($row1=$res1->fetch_array())
	{
		$i++;
		if($row1['reg_no']==$userreg)
		{
			$rank=$i;
		}
	}  
?>

<?php require_once 'header1.php';?>
<title>Riddler - Leaderboard</title>

             <?php require_once 'header2.php';?>
			 
             <div id="firstPlaceDiv" style="position: relative; ">
            <img src="Images/R.png" alt="First Place" style="height: 190px; margin-right: 10px;">
            <div style="display: inline-block; position: absolute; top: 0;">
            <h1 style="margin-bottom: 0; color: #0094ff; margin-top:10px; font-size: 45px;">#1</h1>
            <?php while($row = $res->fetch_array())
            {?>
                <h2 style="margin-top: 0;"><?php echo $row['name'];?></h2>
            <h3 style="margin: 0px; color: #808080">Current Position: </h3>
            <h3 style="display: inline-block; margin: 0;" id="leadPosition">Question <?php echo $row['last_level'];} ?></h3>
            </div>
        </div>
  <?php   if(isset($_SESSION['login'])) 
             			{ ?>
        <div id="yourPositionDiv">
            <h1 id="rank" style="font-size: 30px; margin: 0; color: #0094ff;"># <?php echo $rank; ?></h1>
            <h4 style="margin: 0;">Your Current Rank</h4>
        </div><?php }?>
        
        <table id="rankTable">
            <thead>
                <tr>
                <th style="width: auto;">Rank</th><th style="margin-left: 10px;">Username</th><th style="margin-left: 10px;">Current Level</th><th style="margin-left: 10px;">Points</th><th style="margin-left: 10px;">Last Level Finished At</th>
                </tr>
            </thead>
            <tbody>
             <?php $drawtable    = $getdata->drawTable(); ?>
             </table>
        
        <table id="rankTable">
            <thead>
                <tr>
                <th style="width: auto;">Question Number</th><th style="margin-left: 10px;">Number of Players</th>
                </tr>
            </thead>
            <tbody>
            <?php $printStatus  = $getdata->printStats(); ?>
			 </table>
        <hr style="position: relative; margin-top: 180px; margin-bottom: 30px; visibility: hidden;">
        <a href="http://vit.csivellore.net" target="_blank" id="foot">
            © Computer Society of India | VIT Chapter
        </a>
    </body> 
</html>
