var http = new XMLHttpRequest();
var data = new FormData();
var hasSet_timer = false;

function livechat_reload(id=1) {
	http.open("GET", "getlogs.php?id="+id, true);
	http.onload = function() {
		document.getElementById("chatlog").innerHTML = this.responseText;
	}
	http.send();
	if(hasSet_timer == false) {		
		setInterval(function() { livechat_reload(id); }, 1000);
		hasSet_timer = true;
	} else {
		return;
	}
}