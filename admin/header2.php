
	</head>
    <body>
        <div id="qHeadLeft">
            <h1 id="qTitle">Riddler</h1>
        </div>
        <div id="qHeadRight">
             <ul id="qNav">
             	<li><a href="index.php" class="qNavLinks">Home</a></li>
             	<?php 
                 echo '
                         <li><a href="leaderboard.php" class="qNavLinks">LeaderBoard</a></li>;
						 <li><a href="riddlercsi.tumblr.com" class="qNavLinks">Forum</a></li>';

             		if(isset($_SESSION['login'])) 
             			{ 
						echo '
               			  <li><a href="question.php" class="qNavLinks">Question</a></li>';
						echo '
               			  <li><a href="passwordReset.php" class="qNavLinks">Change Password</a></li>';
					echo '
               			  <li><a href="feedback.php" class="qNavLinks">Feedback</a></li>';
             		echo '
               			  <li><a href="logout.php" class="qNavLinks" id="signOut">Sign Out</a></li>';
               			}       	
                 	else {
                 	echo'
                 		<li><a href="index.php" class="qNavLinks" id="signOut">Sign In</a></li>';
                 		}		 
                 ?>           
              </ul>
        </div>