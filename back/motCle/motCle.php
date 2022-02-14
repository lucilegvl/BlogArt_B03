<?php
////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : motCle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe MotCle

// Instanciation de la classe MotCle


?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
	<title>Admin - CRUD Mot Clé</title>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Mot Clé</h1>

	<hr />
	<h2>Nouveau Mot Clé :&nbsp;<a href="./createMotCle.php"><i>Créer un Mot Clé</i></a></h2>
	<hr />
	<h2>Tous les Mots Clés</h2>

	<table border="3" bgcolor="aliceblue">
    <thead>
        <tr>
            <th>&nbsp;Numéro&nbsp;</th>
            <th>&nbsp;Nom Mot Clé&nbsp;</th>
            <th>&nbsp;Langue&nbsp;</th>
            <th colspan="2">&nbsp;Action&nbsp;</th>
        </tr>
    </thead>
    <tbody>

<?php
    // Appel méthode : Get toutes les mots cles en BDD

    // Boucle pour afficher
    //foreach($all as $row) {
?>
        <tr>

		<td><h4>&nbsp; <?= "ici numMotCle"; ?> &nbsp;</h4></td>

        <td>&nbsp; <?= "ici libMotCle"; ?> &nbsp;</td>

        <td>&nbsp; <?= "ici lib1Lang"; ?> &nbsp;</td>

		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./updateMotCle.php?id=<?=1; ?>"><i><img src="./../../img/valider-png.png" width="20" height="20" alt="Modifier mot clé" title="Modifier mot clé" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>
		<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="./deleteMotCle.php?id=<?=1; ?>"><i><img src="./../../img/supprimer-png.png" width="20" height="20" alt="Supprimer mot clé" title="Supprimer mot clé" /></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
		<br /></td>

        </tr>
<?php
	// }	// End of foreach
?>
    </tbody>
    </table>
    <br /><br/>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
