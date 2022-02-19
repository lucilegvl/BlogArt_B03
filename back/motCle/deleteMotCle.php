<?php
////////////////////////////////////////////////////////////
//
//  CRUD MOTCLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteMotCle.php  -  (ETUD)  BLOGART22
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

// Insertion classe Langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';

// Instanciation de la classe langue
$maLangue = new LANGUE();

// Insertion classe MotCleArticle
require_once __DIR__ . '/../../CLASS_CRUD/motclearticle.class.php';

// Instanciation de la classe MotCleArticle
$monMotCleArticle = new MOTCLEARTICLE();


// Ctrl CIR
$errCIR = 0;
$errDel=0;

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
        header("Location: ./MotCle.php");
    }   

    elseif (($_POST["Submit"] == "Valider")) {{
    
        // Saisies valides
        $erreur = false;
        $numMotCle = ctrlSaisies($_POST['id']);
        $nbMotCle = $monMotCleArticle->get_NbAllArtsByNumMotCle($numMotCle);
        
        if ($nbMotCle>0) {
            $erreur=true;
            $errSaisies = "Erreur, suppression impossible.";
            echo $errSaisies;

        } else {
            $erreur=false;
            $monMotCle->delete($_POST['id']);
            header("Location: ./motCle.php");
        } 
    }

    }// Fin if

    //else { // Saisies invalides
        //$erreur = true;
        //$errSaisies =  "Erreur, la saisie est obligatoire !";
    //}  

}// End of if ($_SERVER["REQUEST_METHOD"] === "POST")

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
    <style type="text/css">
        #p1 {
            max-width: 600px;
            width: 600px;
            max-height: 200px;
            height: 200px;
            border: 1px solid #000000;
            background-color: whitesmoke;
            /* Coins arrondis et couleur cadre */
            border: 2px solid grey;
            -moz-border-radius: 8px;
            -webkit-border-radius: 8px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Mot Clé</h1>
    <h2>Suppression d'un Mot Clé</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET

    if (isset($_GET['id'])) { //toujours update delete

        $id = ctrlSaisies($_GET['id']);
        echo $id;

        $req = $monMotCle->get_1MotCle($id);
        if ($req) {
            $libMotCle = $req['libMotCle'];
            $numLang = $req['numLang'];
            
            $request = $maLangue->get_1Langue($numLang);
            $lib1Lang=$request['lib1Lang'];         }
    }
?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Mot Clé...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libMotCle"><b>Libellé :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libMotCle" id="libMotCle" size="80" maxlength="100" value="<?= $libMotCle; ?>" disabled />
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox langue -->
        <br>
        <label for="LibTypLang" title="Sélectionnez la langue !">
            <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
        </label>
        <input type="hidden" id="idTypLang" name="idTypLang" value="<?= $idLang; ?>" />
            <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez la langue !" > -->
                <!-- <option value="-1"> Choisissez une langue </option> -->
<?php
                //$listNumLang = "";
                //$listLib1Lang = "";

                //$result = $maLangue->get_AllLanguesByLib1Lang();

                //if($result){
                    //foreach($result as $row) {
                       // $listNumLang = $row["numLang"];
                        //$listLib1Lang = $row["lib1Lang"];
?> 
                        <option value="<?= $lib1Lang; ?>">
                            <?= $lib1Lang; ?>
                        </option>
<?php
                     // End of foreach
                   // if ($result)
?>
            </select>
        </div>
    <!-- FIN Listbox langue -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Langue -->
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
</body>
</html>
      <div class="control-group">
=======
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
require_once __DIR__ . '/footerMotCle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
