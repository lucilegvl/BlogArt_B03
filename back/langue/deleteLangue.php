<?php
////////////////////////////////////////////////////////////
//
//  CRUD KANGUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteLangue.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
// Instanciation de la classe langue
$MaLangue = new LANGUE();


// Ctrl CIR
$errCIR = 0;
$errDel=0;

// Insertion classe Angle
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
// Instanciation de la classe Angle
$monAngle = new ANGLE();

// Insertion classe Thematique
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
// Instanciation de la classe Thematique
$maThematique = new THEMATIQUE();

// Insertion classe Motcle
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
// Instanciation de la classe Motcle
$monMotcle = new THEMATIQUE();

// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Annuler")) {
        $sameId=$_POST['id'];
        header("Location: ./deleteStatut.php?id=".$sameId);
    }   

    if (((isset($_POST['libStat'])) AND !empty($_POST['libStat']))
    AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {

        $erreur = false;
        $libStat = ctrlSaisies(($_POST['libStat']));
        $idStat = ctrlSaisies(($_POST['id']));
        $nbMembre = $monMembre->get_NbAllMembersByidStat($_POST['id']);
        $nbUser = $monUser->get_NbAllUsersByidStat($_POST['id']);

        if (($nbMembre > 0) AND ($nbUser > 0)){
            $erreur = true;
            $errSaisies =  "Erreur, la suppression est impossible.";
            echo $errSaisies;
        } else{
            $monStatut->delete($idStat);
            header("Location: ./statut.php");
        }
    }      // Fin if ((isset($_POST['libStat'])) ...
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
    }  

}   // End of if ($_SERVER["REQUEST_METHOD"] === "POST")

// Init variables form
include __DIR__ . '/initLangue.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Langue</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
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
    <h1>BLOGART22 Admin - CRUD Langue</h1>
    <h2>Suppression d'une langue</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET





?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Langue...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="lib1Lang"><b>Libellé court :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang; ?>" tabindex="10" disabled /><br>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="lib2Lang"><b>Libellé long :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="lib1Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang; ?>" tabindex="20" disabled />
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Pays -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypPays">
                <b>Quel pays :&nbsp;&nbsp;&nbsp;</b>
            </label>


                <input type="text" name="idLang" id="idLang" size="5" maxlength="5" value="<?= "" ?>" autocomplete="on" />

                <!-- Listbox langue disabled => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Pays -->
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
    <br>
    <i><div class="error"><br>=>&nbsp;Attention, une suppression doit respecter les CIR !</div></i>
<?php
require_once __DIR__ . '/footerLangue.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
