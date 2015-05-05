<?php  
class leaderboard 
{    
    function __construct($mysqli) 
    {
         $this->mysqli=$mysqli;  
    } 
 
    function drawRow($i,$name,$level,$points,$lasttime)
    { 
        $tme = date('Y-m-d H:i:s', strtotime($lasttime)+45000); 
        echo "<tr><td>$i</td><td>$name</td><td>$level</td><td>$points</td><td>$tme</td></tr>";
    }

    function drawTable()
    {
        $query = "SELECT *  FROM  `users`  WHERE 1  ORDER BY last_level DESC , last_level_time ASC  LIMIT 0,30";
        $res = $this->mysqli->query($query);
        if(!$res)
        echo "Unable to fetch data";
        else
        {
            $i = 1;
            while($row = $res->fetch_array())
            {
                $last_level = $row['last_level'];
                if($last_level>30)
                $last_level = "Finished";
                $this->drawRow($i,$row['name'],$last_level,$row['points'],$row['last_level_time']);
                $i++;
            }
        }
    }
    
    function getLevelCount($i) //gets number of people who are on level i
    { 
         $query = "SELECT COUNT( * ) as count  FROM  `users`  WHERE last_level =$i";
         $res = $this->mysqli->query($query);
         if(!$res)
         {
            echo "Unable to fetch data";
            return 0;
         }
         else
         {
             $row = $res->fetch_array();
             return $row['count'];
         }
         
    }
    
    function printStats() //Prints no. of people on each level.
    { 
            //echo "<h3>No. of people on level :</h3>";
            for($i=1;$i<=LEVEL_COUNT;$i++)
            echo "<tr><td>Level #$i :</td><td> ".$this->getLevelCount($i)."</td>
            </tr>";    
    } 
}
?>