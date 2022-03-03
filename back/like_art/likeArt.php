<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : likeArt.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likeart
require_once __DIR__ . '/../../class_crud/likeArt.class.php';

// Instanciation de la classe Likeart
$monLikeArt = new LIKEART();

// Insertion classe Membre
require_once __DIR__ . '/../../class_crud/membre.class.php';

// Instanciation de la classe Membre
$monMembre = new MEMBRE();

// Insertion classe Article
require_once __DIR__ . '/../../class_crud/article.class.php';

// Instanciation de la classe Article
$monArticle = new ARTICLE();

?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like sur Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
        .OK {
            padding: 2px;
            border: solid 0px black;
            color: deeppink;
            font-style: italic;
            border-radius: 5px;
        }
        .KO {
            padding: 2px;
            border: solid 0px black;
            color: darkgoldenrod;
            font-style: italic;
            border-radius: 5px;
        }
</style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Like sur Article</h1>

    <hr />
    <h2>Nouveau like sur article :&nbsp;<a href="./createLikeArt.php"><i>Créer un like</i></a></h2>
    <hr />
    <h2>Tous les likes par membre et par article</h2>

    <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Membre&nbsp;</th>
            <th>&nbsp;Article&nbsp;</th>
            <th>&nbsp;Statut&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel des méthodes : Get tous les users en BDD
    $allLikesArt = $monLikeArt->get_AllLikesArt();
    foreach($allLikesArt as $row) {
    // Boucle pour afficher
?>
        <tr>
        <td><h4>&nbsp; <?php echo $row["pseudoMemb"]; ?> &nbsp;</h4></td>

        <td>&nbsp; <?php echo $row["libTitrArt"]; ?> &nbsp;</td>

        <td>&nbsp;<span class="OK">&nbsp; <?php echo ($row["likeA"] == 1) ? "Like" : "Unlike" ?> &nbsp;</span></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateLikeArt.php?id1=<?php echo $row["numMemb"]; ?>&id2=<?php echo $row['numArt']?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier like article" title="Modifier like article" /></i></a><br>&nbsp;&nbsp;<span class="error">(Un)like</span>&nbsp;
        <br /></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteLikeArt.php?id1=<?php echo $row["numMemb"]; ?>&id2=<?php echo $row['numArt']?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer like article" title="Supprimer like article" /></i></a><br>&nbsp;&nbsp;<span class="error">(S/Admin)</span>&nbsp;
        <br /></td>
        </tr>
<?php
     }   // End of foreach
?>
    </tbody>
    </table>

    <p>&nbsp;</p>
<?php
require_once ROOT . '/footer.php';
?>
</body>
</html>
