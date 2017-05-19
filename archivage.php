<?php
require_once 'config.php';

$db = mysqli_connect(DB_HOST,DB_LOGIN,DB_PASS,DB_NAME)
OR die("Echec de la connexion: ".utf8_encode(mysqli_connect_error())."<br/>Num&eacute;ro d'erreur".
utf8_encode(mysqli_connect_errno()));

mysqli_set_charset($db,DB_CHARSET);

$sql= "SELECT m.texte,m.ladate , u.login , u.mail
FROM message m
inner JOIN util u
ON m.util_idutil= u.idutil
 ORDER BY m.ladate DESC;";

$recup_all=mysqli_query($db,$sql);


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">

    </head>
    <body>

      <?php
      while ($recup= mysqli_fetch_assoc($recup_all)) {

      ?>
      <p><?=$recup['login']?></p>

      <p><?=$recup['mail']?></p>

      <p><?=$recup['texte']?></p>

      <?=$recup['ladate']?></p>
      <?php
    }
    ?>
    </body>

</html>
