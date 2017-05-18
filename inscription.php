<!-- <?php

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
-->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Bitter|Lobster" rel="stylesheet">
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <style type="text/css">

            body{
              background-color: #263248;
            }
            
            #inscriptionf{
               height: 1080px;
                
                background-image: url("images/inscription.jpg");
                background-size:100%;
                height: 140px;
                display:block;
                padding:0 !important;
                margin:0;
                
            }
            .borderless table {
                border-top-style: none;
                border-left-style: none;
                border-right-style: none;
                border-bottom-style: none;
            }
            .kappa{
              position: fixed;
              bottom: 10%;
            }
            .hehe{
              background-color:#F8981D ;
            }
            p{
              color:#263248;
              font-size: 1.2em;
            }
            .huhu{
              color:#263248;
            }
            .col-md-offset-4{
              margin-top:-4%;
            }



        </style>
    </head>
    <body>
    
    
    <div class="container">
    <div id="inscriptionf">
   
    <div class="kappa">
            <?php
            if(isset($mail_confimation)){
            ?>
        <div class="container">
         <div class="row">
               <table class="table table borderless ">
             <tr><td>
                   <div class="btn-group btn-group-justified">
                      <a href="./" class="btn btn-blue boutonn"><i class="fa fa-home boutonn huhu" aria-hidden="true"></i><br /><p><h3>Vérifiez votre mail,<br/> vous allez recevoir un mail<br/> de confirmation!!!</h3>
               </p></a>
                   </div>
             </td></tr>
               </table>
           </div>
          </div>
         </div>
            <?php
            }else{
            ?>
       <div class="container">
         <div class="row">
         <div class="col-md-4 col-md-offset-4  hehe">
          
          <table class="table table borderless ">
            <tr><td>
                  <div class="btn-group btn-group-justified hehe">
                  <a href="./" class="btn btn-blue boutonn hehe"><i class="fa fa-home boutonn huhu" aria-hidden="true"></i><br /><p>Home</p></a>
            </div>
            </td></tr>
          </table>
          </div>
        </div>
      </div>
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4  hehe">
 <table class="table table borderless ">
          <form action="" method="POST" name="inscription" class="form-inline">
            <div class="form-group hehe ">
              <tr><td>
              <label for="login">Login:</label>
              </td><td>
              <input type="text" name='lelogin' class="form-control" placeholder="Votre login" <?php if(isset($_POST['lelogin'])) echo " value='{$_POST['lelogin']}' " ?> required />
               <?php if(isset($erreur_login)) echo $erreur_login ?>
              </td></tr>
            </div>
  <br/>
     <div class="form-group hehe">
               <tr><td>
         <label for="pwd">Password:</label>
               </td><td>
    <input type="password" class="form-control" id="pwd" name='lepass_a' placeholder="Votre mot de passe" required /><?php if(isset($erreur_mdp)) echo $erreur_mdp ?>
    <br/>
                </td></tr>
  </div>
  <br/>

  <div class="form-group hehe">
  <tr><td>
    <label for="email">Confirm password:</label>
  </td><td>
    <input type="password" class="form-control" id="pwd" name='lepass_b' placeholder="Confirmez votre mot de passe" required />
  </td></tr>
  </div>

<br/>

          <div class="form-group hehe">
            <tr><td>
        <label for="email">Email:</label>
            </td><td>
        <input type="email" name='lemail' class="form-control" <?php if(isset($_POST['lemail'])) echo " value='{$_POST['lemail']}' " ?> placeholder="Votre adresse mail" required /><?php if(isset($erreur_mail)) echo $erreur_mail ?>
<br/>
            </td></tr>
  </table>
          </div>
<br/>
  <div class="container">
   <div class="row">
    <div class="col-md-4 col-md-offset-4  hehe">
        <table class="table table borderless ">
          <div class="form-group hehe">
            <div class="checkbox">
                           <tr><td>
               <div class="btn-group btn-group-justified">
                      <a onclick="document.forms[0].submit();return false;" target="_blank" class="btn btn-blue boutonn"><i class="fa fa-sign-in huhu" aria-hidden="true"></i><br /><p>Sign-Up!</p></a>
               </div>
                          </td></tr>
            </div>
          </div>

</form>
        </table>
            <?php
            }
            ?>

    </div>
  </div>
</div>
</div>
</div>
        
    </body>
</html>
