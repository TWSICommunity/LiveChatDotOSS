var httpRequest = new XMLHttpRequest();
var dataRequest = new FormData();
var mainLinksrc = "http://yourdomain.com/"; //*Required* Put a slash at the end of your mainLinksrc.

function init() {
  console.log("Loading link pages.");
  httpRequest.open("GET", mainLinksrc+"linkLayout.php", true);
  httpRequest.onload = function() {
    document.getElementById("Links").innerHTML = this.responseText;
  }
  httpRequest.send();
  loadContent();
}

function loadContent() {
 console.log("Loading content page.");
 httpRequest.open("GET", mainLinksrc+"contentLayout.php", true);
 httpRequest.onload = function() {
  document.getElementById("bodypage").innerHTML = this.responseText;
 }
 httpRequest.send();
}