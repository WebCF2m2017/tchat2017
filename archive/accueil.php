<?php
// si cette page n'est pas appelée depuis le contrôleur fronteur ($_SERVER['PHP_SELF']ne contient pas index.php)redirection vers l'accueil !!! Protection contre l'évitement du contrôleur frontal
if(!strstr($_SERVER['PHP_SELF'],"index.php")){
    header("Location: ./");
}

/*/*
 *  calcul pour la pagination
 */
// nombre total d'article
$requete = mysqli_query($db, "SELECT COUNT(id) AS nb FROM message;");
$requete_assoc = mysqli_fetch_assoc($requete);
$nb_tot = $requete_assoc['nb'];
// calcul pour le premier argument du LIMIT
$limit = ($pg-1)*$nb_par_page;
// requête pour récupérer tous les articles suivant la pagination
$sql = "SELECT m.id, m.texte, m.ladate, u.login, u.mail 
    FROM message m
    INNER JOIN util u
        ON u.idutil = m.util_idutil
    ORDER BY m.ladate DESC
    LIMIT $limit, $nb_par_page    ;
    ";
$recup_sql = mysqli_query($db, $sql)or die(mysqli_error($db));

$pagination = maPagination($nb_tot, $pg,"pg",$nb_par_page);

if(isset($_POST['toto'])){
    $lulu = htmlspecialchars($_POST['toto'],ENT_QUOTES);
        $iquery_count = mysqli_query($db, "SELECT * FROM message WHERE `texte` LIKE '%$lulu%' ");
        $count = mysqli_num_rows($iquery_count);
        if($count){
            $resultat_search = mysqli_fetch_all($iquery_count, PDO::FETCH_ASSOC);
        }
    }
?>




<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Accueil</title>
    </head>
    <style type="text/css">
        body {
        background: #eee;
        font: 12px Lucida sans, Arial, Helvetica, sans-serif;
        color: #333;
        
}

a {
    color: #2A679F;
}
/*========*/

.form-wrapper {
    background-color: #f6f6f6;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#f6f6f6), to(#eae8e8));
    background-image: -webkit-linear-gradient(top, #f6f6f6, #eae8e8);
    background-image: -moz-linear-gradient(top, #f6f6f6, #eae8e8);
    background-image: -ms-linear-gradient(top, #f6f6f6, #eae8e8);
    background-image: -o-linear-gradient(top, #f6f6f6, #eae8e8);
    background-image: linear-gradient(top, #f6f6f6, #eae8e8);
    border-color: #dedede #bababa #aaa #bababa;
    border-style: solid;
    border-width: 1px;
    -webkit-border-radius: 10px;
    -moz-border-radius: 10px;
    border-radius: 10px;
    -webkit-box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
    -moz-box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
    box-shadow: 0 3px 3px rgba(255,255,255,.1), 0 3px 0 #bbb, 0 4px 0 #aaa, 0 5px 5px #444;
    overflow: hidden;
    width: 322px;

}

.form-wrapper #search {
    border: 1px solid #CCC;
    -webkit-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
    -moz-box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
    box-shadow: 0 1px 1px #ddd inset, 0 1px 0 #FFF;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
  color: #999;
    float: left;
    font: 16px Lucida Sans, Trebuchet MS, Tahoma, sans-serif;
    height: 20px;
    padding: 10px;
    width: 200px;
}

.form-wrapper #search:focus {
    border-color: #aaa;
    -webkit-box-shadow: 0 1px 1px #bbb inset;
    -moz-box-shadow: 0 1px 1px #bbb inset;
    box-shadow: 0 1px 1px #bbb inset;
    outline: 0;
}

.form-wrapper #search:-moz-placeholder,
.form-wrapper #search:-ms-input-placeholder,
.form-wrapper #search::-webkit-input-placeholder {
    color: #999;
    font-weight: normal;
}

.form-wrapper #submit {
    background-color: #0483a0;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#31b2c3), to(#0483a0));
    background-image: -webkit-linear-gradient(top, #31b2c3, #0483a0);
    background-image: -moz-linear-gradient(top, #31b2c3, #0483a0);
    background-image: -ms-linear-gradient(top, #31b2c3, #0483a0);
    background-image: -o-linear-gradient(top, #31b2c3, #0483a0);
    background-image: linear-gradient(top, #31b2c3, #0483a0);
    border: 1px solid #00748f;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
    -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
    box-shadow: 0 1px 0 rgba(255, 255, 255, 0.3) inset, 0 1px 0 #FFF;
    color: #fafafa;
    cursor: pointer;
    height: 42px;
    float: right;
    font: 15px Arial, Helvetica;
    padding: 0;
    text-transform: uppercase;
    text-shadow: 0 1px 0 rgba(0, 0 ,0, .3);
    width: 100px;
}

.form-wrapper #submit:hover,
.form-wrapper #submit:focus {
    background-color: #31b2c3;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#0483a0), to(#31b2c3));
    background-image: -webkit-linear-gradient(top, #0483a0, #31b2c3);
    background-image: -moz-linear-gradient(top, #0483a0, #31b2c3);
    background-image: -ms-linear-gradient(top, #0483a0, #31b2c3);
    background-image: -o-linear-gradient(top, #0483a0, #31b2c3);
    background-image: linear-gradient(top, #0483a0, #31b2c3);
}

.form-wrapper #submit:active {
    -webkit-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
    -moz-box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.5) inset;
    outline: 0;
}

.form-wrapper #submit::-moz-focus-inner {
    border: 0;
}
.h1{ float:left;
    width:60%;}
.formulaire{
    margin-left:70%
}    
    </style>
    <body>
    <div class="h1">
        <h1>Archive des messages :</h1>
    </div>
    <div class="formulaire">
        <form action='' class="form-wrapper" method='POST'>
                <input type="text" name='toto' id="search" placeholder="Recherche de..." required>
                <input type="submit" value="go" id="submit">
        </form>
    </div>
        <br /> <br /> <br />
        <?php
        if(isset($resultat_search)){
            echo "Nombre de page(s): $count";
            echo "<pre>";
            var_dump($resultat_search);
            echo "</pre>";
        }
        ?>
        <p align='center'><?=$pagination?></p>
        
        <div>
            <?php
            while ($ligne = mysqli_fetch_assoc($recup_sql)){
                ?>
            <p><?php echo $ligne['texte']?><a href="?idarticle=<?=$ligne['id']?>"></a></p>
            <h4><?=$ligne['ladate']?> - 
                <a href="mailto:<?=$ligne['mail']?>"><?=$ligne['login']?></a></h4>
            <hr/>
            <?php
            }
            ?>
            <p align='center'><?=$pagination?></p>
        </div>
    </body>
</html>
