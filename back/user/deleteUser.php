<?php
////////////////////////////////////////////////////////////
//
//  CRUD USER (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteUser.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe User

// Instanciation de la classe User



// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {



    // controle CIR

    // delete effective du user









}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initUser.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur du cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD User</h1>
    <h2>Suppression d'un user</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET





?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire User...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="pseudoUser"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoUser" id="pseudoUser" size="80" maxlength="80" value="<?= $pseudoUser; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1User"><b>Mot passe :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1User" id="pass1User" size="80" maxlength="80" value="<?= $pass1User; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="prenomUser"><b>Prénom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomUser" id="prenomUser" size="80" maxlength="80" value="<?= $prenomUser; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomUser"><b>Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomUser" id="nomUser" size="80" maxlength="80" value="<?= $nomUser; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1User"><b>eMail :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1User" id="eMail1User" size="80" maxlength="80" value="<?= $eMail1User; ?>" disabled />
        </div>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->
        <br><br>
        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_GET['idStat']) ? $_GET['idStat'] : '' ?>" />

                <input type="text" name="idStat" id="idStat" size="5" maxlength="5" value="<?= $idStat; ?>" autocomplete="on" />

                <!-- Listbox statut disabled => 2ème temps -->

        </div>

    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

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
<?php
require_once __DIR__ . '/footerUser.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
