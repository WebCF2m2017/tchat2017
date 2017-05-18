<?php


/*/*
 *  calcul pour la pagination
 */
// nombre total d'article
$requete = $db->db>prepare($db, "SELECT COUNT(id) AS nb FROM message;");
$requete->execute();


var_dump($requete); die();
