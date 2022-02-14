<?php
////////////////////////////////////////////////////////////
//
//  CRUD COMMENTPLUS (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : commentPlus.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Comment

// Instanciation de la classe Comment



// Insertion classe CommentPlus

// Instanciation de la classe CommentPlus



// Insertion classe Article

// Instanciation de la classe Article



?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Gestion des Commentaires & Réponses</title>
    <meta charset="utf-8" />
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
    </style>
</head>
<body>
  <h1>BLOGART22 Admin - Gestion du CRUD Commentaires & Réponses</h1>

  <hr /><br />
  <h2>Nouveau commentaire sur un commentaire :&nbsp;<a href="#"><i>Créer une réponse à commentaire</i></a></h2>
  <br />
    <hr />
  <h2>Toutes les commentaires & commentaires</h2>

  <table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro <br>Article&nbsp;</th>
            <th>&nbsp;Date <br>Article&nbsp;</th>
            <th>&nbsp;Numéro <br>Comment&nbsp;</th>
            <th>&nbsp;Commentaire&nbsp;</th>
            <th>&nbsp;Date <br>Comment&nbsp;</th>

            <th>&nbsp;Pseudo&nbsp;</th>
            <th>&nbsp;Visa modération&nbsp;</th>
            <th>&nbsp;Visible après modération&nbsp;</th>
            <th>&nbsp;Commentaire <br>si non visible&nbsp;</th>
            <th>&nbsp;Commentaire <br>affiché&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
    // Format date en FR
    $from = 'Y-m-d H:i:s';
    $to = 'd/m/Y H:i:s';

    // Appel méthode : Get tous les articles en BDD

    // Boucle pour afficher
    //foreach($all as $row) {

?>
        <tr>
        <td><h4>&nbsp; <?= "ici numSeqCom"; ?> &nbsp;</h4></td>

        <td><h4>&nbsp; <?= "ici numArt"; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= "ici pseudoMemb"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici dtCreCom"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici libCom"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici attModOK"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici affComOK"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici notifComKOAff"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici delLogiq"; ?> &nbsp;</td>
<!-- F1 aff Comments (Modérateur / Admin / Super-admin) -->
        <td>&nbsp;<a href="#"><i>Modifier</i></a>&nbsp;
        <br /></td>
<!-- Del logique (Modérateur / Admin / Super-admin) -->
        <td>&nbsp;<a href="#" title="Suppression logique..."><i>Supprimer</i></a><br>&nbsp;&nbsp;<span class="error">(Logique)</span>&nbsp;
        <br /></td>
        </tr>
<?php
    // } // End of foreach
?>
    </tbody>
    </table>
    <p>&nbsp;</p>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
