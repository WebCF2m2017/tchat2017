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


window.addEventListener("load", init);

function init()
{
	// Initialisation des variables
	containerOpen = false;
	message = document.querySelector('input.textarea');
	user_id = document.querySelector('input[name="user_id"]').value;
	username = document.querySelector('div.name').innerHTML;
	chat = document.querySelector('ol');
	form = document.querySelector('form');
	emojis = document.querySelector('div.emojis');
	emoji = document.querySelectorAll('div.emoji-self')

	// Event déclenché au click sur l'icone emoji (ouvre le panneau avec tous les emojis)
	emojis.addEventListener('click', function(){ switchEmojiContainer() });
	// Event déclenché au click sur l'input du message (ferme le panneau des emojis si ouvert)
	message.addEventListener('click', function(){
		if (containerOpen)
			switchEmojiContainer()
	});

	// Boucle qui crée un evenement sur chaque div.emoji-self
	for (var i = 0; i < emoji.length; i++) {
		emoji[i].addEventListener('click', function(){ addEmoji(this) })
	}


	// Event déclenché quand le formulaire est envoyé
	form.addEventListener('submit', function(event) { event.preventDefault(); sendMessage(this) });

	// Initialisation des messages
	getLastsMessage();
}


// Envoi du message dans la base de donnée

function sendMessage(data)
{

	// Si le message contient moins de 1 caractère on affiche un alert et on annule la fonction
	if (message.value.length < 1)
	{
		alert('Votre message est vide!');
		return false;
	}

	// Si le message contient plus de 500 caractère on affiche un alert et on annule la fonction
	// Dans la base de donnée message, texte est un varchar(500) 
	if(message.value.length >= 501)
	{
		alert('Votre message ne peut contenir plus de 500 caractères');
		return false;
	}


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
        	}else{
                    message.value = "";
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
	// Ajout des balises HTML dans le DOM
	chat.innerHTML += "<li class='other'>" + 
	"<div class='avatar'><img src='images/avatar.png' draggable='false'/></div></div>" + 
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

// Fonction qui ouvre/ferme la boite d'emoji
function switchEmojiContainer()
{
	var emojiContainer = document.querySelector('.emoji-container');

	if (!containerOpen)
	{
		containerOpen = true;
		emojiContainer.style.display = "block";
	}
	else
	{
		containerOpen = false;
		emojiContainer.style.display = "none";
	}
}

// Fonction qui ajoute l'emoji dans le message
function addEmoji(data)
{
	switchEmojiContainer();
	// La variable data renvoi la div qui a la classe emoji-self, on parcour son enfant(la balise IMG)
	message.value += ' :' + data.children[0].alt + ': ';
	message.focus();
}