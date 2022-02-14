<?php
////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : membre.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Membre

// Instanciation de la classe Membre


//  trl CIR
$errCIR = 0;
$errDel = 0;


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD Membre</title>
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
    <h1>BLOGART22 Admin - CRUD Membre</h1>

	<hr />
	<h2>Nouveau Membre :&nbsp;<a href="./createMembre.php"><i>Créer un Membre</i></a></h2>
<?php
    if ($errDel == 99) {
?>
	    <br />
        <i><div class="error"><br>=>&nbsp;Erreur delete MEMBRE : la suppression s'est mal passée !</div></i>
<?php
    }   // End of if ($errDel == 99)
?>    
    <hr />
	<h2>Tous les Membres</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Identité&nbsp;</th>
            <th>&nbsp;Pseudo&nbsp;</th>
            <th>&nbsp;eMail&nbsp;</th>
            <th>&nbsp;Date création&nbsp;</th>
            <th>&nbsp;Connexion&nbsp;<br />&nbsp;auto&nbsp;</th>
            <th>&nbsp;Accord&nbsp;<br />&nbsp;RGPD&nbsp;</th>
            <th>&nbsp;Statut&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>

<?php
    // Format date en FR
    $from = 'Y-m-d H:i:s';
    $to = 'd/m/Y H:i:s';

    // Appel méthode : Get toutes les membres en BDD

    // Boucle pour afficher
    //foreach($all as $row) {



            // date dtCreaMemb => FR
            // $dtCreaMemb = dateChangeFormat($dtCreaMemb, $from, $to);
?>
            <tr>
            <td><h4>&nbsp; <?= "ici numMemb"; ?> &nbsp;</h4></td>

            <td>&nbsp; <?= "ici prenomMemb" . " " . "ici nomMemb"; ?> &nbsp;</td>

            <td>&nbsp; <?= "ici pseudoMemb"; ?> &nbsp;</td>

            <td>&nbsp; <?= "ici eMailMemb"; ?> &nbsp;</td>

            <td>&nbsp; <?= "ici dtCreaMemb" ; ?> &nbsp;</td>

            <td>&nbsp; <?= "ici accordMemb"; ?> &nbsp;</td>

            <td>&nbsp; <?= "ici libStat"; ?> &nbsp;</td>

            <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateMembre.php?id=<?=1; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier membre" title="Modifier membre" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <br /></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteMembre.php?id=<?=1; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer membre" title="Supprimer membre" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <br /></td>
            </tr>
<?php

	// }	// End of foreach
?>
    </tbody>
    </table>
<?php
    if ($errCIR == 1) {
?>
        <i><div class="error"><br>=>&nbsp;Suppression impossible, existence de commentaire(s) associé(s) à ce membre. La suppression des commentaires n'étant pas permise, vous ne pourrez pas supprimer ce membre.</div></i>
<?php
    }   // End of if ($errCIR == 1)
?>
    <p>&nbsp;</p>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
