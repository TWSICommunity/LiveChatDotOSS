<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");

$c = new SQLite3($sqlite_dir);

$chatn = $_POST['chatname'];

$querySelect=$c->query("SELECT * FROM chatroom");
while($r=$querySelect->fetchArray()) {
	$chatroom_name = $r['chatname'];
	if($chatn == $chatroom_name) {
		die("Chatroom name already exists! <a href='chatrooms.php'>Go back and create another name for your room.</a>");
	}
}

$createRoom = $c->prepare("INSERT INTO chatroom (chatname, key) VALUES (:chatname, '')");
$createRoom->bindParam(":chatname", $chatn);

$createRoom->execute();

$c->close();
header("Location: chatrooms.php");
?>