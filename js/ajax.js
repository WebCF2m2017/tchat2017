/* 
 * Gestion de l'AJAX de nos pages
 */


// création de l'objet XHR multi-navigateur
function creerXHR() {
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		return null;
	}
	
	return xhr;
}



// Envoi du message dans la DB

function sendRegister(data)
{
	var username = data.querySelector('input#username');
	var password = data.querySelector('input#password');
	var mail = data.querySelector('input#mail');
	var submit = data.querySelector('input#submit');



	data = "username=" + username.value + "&password=" + password.value + "&mail=" + mail.value;

	var xhr = creerXHR();
	var url = "utils.php";

	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onload = function() { console.log(xhr.responseText); }
	xhr.send(data);
}

function sendMessage(data)
{
	var message = document.querySelector('input.textarea');
	var user_id = document.querySelector('input[name="user_id"]').value;
	var username = document.querySelector('div.name').innerHTML;

	data = "texte=" + message.value + "&user_id=" + user_id + "&username=" + username;

	console.log(data);

	var xhr = creerXHR();
	var url = "ajaxCall.php";
	
	
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4 && xhr.status == 200) {
        	console.log(xhr.responseText); 
			pushLastMessage(message.value, username); message.value = "";
    	}
		
	}
	xhr.send(data);
		
}

function getLastsMessage()
{

	var messageInput = data.querySelector('.textarea');
	var xhr = creerXHR();
	var url = "utils.php?lastsMessage";

	xhr.open("GET", url, true);
	xhr.onload = function() { console.log(xhr.responseText); }
	xhr.send();

}

function pushLastMessage(message, username)
{
	messageBox = document.querySelector('ol');
	messageBox.innerHTML += 
	"<li class='other'>" + 
	"<div class='avatar'><img src='http://i.imgur.com/DY6gND0.png' draggable='false'/></div></div>" + 
	"<div class='msg'>" +
	"<p id='colorenvoie'>" + username + "</p>" +
	"<p>" + message + "</p>" +
	"<time>20:17</time>" + 
	"</div>" +
	"</li>";
	var limit = document.body.offsetHeight - window.innerHeight;
	document.body.scrollTop = limit + 100;

}