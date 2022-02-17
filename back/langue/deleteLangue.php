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
$maLangue = new LANGUE();

// Instanciation de la classe pays
$monPays = new PAYS();

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
$monMotcle = new MOTCLE();

// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["Submit"] == "Annuler") {
        $sameId=$_POST['id'];
        header("Location: langue.php");
    }
    
    //delete effectif du langue
    elseif (($_POST["Submit"] == "Valider")) {
        $erreur = false;

        $nbThematique = $maThematique->get_NbAllThematiquesBynumLang($_POST['id']);
        $nbAngle = $monAngle->get_NbAllAnglesBynumLang($_POST['id']);

        if (($nbThematique > 0) AND ($nbAngle > 0)){
            $erreur = true;
            $errSaisies =  "Erreur, la suppression est impossible.";
            echo $errSaisies;
        } else{
            $maLangue->delete($_POST['id']);
            header("Location: langue.php");
        }
    }      // Fin if ((isset($_POST['libStat'])) ...
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
    }  
}  // End of if ($_SERVER["REQUEST_METHOD"] === "POST")

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
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $req = $maLangue->get_1Langue($id);
        $lib1Lang = $req['lib1Lang'];
        $lib2Lang = $req['lib2Lang'];
        $id = $req['numLang'];
    }
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
  
            <label for="LibTypPays" title="Sélectionnez le pays !">
                <b>Quel pays :&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idPays" name="idPays" value="<?= $id; ?>" />
            <select size="1" name="TypPays" id="TypPays"  class="form-control form-control-create" title="Sélectionnez le pays!" >
                <option value="-1">- - - Choisissez un pays - - -</option>
            <?php
                $listNumPays = "";
                $listfrPays = "";

                $result = $monPays->get_AllPays();
                if($result){
                    foreach($result as $row) {
                        $listNumPays= $row["numPays"];
                        $listfrPays = $row["frPays"];
            ?>
                    <option value="<?= $listNumPays; ?>">
                        <?= $listfrPays; ?>
                    </option>
            <?php
                    } // End of foreach
                }   // if ($result)
            ?>
            </select>
    <!-- FIN Listbox Pays -->
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

<<<<<<< HEAD
<<<<<<< HEAD
require_once __DIR__ . '/footer.php';
?> <!-- FIN Listbox Pays -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

</body>
</html>
      <div class="control-group">
=======
<div class="control-group">
>>>>>>> 1eb311e2e5df6f9d4ea33ca379f90792389856c9
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
=======
>>>>>>> bb6ee881362272c4f65180dfbc9b5ad22718c4ac
    <br>
    <i><div class="error"><br>=>&nbsp;Attention, une suppression doit respecter les CIR !</div></i>
<<<<<<< HEAD
</body>
</html>
=======
>>>>>>> 1eb311e2e5df6f9d4ea33ca379f90792389856c9

<?php
require_once __DIR__ . '/footerLangue.php';

require_once __DIR__ . '/footer.php';
?>