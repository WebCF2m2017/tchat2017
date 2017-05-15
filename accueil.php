<?php

if(isset($_POST['clogin'])&&isset($_POST['cmdp'])){
    $login = htmlspecialchars(strip_tags(trim($_POST['clogin'])),ENT_QUOTES);
    $mdp = sha256(trim($_POST['cmdp']));
    
    
    if($login){
         
        $recup_util = $db->query("SELECT u.idutil, u.login, u.actif, u.mail FROM util u WHERE u.login ='$login' AND u.mdp ='$mdp'");

        if(!empty($recup_util)){
           // si l'utilisateur existe mais est inactif
            if($recup_util[0]['actif']==0){
                $erreur = "Vous n'avez pas encore activé votre compte";
            }else{ 
            $_SESSION['clef_de_session']= session_id();
            $_SESSION['username'] = $recup_util[0]['login'];
            $_SESSION['user_id'] = $recup_util[0]['idutil'];
            $_SESSION['mail'] = $recup_util[0]['mail'];

            
            header("Location: ./");
            }
        }else{ 
            $erreur = "Login et/ou mot de passe incorrecte(s)!";
        }
    }else{
        header("Location: disconnect.php");
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Se Connecter</title>

        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter|Lobster" rel="stylesheet">
        	<script>
			function init() {
				document.getElementById('title').onmouseover = miseEnGras;
				document.getElementById('title').onmouseout = normal;
			}

			function miseEnGras(event){ 
				this.style.fontWeight="bold";
				this.style.color="black"; 
				}

			function normal(event){ 
				this.style.fontWeight="normal";
				this.style.color="red";
				}			
		</script>
    </head>
    <body onload="init();">
        <section id="slid">
        <div id="title">
             <h1>Se Connecter</h1> </div>
        <div id="galeriep">
             <h2><a href="?inscription">Inscription</a></h2>
             <?php
             if(isset($dit)) echo "<h2>$dit</h2>";
             ?>
        </div>
    <form action="" method="POST" name="connection">
    <ul class="form-style-1">
    <li>
        <label>Username <span class="required">*</span></label>
        <input type="text" name="clogin" class="field-long" placeholder=""/>
    </li>
    <li>
        <label>PassWord <span class="required">*</span></label>
        <input type="password" name="cmdp" class="field-long-pass"/>
    </li>
    <li>
        <input type="submit" value="Se connecter" />
    </li>
    </ul>
    </form>

        <?php
        if(isset($erreur)){ echo "<h3 >$erreur</h3>";}
        ?>
            </section>
    </body>
</html>
