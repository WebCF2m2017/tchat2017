<?php
if(isset($_POST['clogin'])&&isset($_POST['cmdp'])){
    $login = htmlspecialchars(strip_tags(trim($_POST['clogin'])),ENT_QUOTES);
    $mdp = trim($_POST['cmdp']);
    
    
    if($login){
        
        $sql="SELECT u.idutil, u.login
            FROM util u 
            WHERE u.login = '$login' AND u.mdp = '$mdp';
            ";
        $recup_util = mysqli_query($db, $sql)or die(mysqli_error($db));
        
        if(mysqli_num_rows($recup_util)){
           
            $_SESSION = mysqli_fetch_assoc($recup_util);
             
            $_SESSION['clef_de_session']=session_id();
            
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
             <h2><a href=''>Retour à l'accueil du site</a></h2>
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
