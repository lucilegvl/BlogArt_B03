<?php
////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateMotCle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe MotCle
require_once __DIR__ . '/../../CLASS_CRUD/motCle.class.php';

// Instanciation de la classe MotCle
$monMotCle = new MOTCLE();


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
        $sameId=$_POST['id'];
        header("Location: ./updateMotCle.php?id=".$sameId);
    }  

    if (((isset($_POST['libMotCle'])) AND !empty($_POST['libMotCle']))
    AND ((isset($_POST['numLang'])) AND !empty($_POST['numLang']))
    AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) { // Saisies valides

        $erreur = false;
        $lib1Langue = ctrlSaisies($_POST['libMotCle']);
        $lib2Langue = ctrlSaisies($_POST['numLang']);
        $numLang = ctrlSaisies($_POST['id']);

        $monMonCle->update($lib2Langue, $numLang);

        header("Location: ./motCle.php");
    }   // Fin if ((isset($_POST['libStat'])) ...
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
    }
}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")



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
    <h2>Modification d'un Mot Clé</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET

    if (isset($_GET['id'])) {
        //ajouter ctrl saisies ici

        $id=$_GET['id'];
        $req = $monMotCle->get_1MotCle($id);
        if ($req) {
            $libMotCle = $req['libMotCle'];
            $numLang = $req['numLang'];
            $id = $req['numLang'];
        }
    }
?>
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
            <label class="control-label" for="LibTypLang"><b>Langue :&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idLang" name="idLang" value="<?= isset($_GET['idLang']) ? $_GET['idLang'] : '' ?>" />

                <!-- <input type="text" name="idLang" id="idLang" size="5" maxlength="5" value="<?= $idLang; ?>" autocomplete="on" /> -->

                <!-- Listbox langue => 2ème temps -->
                <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez la langue !" >                    <option value="-1">- - - Choisissez une langue - - -</option>
                    <option value="-1">- - - Choisissez une langue - - -</option>
<?php
                $listNumLang = "";
                $listLib1Lang = "";
                $result = $maLangue->get_AllLanguesByLib1Lang();

                if($result){
                    
                    foreach($result as $row) {

                        $listNumLang = $row["numLang"];
                        $listLib1Lang = $row["lib1Lang"];
?>
                        <option value="<?= $listNumLang; ?>">
                            <?= $listLib1Lang; ?>
                        </option>
<?php
                    } // End of foreach
                }   // if ($result)
?>
            </select>
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
