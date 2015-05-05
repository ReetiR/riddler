<?php
session_start();
?>
	<body>
        <div class="wrapper">
        <div id="qHeadLeft">
            <h1 id="qTitle">Riddler</h1>
        </div>
        <div id="qHeadRight">
             	<li><a href="index.php" class="qNavLinks">Home</a></li>
             	<?php 
                 echo '
                         <li><a href="leaderboard.php" class="qNavLinks">LeaderBoard</a></li>
						 <li><a href="http://riddlercsi.tumblr.com" target="_blank" class="qNavLinks">Forum</a></li>';

             		if($_SESSION['login']) 
             			{ 
						  echo '<li><a href="info.php" class="qNavLinks">Profile</a></li>';
						  echo '<li><a href="question.php" class="qNavLinks">Question</a></li>';
						  echo '<li><a href="passwordReset.php" class="qNavLinks">Change Password</a></li>';
					      echo '<li><a href="feedback.php" class="qNavLinks">Feedback</a></li>';
             		      echo '<li><a href="logout.php" class="qNavLinks" id="signOut">Logout</a></li>';
               			}       	
                 	else
                  {
                 	echo'<li><a href="index.php" class="qNavLinks" id="signOut">Sign In</a></li>';
                 		}		 
                 ?>           
              </ul>
        </div>