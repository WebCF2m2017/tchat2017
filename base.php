<?php
/*if(!strstr($_SERVER['PHP_SELF'],"index.php")){
    header("Location: ./");
}*/

// requête pour récupérer les messages des utilisateurs.
$sql = "SELECT u.idutil, u.login, m.ladate, m.texte, m.titre 
    FROM util u 
    INNER JOIN message m
        ON u.idutil = m.util_idutil
   ";
$recup_sql = mysqli_query($db, $sql)or die(mysqli_error($db));
/*if(!mysqli_num_rows($recup_sql)){
    $erreur = "Article introuvable!";
}else{*/
     $ligne = mysqli_fetch_assoc($recup_sql);
/*}*/
?>
<!DOCTYPE html>
    <html>
    <head>
      <title></title>
      <link rel="stylesheet" type="text/css" href="style.css">
      <meta charset="utf-8">
    </head>
    <body>
    <!-- bordure du haut avec le nom des utilisateur connecté-->
    <div class="menu">
            <?php
           
            if ($_SESSION['idutil'] == $ligne['idutil']) {
                       $a = 'other';
            }else{
                           $a='self';
                       }
            ?>
    <div class="back"><i class="fa fa-chevron-left"></i> <img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
            <div class="name"><?=$ligne['idutil']?></div>
            <div class="last"><?=$ligne['ladate']?></div>
        </div>
    <!-- le contenue du tchat-->
    <ol class="chat">
<!-- div du message envoyé -->
    <li class="other">
        <div class="avatar"><img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
      
      <div class="msg">
        <p id="colorenvoie"><?=$ligne['idutil']?> :</p>
        <p><?=$ligne['titre']?></p>
        <p><?=$ligne['texte']?></p>
        <time><?=$ligne['ladate']?></time>
      </div>
    </li>
<!-- div du message de réponse -->
    <li class="self">
        <div class="avatar"><img src="http://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
      <div class="msg">
        <p id="colorreceveur"><?=$ligne['idutil']?> :</p>
        <p><?=$ligne['titre']?></p>
        <p><?=$ligne['texte']?></p>
        <time><?=$ligne['ladate']?></time>
      </div>
    </li>
    <!-- div du message envoyé -->
    
    </ol>
    <!-- fin du contenue tu tchat -->
    <!-- bouton d'envoie-->
    <input class="textarea" type="text" placeholder="Type here!"/><div class="emojis"></div>
    <?php  ?>
    </body>
    </html>