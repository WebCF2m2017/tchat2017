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
         <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>

         <style type="text/css">

            body{
              background-color: #263248;
            }
            
            #container{
                height: 1080px;
                background-image: url("images/background.jpg");
                background-size:100%;
                display:block;
                padding:0 !important;
                background-repeat: no-repeat;
                margin:0;
                
            }
            .kappa{
              position: fixed;
              padding-top: 45%;
            }
            .borderless table {
                border-top-style: none;
                border-left-style: none;
                border-right-style: none;
                border-bottom-style: none;
            }

            .hehe{
              display: block;
              background-color:#F8981D ;
            }
            p{
              color:#263248;
              font-size: 1.2em;
            }
            .huhu{
              color:#263248;
            }
            td, tr{
              width: 50%;
            }




        </style>


    </head> 
  
   <body>
      <div id="container">
       <div class="kappa"> 
       <div class="row">
          <div class="col-md-4 col-md-offset-4 col-sm-4 col-sm-offset-4 col-xs-4 col-xs-offset-4 hehe">
         
          <table class="table table borderless ">
           <form action="" method="POST" name="connection" class="form-inline">
           <div class="form-group hehe">
           
               <tr><td>
              <label for="login">Login:</label>
               <br />

               <input type="text" class="form-control" name="clogin">
                </td><td>
               <div class="btn-group btn-group-justified">
               <a onclick="document.forms[0].submit();return false;" target="_blank" class="btn btn-blue boutonn sizer"><i class="fa fa-sign-in huhu" aria-hidden="true"></i><br /><p>Login!</p></a>
               </div>
               </td></tr>

               <tr><td>
                
               <label for="pwd">Password:</label>
                <br />
               <input type="password" class="form-control" name="cmdp">
                </td><td>
              <div class="btn-group btn-group-justified">
              <a href="?inscription" class="btn btn-blue boutonn"><i class="fa fa-home boutonn huhu sizer" aria-hidden="true"></i><br /><p>Sign-Up!</p></a>
             </div>
                </td></tr>


       </form>
    </div>
       <?php
             if(isset($dit)) echo "<h2>$dit</h2>";
       ?>

        <?php
        if(isset($erreur)){ echo "<h3 >$erreur</h3>";}
        ?>
        </div>
      </div>
    </div>
    </div>
            
    </body>
</html>
