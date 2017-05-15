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
        <meta charset="utf-8">
      <!--  <title>Se Connecter</title>-->
         
        <link rel="stylesheet" type="text/css" href="css/style.css">
       
    </head>
  
   <body>
    

       <div id="container">  
           <form action="" method="POST" name="connection">
               <div id="lo">
                Login:<br>
               <input type="text" name="clogin">
               <br>
               Mot de pase:<br>
               <input type="password" name="cmdp">
               </div>
          
           <div id="lili">
           
               <button class="bobo" type="submit">Se connecter</button><br/>
           <br/>
           <a href="?inscription"><button class="bobo">S'inscrire</button></a>
           
       </div>
       </form>
   
       <?php
             if(isset($dit)) echo "<h2>$dit</h2>";
       ?>

        <?php
        if(isset($erreur)){ echo "<h3 >$erreur</h3>";}
        ?>

      </div>

            
    </body>
</html>
