<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");

$startTest = true;

$msg = $_POST['msg'];
$id = $_POST['view'];
$user = $_POST['user'];
$date = date("h:i:sa m/d/y");

// Start admin checking...

$c = new SQLite3($sqlite_dir);

$checkAdmin = $c->query("SELECT * FROM users WHERE username = '$user'");
while($r=$checkAdmin->fetchArray()) {
	$isAdmin = $r['is_admin'];
}

$c->close();

// End admin checking...

if($isAdmin !== 1) {
	$fixMsg = htmlspecialchars($msg);
	$msg = "(USER) ".$fixMsg;
} else {
	$addTag = "(ADMIN) ";
	$msg = $addTag.$msg;
}

if($startTest == true) {
	$c = new SQLite3($sqlite_dir);
	
	$postAnonymously = $c->prepare("INSERT INTO chatlog(chatroomid, user, message, datePosted) VALUES ($id, :user, :msg, '$date')");
	$postAnonymously->bindParam(":user", $user);
	$postAnonymously->bindParam(":msg", $msg);
	
	$postAnonymously->execute();
	
	$c->close();
	header("Location: livechat.php?id=$id");
} else {
	// Working on it.
}