/* 
 * Gestion de l'AJAX de nos pages
 */


// Création de l'objet XHR multi-navigateur
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
	// Selection des elements HTML
	var message = document.querySelector('input.textarea');
	var user_id = document.querySelector('input[name="user_id"]').value;
	var username = document.querySelector('div.name').innerHTML;
	var chat = document.querySelector('ol');



	// Création des données POST à envoyer
	data = "texte=" + message.value + "&user_id=" + user_id + "&username=" + username;

	var xhr = creerXHR();
	var url = "ajaxCall.php";
	
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function() 
	{ 
		if(xhr.readyState == 4 && xhr.status == 200) 
		{
        	if (xhr.responseText == 'ok')
        	{
        		// Effacement de tous les elements du chat, du contenu du textarea
        		chat.innerHTML = "";
        		message.value = "";
        		// Appel de la fonction getLastsMessage
				getLastsMessage();
        	}
    	}
		
	}
	xhr.send(data);	
}

// Cherche les deniers messages

function getLastsMessage()
{
	var chat = document.querySelector('ol');
	var xhr = creerXHR();
	var url = "ajaxCall.php?getLastsMessage";

	xhr.open("GET", url, true);
	xhr.onreadystatechange = function() { 
		if(xhr.readyState == 4 && xhr.status == 200)
		{
            chat.innerHTML = "";
			var data = JSON.parse(xhr.responseText);
			// Récéption des derniers méssage encodé en JSON
			// On boucle chaque message pour l'envoyer a la fonction pushLastMessage
			for (var i = (Object.keys(data).length-1); i >= 0; i--) {
				pushLastMessage(data[i].texte, data[i].login, data[i].ladate);
			}
		}
	}
	xhr.send();
}

// Insertion du message

function pushLastMessage(message, username, date)
{
	chat = document.querySelector('ol');
	
	// Ajout des balises HTML dans le DOM
	chat.innerHTML += "<li class='other'>" + 
	"<div class='avatar'><img src='http://i.imgur.com/DY6gND0.png' draggable='false'/></div></div>" + 
	"<div class='msg'>" +
	"<p id='colorenvoie'>" + username + "</p>" +
	"<p>" + message + "</p>" +
	"<time>" + date + "</time>" + 
	"</div>" +
	"</li>";

	// Scroll de la page vers le bas
	window.scrollTo(0,document.body.scrollHeight + 100);
}

// Fonction qui vérifie si on doit mettre à jour le 'ol'
function VerifNbMsg()
{
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