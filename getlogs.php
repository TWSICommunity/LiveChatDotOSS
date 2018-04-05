<?php

session_start();
$sessionId=session_id();
include("config.php");

// Testing purposes.
$start_test = true;
$id=$_GET['id'];

if(!empty($_SESSION['login_info'])) {
	$c = new SQLite3($sqlite_dir);
	
	$getRoomchatmsg = $c->query("SELECT * FROM chatlog WHERE chatroomid = $id");
	echo "<div id='chatlog'>";
	while($r=$getRoomchatmsg->fetchArray()) {
		echo "<i style='padding: 6px 6px 6px 6px; margin: 8px 8px 8px 8px; display: table;'>{".$r['datePosted']."} -> [".$r['user']."]: ".$r['message']."</i>";
	}
	echo "</div>";
	$c->close();
} else {
	if($start_test == true) {
		$c = new SQLite3($sqlite_dir);
	
		$getRoomchatmsg = $c->query("SELECT * FROM chatlog WHERE chatroomid = $id");
		echo "<div id='chatlog'>";
		while($r=$getRoomchatmsg->fetchArray()) {
			echo "<i style='padding: 6px 6px 6px 6px; margin: 8px 8px 8px 8px; display: inline-block;'>{".$r['datePosted']."} -> [".$r['user']."]: ".$r['message']."</i>";
		}
		echo "</div>";
		$c->close();
	} else {
		echo "<a href='login.php'>Login</a> or <a href='register.php'>Register</a> to view this chatroom..";
	}
}