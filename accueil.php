<?php

if(isset($_POST['clogin'])&&isset($_POST['cmdp'])){
    $login = htmlspecialchars(strip_tags(trim($_POST['clogin'])),ENT_QUOTES);
    $mdp = sha256(trim($_POST['cmdp']));
    
    
    if($login){
         
        $recup_util = $db->query("SELECT u.idutil, u.login FROM util u WHERE u.login ='$login' AND u.mdp ='$mdp'");

        if(!empty($recup_util)){
           
             
            $_SESSION['clef_de_session']= session_id();
            $_SESSION['username'] = $recup_util[0]['login'];
            $_SESSION['user_id'] = $recup_util[0]['idutil'];

            
            header("Location: ./");
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
        <meta charset="utf-8">
      <!--  <title>Se Connecter</title>-->
         
        <link rel="stylesheet" type="text/css" href="css/style.css">
       <!-- <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter|Lobster" rel="stylesheet">-->
       <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
    </head>
  
   <body>
    
       <div id="lo">  
           <form action="#">
                Login:<br>
               <input type="text" name="clogin">
               <br>
               Mot de pase:<br>
              <input type="text" name="cmdp">
          </form>   
      </div>
       
      <div id="formulaire1">
		 <p><button class="w3-button w3-red"><a href="?accueil.php">Se connecter</a></button></p>
		 <p><button class="w3-button w3-brown"><a href="?inscription.php">S'inscrire</a></button></p>
      </div>    
       <?php
             if(isset($dit)) echo "<h2>$dit</h2>";
       ?>

        <?php
        if(isset($erreur)){ echo "<h3 >$erreur</h3>";}
        ?>
            
    </body>
</html>
