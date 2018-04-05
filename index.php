<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");
?>
<html>
 <head>
  <title><?php echo $sitename; ?></title>
 </head>
 <body>
  <center><p><a href='index.php'>Home</a> | <a href='enter.php?id=1'>Enter public room</a> | <a href='chatrooms.php?page=0'>Chatroom list</a> | <a href='logoutsession.php'>Logout of your session</a></p></center>
 </body>
</html>