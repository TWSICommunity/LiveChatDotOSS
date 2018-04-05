<?php
// First start the session...
session_start();
$sessionId=session_id();
include("config.php");

// Testing purposes.
$start_test = true;
$id=$_GET['id'];
?>
<html>
<head>
<style>
body {
	border:1px solid black;
}
</style>
</head>
<body onload = "livechat_reload(<?php echo $id; ?>)">
<?php
echo "<a href='chatrooms.php' target='_parent'>Return back to the list.</a><br>";
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
		echo "<b><i>You may still <a href='login.php' target='_parent'>Login</a> or <a href='register.php' target='_parent'>Register</a> Today while in this room.</i></b>";
	} else {
		echo "<a href='login.php' target='_parent'>Login</a> or <a href='register.php' target='_parent'>Register</a> to view this chatroom..";
	}
}
?>
<a name="endpost">
<form action='post.php' method='POST'>
<input type='hidden' name='view' value='<?php echo $id; ?>' /><input type='hidden' name='user' value='<?php if(empty($_SESSION['login_info'])) { echo "Anonymous"; } else { $split = explode("|", $_SESSION['login_info']); echo $split[0]; } ?>'>
Send message: <input type='text' name='msg' /><input type='submit' />
</form>
<script src="chat.js"></script>
</body>
</html>