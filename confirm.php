<?php

if(!strstr($_SERVER['PHP_SELF'],"index.php")){
    header("Location: ./");
}

$sql = "UPDATE util SET actif=1 WHERE idutil=$id AND clefutil='$clef' AND actif=0;
    ";
$recup_sql = mysqli_query($db, $sql)or die(mysqli_error($db));

if(mysqli_affected_rows($db)){
    header("Location: base.php ");
}else{
    echo "Pas Activé";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Activation de votre compte</title>
    </head>
    <body>
        <hr/>
        <div>
            
        </div>
    </body>
</html>
