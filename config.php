<?php

$sqlite_dir = "c:/db/livechat.db";
$admin_username = "admin";
$admin_password = "password";
$startInstallation = false; // Set this to false once installed.
$databaseType = "sqlite";
$host = "localhost";
$database = "livechat";
$prefix_mysql = "lc_";
$username = "root";
$password = "...";
$sitename = "Livechat ver 1.0";

if($startInstallation == true) {
	if($databaseType == "sqlite") {
		$c = new SQLite3($sqlite_dir);

		$dropDatabaseTableUsers = "DROP TABLE users";
		$dropDatabaseTableChatrooms = "DROP TABLE chatroom";
		$dropDatabaseTableChatlogs = "DROP TABLE chatlog";

		$sqldrop1 = $c->query($dropDatabaseTableUsers);
		$sqldrop2 = $c->query($dropDatabaseTableChatrooms);
		$sqldrop3 = $c->query($dropDatabaseTableChatlogs);
		$sqlinstall1 = $c->query("CREATE TABLE IF NOT EXISTS users (
 username TEXT NOT NULL,
 passname TEXT NOT NULL,
 isbanned INTEGER NOT NULL DEFAULT 0,
 is_admin INTEGER NOT NULL DEFAULT 0,
 descript TEXT NOT NULL DEFAULT 'Hi I am new and just registered here.',
 id INTEGER NOT NULL PRIMARY KEY autoincrement
)");
		$sqlinstall2 = $c->query("CREATE TABLE IF NOT EXISTS chatroom (
 chatname TEXT NOT NULL,
 key TEXT NOT NULL,
 id INTEGER NOT NULL PRIMARY KEY autoincrement
)");
		$sqlinstall3 = $c->query("CREATE TABLE IF NOT EXISTS chatlog (
 chatroomid INTEGER NOT NULL,
 user TEXT NOT NULL,
 message TEXT NOT NULL,
 datePosted TEXT NOT NULL,
 id INTEGER NOT NULL PRIMARY KEY autoincrement
)");

		$c->close();
	}
	if($databaseType == "mysql") {
		$c = mysql_connect($host,$username,$password) or die("Mysql failed to connect!");
		
		$sqlCreateDatabase = "CREATE DATABASE IF NOT EXISTS ".$database;
		$sqlCreateUsers = "CREATE TABLE IF NOT EXISTS ".$prefix."users (
 username TEXT NOT NULL,
 passname TEXT NOT NULL,
 isbanned INT NOT NULL DEFAULT 0,
 is_admin INT NOT NULL DEFAULT 0,
 descript TEXT NOT NULL DEFAULT 'Hi I am new and just registered here.',
 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
)";
		$sqlCreateChatroom = "CREATE TABLE IF NOT EXISTS ".$prefix."chatroom (
 chatname TEXT NOT NULL,
 key TEXT NOT NULL,
 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
)";
		$sqlCreateChatlog = "CREATE TABLE IF NOT EXISTS ".$prefix."chatlog (
 chatroomid INT NOT NULL,
 user INT NOT NULL,
 message TEXT NOT NULL,
 datePosted TEXT NOT NULL,
 id INT NOT NULL AUTO_INCREMENT PRIMARY KEY
)";
		$install1 = mysql_query($sqlCreateUsers);
		if(!$install1) {
			die("Failed to install! ".mysql_error($install1));
		}
		$install2 = mysql_query($sqlCreateChatroom);
		if(!$install2) {
			die("Failed to install! ".mysql_error($install2));
		}
		$install3 = mysql_query($sqlCreateChatlog);
		if(!$install3) {
			die("Failed to install! ".mysql_error($install3));
		}
		mysql_close($c);
	}
}

?>