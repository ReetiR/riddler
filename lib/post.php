<?php
  
  require_once('facebook-php-sdk-master/src/facebook.php');
  require_once('sdk/src/facebook.php');

  $config = array(
    'appId' => 164739567049329,
  );

  $facebook = new Facebook($config);
  $user_id = $facebook->getUser();
?>
<html>
  <head>
<script>
 window.fbAsyncInit = function() {
  FB.init({
    appId      : '164739567049329', // App ID
    channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
    status     : true, // check login status
    cookie     : true, // enable cookies to allow the server to access the session
    xfbml      : true  // parse XFBML
  }); 
  FB.Event.subscribe('auth.authResponseChange', function(response) { 
    if (response.status === 'connected') {
      testAPI();
    } else if (response.status === 'not_authorized') {
      FB.login();
    } else {
    }
  });
  };
    (function(d){
   var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
   if (d.getElementById(id)) {return;}
   js = d.createElement('script'); js.id = id; js.async = true;
   js.src = "//connect.facebook.net/en_US/all.js";
   ref.parentNode.insertBefore(js, ref);
  }(document));
  </script>

  </head>
  <body>

  <?php
    if($user_id) {

      try {
        $ret_obj = $facebook->api('/me/feed', 'POST',
                                    array(
                                      'link' => 'riddler.csivit.com/Riddler_check',
                                      'message' => 'Posting with the PHP SDK and graph FB API! hope this works'
                                 ));
        //echo '<pre>Post ID: ' . $ret_obj['id'] . '</pre>';
        echo 'Post ID:' . $ret_pbj['id'] ;
        
        echo '<br /><a href="' . $facebook->getLogoutUrl() . '">logout</a>';
      } catch(FacebookApiException $e) {
        $login_url = $facebook->getLoginUrl( array(
                       'scope' => 'publish_stream'
                       )); 
        echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      $login_url = $facebook->getLoginUrl( array( 'scope' => 'publish_stream' ) );
      echo 'Please <a href="' . $login_url . '">login.</a>';

    } 

  ?>      

  </body> 
</html>  