<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");

if(isset($_POST['register'])) {
	$c = new SQLite3($sqlite_dir);
	
	$username = $_POST['username'];
	$password = hash("sha512",$_POST['password']);
	
	$search = $c->query("SELECT * FROM users");
	while($constructSearch = $search->fetchArray()) {
		$u = $constructSearch['username'];
		
		if($username == $u) {
			die("Username already exists! <a href='register.php'>Go back and register a different username.</a>");
		}
	}
	
	$createAccount = $c->prepare("INSERT INTO users (username, passname) VALUES (:username, '$password')");
	$createAccount->bindParam(":username", $username);
	
	$createAccount->execute();
	
	$selectAccount = $c->query("SELECT * FROM users WHERE username = '$username'");
	while($r=$selectAccount->fetchArray()) {
		$username_info = $r['username'];
		$id = $r['id'];
		$_SESSION['login_info'] = $username_info."|".$id;
	}
	$c->close();
	header("Location: enter.php?id=1");
}

if(isset($_POST['login'])) {
	$c = new SQLite3($sqlite_dir);
	
	$username = $_POST['username'];
	$password = hash("sha512",$_POST['password']);
	
	$getInfo = $c->query("SELECT * FROM users WHERE users = '$username'");
	while($u=$getInfo->fetchArray()) {
		$us=$u['username'];
		$ps=$u['passname'];
		$id=$u['id'];
		
		if($us == $username) {
			$_SESSION['login_info'] = $us."|".$id;
		}
	}
	$c->close();
	header("Location: enter.php?id=1");
}
?>