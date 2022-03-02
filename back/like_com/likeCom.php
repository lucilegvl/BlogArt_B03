<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : likeCom.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likecom

// Instanciation de la classe Likecom



?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like sur Commentaire</title>
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
    <h1>BLOGART22 Admin - CRUD Like sur Commentaire</h1>

    <hr />
    <h2>Nouveau like sur Commentaire :&nbsp;<a href="./createLikeCom.php"><i>Créer un like</i></a></h2>
    <hr />
    <h2>Tous les likes par membre, par commentaire et par article</h2>

    <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Membre&nbsp;</th>
            <th>&nbsp;Article&nbsp;</th>
            <th>&nbsp;Commentaire&nbsp;</th>
            <th>&nbsp;Statut&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Appel méthode : Get tous les users en BDD

    // Boucle pour afficher
    //foreach($all as $row) {



?>
        <tr>
        <td><h4>&nbsp; <?= "ici pseudoMemb"; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= "ici libTitrArt"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici libCom"; ?> &nbsp;</td>

        <td>&nbsp;<span class="OK">&nbsp; <?= "ici (un)like"; ?> &nbsp;</span></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier like commentaire" title="Modifier like commentaire" /></i></a><br>&nbsp;&nbsp;<span class="error">(Un)like</span>&nbsp;
        <br /></td>

        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer like commentaire" title="Supprimer like commentaire" /></i></a><br>&nbsp;&nbsp;<span class="error">(S/Admin)</span>&nbsp;
        <br /></td>
        </tr>
<?php
    // }   // End of foreach
?>
    </tbody>
    </table>

    <p>&nbsp;</p>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
