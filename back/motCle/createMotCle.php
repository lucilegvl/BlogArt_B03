<?php
////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createMotCle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe MotCle

// Instanciation de la classe MotCle



// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {




    // controle des saisies du formulaire

    // creation effective de la MotCle



    // Gestion des erreurs => msg si saisies ko




}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initMotCle.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Mot Clé</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Mot Clé</h1>
    <h2>Ajout d'un Mot Clé</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Mot Clé...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libMotCle"><b>Libellé :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libMotCle" id="libMotCle" size="80" maxlength="100" value="<?= $libMotCle; ?>" placeholder="Décrivez le mot Clé" autocomplete="on" autofocus="autofocus" />
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox langue -->
        <br>
        <div class="control-group">
            <label class="control-label" for="LibTypLang"><b>Quelle langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idTypLang" name="idTypLang" value="<?= isset($_GET['numLang']) ? $_GET['numLang'] : '' ?>" />

                <input type="text" name="idLang" id="idLang" size="5" maxlength="5" value="<?= $idLang; ?>" autocomplete="on" />

                <!-- Listbox langue => 2ème temps -->

        </div>
    <!-- FIN Listbox langue -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
        <div class="control-group">
            <div class="error">
<?php
            if ($erreur) {
                echo ($errSaisies);
            }
            else {
                $errSaisies = "";
                echo ($errSaisies);
            }
?>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<?php
require_once __DIR__ . '/footerMotCle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
