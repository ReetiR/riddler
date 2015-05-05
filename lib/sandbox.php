<?php
session_start();
include_once 'functions.php';
include_once 'connection.php';  
include_once 'globals.php';
$res = 1;
		if($res) {
			$level = $_GET['q'];
			if ($level==0)
			$level=1;
			
			$row['count']=LEVEL_COUNT;
			
			$sql_chk="SELECT count(*) as count FROM questions WHERE 1"; 
			$rcount= $mysqli->query($sql_chk);
			/*$rcount = mysqli_query($con,"SELECT count(*) as count FROM questions WHERE 1;");*/
			/*if($rcount)
			$row = mysqli_fetch_array($rcount);*/
			if($rcount)
			$row=$rcount->fetch_array(); 
			
			
			$q2="select * from questions where level='$level'";
			/*$res2=mysqli_query($con,$q2)  or die("error 2");*/
			$res2= $mysqli->query($q2);
			if($res2) {
				/*$ques=mysqli_fetch_array($res2);*/
				$ques=$res2->fetch_array(); 
				$ques_type=$ques['type'];
				$ques_head=$ques['q_head'];
				$ques_body=$ques['q_body'];
				$hint = $ques['hint'];
			}
		$q3="select * from story where level='$level'";
			/*$res2=mysqli_query($con,$q2)  or die("error 2");*/
			$res3= $mysqli->query($q3);
			if($res3->num_rows==1)
				$story=$res3->fetch_array(); 
		}
?>
<?php require_once 'header1.php';?>
<?php 
     

    if(isset($ques_head) and $ques_head!="")
	      echo $ques_head;
		  else echo "<title>Riddler</title>";
		  
		  
		  ?>
<?php
	//echo $ques_head;
	?>

   <?php include_once('header2.php');
    if(!empty($story['text']))
    	{ ?>}
    <div id="story">
        <p style="overflow-wrap: break-word; margin-bottom: 5px;"><?php echo $story['text'] ?></p>
        <button class="hintBtn" style="color: #fff; background-color: #535252;" onclick="hideStory()">Hide</button>
    </div>
     <?php } ?>
    
    <div id="Question">
        <!--p id="textQuestion">Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman Batman </p>
        <img src="images\tick.png" alt="Something isn't right. Try reloading the page and keep checking fb.com/csiriddler for updates. If the problem persists, please get in touch with us" id="questionImg"!-->
<?php echo $ques_body; ?>
    </div>
     
    <?php if(isset($_SESSION['message']))
    ?></div!-->
    <?php
	//echo $ques_body;

	?>
	
     <div id="ansForm">
                <p id="closeness" style="margin-bottom: -2px; height: 21px;"></p>
                <h3 id="counter" style="display: inline"><?php echo $level; ?></h3>/30
                <input type="text" name="answer" placeholder="Answer" id="ans" onkeypress="enterer(event)" style="margin-left: 8px;">
                <button id="subBtn" onclick="check(document.getElementById('ans').value)"><img src="images\next.png" alt="Submit" id="subPic"></button>
                <img src="images\tick.png" alt="" style="position: relative; height: 30px; top: 5px; right: 35px;">
                <a href="question.php" id="nextqLink">Next question</a>
            </div>
        
            <div id="questionmark" style="position: relative; top: 35px; width: 130px; left: -88px; -webkit-transition: 0.3s all ease; transition: 0.3s all ease;">
                <button id="hintSwitch">Hint</button>
                <img src="images\qm.png" alt="Hint" style="margin-left: 5px; height: 40px; display: inline-block;">
            </div>

            <div id="tint"></div> 
                <?php if($user['last_level']==$user['last_hint_used']) 
                {?>
                    <div id="hint">
                <h3 style="color: #808080; margin-bottom: 20px;">Hint</h3>
                <div id="nohint">
                    <?php echo $hint;?>
                   <button class="hintBtn" style="margin-right: 10px; background-color: #3fc951; border: 1px solid green;" onclick="closeHintsDiag()">Close</button>
                </div>
                   <?php } 
                   else 
                    {?>
                <div id="hint">
                <h3 style="color: #808080; margin-bottom: 20px;">Hint</h3>
                <div id="nohint" style="margin-bottom: 20px; opacity: 1; position: absolute; -webkit-transition: 0.3s all ease;">
                    <?php echo $hint;?></button><button class="hintBtn" style="background-color: crimson; border: 1px solid maroon;" onclick="closeHintsDiag()">Don't buy</button>
                </div>
                <?php } ?>
                <div id="showhint" style="position: absolute; visibility: hidden; -webkit-transition: 0.5s all ease;">
                    <p id="hintText" style="height: 150px; width: 460px; overflow-y: scroll;"></p>
                    <button class="hintBtn" style="display: block; margin: auto;" onclick="closeHintsDiag()">Close</button>
                </div>
            </div>

        <div class="push"></div></div>
        <footer><a href="http://www.csivit.com" target="_blank" id="foot">© Computer Society of India | VIT Chapter</a></footer>

<script>
            var ques = <?php echo $level; ?>;

</script>
<script src="questionsecma.js"></script>
</body>
</html>