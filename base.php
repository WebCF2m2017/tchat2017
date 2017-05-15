<!DOCTYPE html>
    <html>
    <head>
      <title></title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <meta charset="utf-8">
      <script src="js/ajax.js"></script>
    </head>
    <body>
    <!-- bordure du haut avec le nom des utilisateur connecté-->
    <div class="menu">
        <a href="?action=deco"><span class="button" title="deconnexion"><div class="back"><i class="fa fa-chevron-left"></i> <img src="https://api.adorable.io/avatars/40/<?= $_SESSION['mail']?>.png" draggable="false"/></div></a>
            <div class="name"><?= $_SESSION['username'] ?></div>
            <div class="last">18:09</div>
        </div>
    <!-- le contenue du tchat-->
    <ol class="chat">

    </ol>
    <!-- fin du contenue du tchat -->
    <!-- bouton d'envoie-->
    <form class="send">
        <input class="textarea" type="text" name="texte" placeholder="Type here!"/>
        <div class="emojis"></div>
        <div class="emoji-container">
            <div class="emoji-self">
                <img src="images/amazing.png" alt="amazing" title="amazing">
            </div>
            <div class="emoji-self">
                <img src="images/anger.png" alt="anger" title="anger">
            </div>
            <div class="emoji-self">
                <img src="images/exciting.png" alt="exciting" title="exciting">
            </div>
            <div class="emoji-self">
                <img src="images/money.png" alt="money" title="money">
            </div>
            <div class="emoji-self">
                <img src="images/super_man.png" alt="super_man" title="super_man">
            </div>
            <div class="emoji-self">
                <img src="images/what.png" alt="what" title="what">
            </div>
            <div class="emoji-self">
                <img src="images/unhappy.png" alt="unhappy" title="unhappy">
            </div>
            <div class="emoji-self">
                <img src="images/shame.png" alt="shame" title="shame">
            </div>
            <div class="emoji-self">
                <img src="images/shocked.png" alt="shocked" title="shocked">
            </div>
            <div class="emoji-self">
                <img src="images/scorn.png" alt="scorn" title="scorn">
            </div>
            <div class="emoji-self">
                <img src="images/haha.png" alt="haha" title="haha">
            </div>
            <div class="emoji-self">
                <img src="images/black_heart.png" alt="black_heart" title="black_heart">
            </div>
            <div class="emoji-self">
                <img src="images/nothing_to_say.png" alt="nothing_to_say" title="nothing_to_say">
            </div>
            <div class="emoji-self">
                <img src="images/horror.png" alt="horror" title="horror">
            </div>
            <div class="emoji-self">
                <img src="images/greedy.png" alt="greedy" title="greedy">
            </div>
            <div class="emoji-self">
                <img src="images/electric_shock.png" alt="electric_shock" title="electric_shock">
            </div>
        </div>
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        <input type="submit" class="submit" value="Envoyer">
    </form>
<script>
        setInterval(function(){VerifNbMsg()},<?=(AJAX_REFRESH*1000)?>);
    </script>
    </body>
    </html>