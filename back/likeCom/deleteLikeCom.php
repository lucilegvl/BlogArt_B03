<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKECOM (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteLikeCom.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likecom

// Instanciation de la classe Likecom



// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    // delete effective du likcom









}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initLikeCom.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Like Commentaire</h1>
    <h2>Suppression d'un (un)like sur Commentaire</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET






?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Like Commentaire...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />
        <input type="hidden" id="id3" name="id3" value="<?= isset($_GET['id3']) ? $_GET['id3'] : '' ?>" />
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Membre -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypMemb">
                <b>Quel membre :&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?= $numMemb; ?>" />

            <input type="text" name="idMemb" id="idMemb" size="5" maxlength="5" value="<?= $idmemb; ?>" autocomplete="on" />

            <!-- Listbox membre disabled => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Membre -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypArt">
                <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />

            <input type="text" name="idArt" id="idArt" size="5" maxlength="5" value="<?= $idArt; ?>" autocomplete="on" />

            <!-- Listbox article disabled => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Commentaire -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypSeqCom">
                <b>Quel Commentaire :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypSeqCom" name="idTypSeqCom" value="<?= $numSeqCom; ?>" />

            <input type="text" name="idCom" id="idCom" size="5" maxlength="5" value="<?= $idCom; ?>" autocomplete="on" />

            <!-- Listbox Commentaire disabled => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Commentaire -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

        <div class="control-group">
            <div class="error">
<?php
            if ($erreur) {
                echo ($errSaisies);
            } else {
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
                <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
<<?php
require_once __DIR__ . '/footerLikeCom.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
