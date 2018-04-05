<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");
?>
<html>
 <head>
  <title><?php echo $sitename; ?></title>
  <style>
iframe {
  position: absolute;
  top:0px;
  left:0px;
  width: 800px;
  height: 600px;
}
  </style>
 </head>
 <body>
  <?php
  
  $enterview = $_GET['id'];
  
  echo "<iframe frameborder='0' src='livechat.php?id=".$enterview."'></iframe>";
  
  ?>
 </body>
</html>