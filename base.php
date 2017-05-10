<!DOCTYPE html>
    <html>
    <head>
      <title></title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <meta charset="utf-8">
      <script src="js/ajax.min.js"></script>
    </head>
    <body onload="getLastsMessage()">
    <!-- bordure du haut avec le nom des utilisateur connecté-->
    <div class="menu">
        <a href="?action=deco"><div class="back"><i class="fa fa-chevron-left"></i> <img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div></a>
            <div class="name"><?= $_SESSION['username'] ?></div>
            <div class="last">18:09</div>
        </div>
    <!-- le contenue du tchat-->
    <ol class="chat">

    </ol>
    <!-- fin du contenue du tchat -->
    <!-- bouton d'envoie-->
    <form class="send" action="">
        <input class="textarea" type="text" name="texte" placeholder="Type here!"/><div class="emojis"></div>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <input class="submit" type="submit" value="Envoyer" onclick="event.preventDefault(); sendMessage(this.form);">
    </form>
    <script>
    setInterval(function(){VerifNbMsg()},<?=(AJAX_REFRESH*1000)?>);
    </script>
    </body>
    </html>