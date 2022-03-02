<?php
////////////////////////////////////////////////////////////
//
//  Gestion des CRUD (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : barreCONCAT.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Plusieurs tags

// Mode DEV
require_once __DIR__ . '/../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../util/ctrlSaisies.php';

// Recup et mise en forme mots clés pour prépar requete SQL
require_once __DIR__ . '/../util/preparerTags.php';

// Insertion classe Article

// Instanciation Classe Article


// Initialisation var
$motcle = "";

/*------------------------------------------------------------------*/
// Recherche à partir de table ARTICLE & table THEMATIQUE
/*------------------------------------------------------------------*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	// recup most clés

}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

/*------------------------------------------------------------------*/
// Formulaire
/*------------------------------------------------------------------*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Barre de recherche</title>
    <link href="./../back/css/style4.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<h1>BLOGART22 Admin - Barre de recherche dans ARTICLE (CONCAT)</h1>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">
		<br>
		<input type="search" name="motcle" required="required" size="70" maxlength="70" placeholder="Mots clés séparés par un espace..." />
		<br><br>
		<input type="submit" name="Submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" />
	</form>
<?php
	// Affichage
?>
    <br><br>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
