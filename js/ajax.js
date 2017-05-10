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

// Envoi du message dans la base de donnée

function sendMessage(data)
{
	var message = document.querySelector('input.textarea');
	var user_id = document.querySelector('input[name="user_id"]').value;
	var username = document.querySelector('div.name').innerHTML;

	event.preventDefault();

	data = "texte=" + message.value + "&user_id=" + user_id + "&username=" + username;

	console.log(data);

	var xhr = creerXHR();
	var url = "ajaxCall.php";
	
	
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4 && xhr.status == 200) {
        	if (xhr.responseText == 'ok')
        	{
        		document.querySelector('ol').innerHTML = "";
        		message.value = "";
				getLastsMessage();
        	}
    	}
		
	}
	xhr.send(data);
		
}

// Cherche les deniers messages

function getLastsMessage()
{

	var xhr = creerXHR();
	var url = "ajaxCall.php?getLastsMessage";

	xhr.open("GET", url, true);
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			var data = JSON.parse(xhr.responseText);
			for (var i = 0; i < Object.keys(data).length; i++) {
				if (i == 0)
					pushLastMessage(data[i].texte, data[i].login, data[i].ladate, true);
				else
					pushLastMessage(data[i].texte, data[i].login, data[i].ladate, false);
			}
		}

	}

	xhr.send();

}

// Insere le message

function pushLastMessage(message, username, date, erase)
{
	if (erase === undefined)
		erase = false;


	messageBox = document.querySelector('ol');
	var save = messageBox.innerHTML
	
		messageBox.innerHTML = ""

		messageBox.innerHTML += "<li class='other'>" + 
		"<div class='avatar'><img src='http://i.imgur.com/DY6gND0.png' draggable='false'/></div></div>" + 
		"<div class='msg'>" +
		"<p id='colorenvoie'>" + username + "</p>" +
		"<p>" + message + "</p>" +
		"<time>" + date + "</time>" + 
		"</div>" +
		"</li>";

		messageBox.innerHTML += save;
		window.scrollTo(0,document.body.scrollHeight + 100);
}

// fonction qui vérifie si on doit mettre à jour le 'ol'
function VerifNbMsg(){
    var xhr = creerXHR();
	var url = "ajaxCount.php";

	xhr.open("GET", url, true);
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			if(xhr.responseText=="charge"){
                            getLastsMessage();
                        }
			
		}

	}

	xhr.send();
}