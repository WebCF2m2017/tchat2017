<?php

if(!strstr($_SERVER['PHP_SELF'],"index.php")){
    header("Location: ./");
}

if(isset($_POST['lelogin'])){
    
        if($_POST['lepass_a']!=$_POST['lepass_b']){
            $erreur_mdp = "! Vos mots de passes ne sont pas concordants !";
        }else{
            $lelogin = htmlspecialchars(strip_tags(trim($_POST['lelogin'])),ENT_QUOTES);
            $lemdp = trim($_POST['lepass_a']);
            $lemdp = sha256($lemdp);
            $lemail = filter_var(trim($_POST['lemail']), FILTER_VALIDATE_EMAIL);
            
            if(!$lelogin||!$lemail|| $lemdp=='e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855'){
                
                header("Location: http://how.icryeverytime.com");
                exit();
            }else{
                
                
                // création de la clef
                $clef = clef_u($lelogin);
                
                // on va créer une requête préparée en utilisant les ? pour chaques variables que l'on veut traiter
                $insert = $db->db->prepare("INSERT INTO util (login,mdp,mail,clefutil,actif) VALUES (?,?,?,?,0);");
                // on rajoute chaque variable à la requête
                $insert->bindValue(1,$lelogin,PDO::PARAM_STR);
                $insert->bindValue(2,$lemdp,PDO::PARAM_STR);
                $insert->bindValue(3,$lemail,PDO::PARAM_STR);
                $insert->bindValue(4,$clef,PDO::PARAM_STR);
                
                
                // on exécute la requête
                $verif = $insert->execute();
               
                
                if(!$verif){
                   
                    if($insert->errorInfo()[1]==1062){
                        

                            $erreur_login = "<span style='color:red'>$lelogin est déjà utilisé !!!</span>";
                        
                        
                    }else{
                        die("Erreur inconnue lors de l'insertion");
                    }
                
                }else{
                    
                    $lastid = $db->db->lastInsertId();
                    
                    $mail_confimation = valide_compte($lemail,$lelogin,$lastid,$clef);
                }
            }
        }
} 
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        
         <link rel="stylesheet" type="text/css" href="css/style.css">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter|Lobster" rel="stylesheet">
    </head>
    <body>
        <hr/>
        <div class="formulair">
            <h1>Inscription</h1>
            <?php
            if(isset($mail_confimation)){
            ?>
            <h3>Vérifiez votre mail, vous allez recevoir un mail de confirmation!!!</h3>
            <a href="./"><button>Retour a l'accueil</button></a>
            <?php
            }else{
            ?>
            <a href="./"><button>Retour a l'accueil</button></a>
            <form action="" method="POST" name="inscription">
                <section class="put">                 
                <input type="text" name='lelogin' placeholder="Votre login" <?php if(isset($_POST['lelogin'])) echo " value='{$_POST['lelogin']}' " ?> required />
               <?php if(isset($erreur_login)) echo $erreur_login ?>
                <br/>
                <input type="password" name='lepass_a' placeholder="Votre mot de passe" required /><?php if(isset($erreur_mdp)) echo $erreur_mdp ?><br/>
                <input type="password" name='lepass_b' placeholder="Confirmez votre mot de passe" required /><br/>
                <input type="email" name='lemail' <?php if(isset($_POST['lemail'])) echo " value='{$_POST['lemail']}' " ?> placeholder="Votre adresse mail" required /><?php if(isset($erreur_mail)) echo $erreur_mail ?><br/>
                
                <input type="submit" value="S'inscrire" />
                </section> 
            </form>
            <?php
            }
            ?>
        </div>
    </body>
</html>
