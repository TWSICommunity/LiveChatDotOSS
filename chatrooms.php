<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");
?>
<html>
 <head>
  <title><?php echo $sitename; ?> - Chatroom list</title>
 </head>
 <body>
  <center><p><a href='index.php'>Home</a> | <a href='enter.php?id=1'>Enter public room</a> | <a href='chatrooms.php?page=0'>Chatroom list</a> | <a href='logoutsession.php'>Logout of your session</a></p></center>
  <p><b>Livechat Official Chatrooms</b><br><a href='enter.php?id=1'>Public Chatroom</a><br><a href='enter.php?id=2'>OpenNIC Topic Discussions</a></p>
  <p><b>User Created chatrooms</b><br>
  <?php
   $c = new SQLite3($sqlite_dir);
   
   $page = $_GET['page'];
   if(empty($page)) { $page = 2; }
   
   $max = 10;
   $number = 0;
   $echoNumber = 0;
   $count = 0;
   $maxcount = 0;
   
   $grabList = $c->query("SELECT * FROM chatroom LIMIT ".$page.", 10"); //Use 3 as the starting point. Because we wanna avoid showing the official chats.
   while($r = $grabList->fetchArray()) {
	   echo "<a href='enter.php?id=".$r['id']."'>".$r['chatname']."</a><br>";
   }
   
   $list = $c->query("SELECT * FROM chatroom");
   while($pp = $list->fetchArray()) {
	   //$count = $count + 1;
	   //for($i=$count; $i < $max; $i++) {
		//   $number = $number + 10;
		//   $echoNumber = $echoNumber + 1;
		//   echo "[<a href='chatrooms.php?page=$number'>$echoNumber</a>] ";
		//   $max = $max + 10;
		$maxcount++;
   }
   for($i = 0; $i < $maxcount; $i++) {
	   $count++;
	   if($count >= $max) {
		   $number = $number + 10;
		   $echoNumber++;
		   echo "[<a href='chatrooms.php?page=$number'>$echoNumber</a>] ";
		   $max = $max + 10;
	   }
   }
   
   $c->close();
  ?>
  <form action='createchat.php' method='POST'>
   Chatname: <input type='text' name='chatname' /><br>
   <input type='submit' />
  </form>
 </body>
</html>