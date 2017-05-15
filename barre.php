<?php

$query = mysql_query("SELECT * FROM message WHERE message LIKE '%$recherche%' ORDER BY message")
 or die (mysql_error());
$verif = mysql_num_rows($query);
if($verif != 0)
{

  if(isset($_POST['requete']) && $_POST['requete'] != NULL) // on vérifie d'abord l'existence du POST et aussi si la requete n'est pas vide.
  {
  mysql_connect('localhost','root','');
  mysql_select_db('bdd'); // on se connecte à MySQL. Je vous laisse remplacer les différentes informations pour adapter ce code à votre site.
  $requete = htmlspecialchars($_POST['requete']); // on crée une variable $requete pour faciliter l'écriture de la requête SQL, mais aussi pour empêcher les éventuels malins qui utiliseraient du PHP ou du JS, avec la fonction htmlspecialchars().
  $query = mysql_query("SELECT * FROM fonctions WHERE nom_fonction LIKE '%$requete%' ORDER BY id DESC") or die (mysql_error()); // la requête, que vous devez maintenant comprendre ;)
  $nb_resultats = mysql_num_rows($query); // on utilise la fonction mysql_num_rows pour compter les résultats pour vérifier par après
  if($nb_resultats != 0) // si le nombre de résultats est supérieur à 0, on continue
  {
  // maintenant, on va afficher les résultats et la page qui les donne ainsi que leur nombre, avec un peu de code HTML pour faciliter la tâche.
  ?>
  <h3>Résultats de votre recherche.</h3>
  <p>Nous avons trouvé <? echo $nb_resultats; // on affiche le nombre de résultats
  if($nb_resultats > 1) { echo 'résultats'; } else { echo 'résultat'; } // on vérifie le nombre de résultats pour orthographier correctement.
  ?>
  dans notre base de données. Voici les fonctions que nous avons trouvées :<br/>
  <br/>
  <?
  while($donnees = mysql_fetch_array($query)) // on fait un while pour afficher la liste des fonctions trouvées, ainsi que l'id qui permettra de faire le lien vers la page de la fonction
  {
  ?>
  <a href="fonction.php?id=<? echo $donnees['id']; ?>"><? echo $donnees['nom_fonction']; ?></a><br/>
  <?
  } // fin de la boucle
  ?><br/>
  <br/>
  <a href="rechercher.php">Faire une nouvelle recherche</a></p>
  <?
  } // Fini d'afficher les résultats ! Maintenant, nous allons afficher l'éventuelle erreur en cas d'échec de recherche et le formulaire.
  else
  { // de nouveau, un peu de HTML
  ?>
  <h3>Pas de résultats</h3>
  <p>Nous n'avons trouvé aucun résultat pour votre requête "<? echo $_POST['requete']; ?>". <a href="rechercher.php">Réessayez</a> avec autre chose.</p>
  <?
  }// Fini d'afficher l'erreur ^^
  mysql_close(); // on ferme mysql, on n'en a plus besoin
  }
  else
  { // et voilà le formulaire, en HTML de nouveau !
  ?>
  <p>Vous allez faire une recherche dans notre base de données concernant les fonctions PHP. Tapez une requête pour réaliser une recherche.</p>
   <form action="rechercher.php" method="Post">
  <input type="text" name="requete" size="10">
  <input type="submit" value="Ok">
  </form>
  <?
  }
  // et voilà, c'est fini !
  ?>



?>
