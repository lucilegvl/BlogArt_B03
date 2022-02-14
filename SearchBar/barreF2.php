<?php
////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : barreF2.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Barre de recherche en GET : Validation par <Enter>

// Mode DEV
require_once __DIR__ . '/../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../util/ctrlSaisies.php';

// Insertion classe Article

// Instanciation Classe Article

// Initialisation var


// Recherche / Affichage articles




?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title>Barre de recherche</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="./../back/css/style4.css" rel="stylesheet" type="text/css" />
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
    <h1>BLOGART22 Admin - Barre de recherche des Articles</h1>
    <h2>Un seul mot clé parmi les articles (F2 en GET)</h2>
    <br /><hr /><br />
    <form method="GET">
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="search" name="search" size="40" placeholder="Recherche par mot clé..." />
    </form>
    <br /><hr /><br />

    <br><br>
<?php
require_once __DIR__ . '/footer.php';
?>
</body>
</html>
