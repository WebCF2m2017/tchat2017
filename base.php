<!DOCTYPE html>
    <html>
    <head>
      <title></title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <meta charset="utf-8">
    </head>
    <body>
    <!-- bordure du haut avec le nom des utilisateur connecté-->
    <div class="menu">
            <div class="back"><i class="fa fa-chevron-left"></i> <img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
            <div class="name">Houssain</div>
            <div class="last">18:09</div>
        </div>
    <!-- le contenue du tchat-->
    <ol class="chat">
<!-- div du message envoyé -->
    <li class="other">
        <div class="avatar"><img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
      
      <div class="msg">
        <p id="colorenvoie">Houssain : </p>
        <p>Fayn!</p>
        <p>trkl ou quoi ?  <emoji class="pizza"/></p>
        <time>20:17</time>
      </div>
    </li>
<!-- div du message de réponse -->
    <li class="self">
        <div class="avatar"><img src="http://i.imgur.com/HYcn9xO.png" draggable="false"/></div>
      <div class="msg">
        <p id="colorreceveur">Yassine : </p>
        <p>Yo</p>
        <p>A FOU  tu te souviens de vendredi ?? <emoji class="books"/></p>
        <p>quand on étais en classe ? </p>
        <time>20:18</time>
      </div>
    </li>
    <!-- div du message envoyé -->
    <li class="other">
        <div class="avatar"><img src="http://i.imgur.com/DY6gND0.png" draggable="false"/></div>
      
      <div class="msg">
        <p id="colorenvoie">Houssain : </p>
        <p>Hahahahahaha</p>
        <p>Ouais truc de fou !<emoji class="pizza"/></p>
        <time>20:17</time>
      </div>
    </li>
    
    </ol>
    <!-- fin du contenue du tchat -->
    <!-- bouton d'envoie-->
    <input class="textarea" type="text" placeholder="Type here!"/><div class="emojis"></div>
    </body>
    </html>