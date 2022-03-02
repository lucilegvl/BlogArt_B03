<?php
////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateAngle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Angle
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
// Insertion classe Langue 
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';

require_once ROOT . '/front/includes/commons/___headerFront.php';

// Instanciation de la classe angle
$monAngle = new ANGLE();
// Instanciation de la classe langue
$maLangue = new LANGUE();

// Gestion  erreurs de saisie
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
        header("Location: ./updateAngle.php?id=".$sameId);
    }  

    // controle des saisies du formulaire
    // Saisies valides
    if (((isset($_POST['libAngl'])) AND !empty($_POST['libAngl']))
    AND ((isset($_POST['TypLang'])) AND !empty($_POST['TypLang']))
    AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {
        
        $erreur = false;
 
        $libAngl = ctrlSaisies(($_POST['libAngl']));
        $AngleLenght = strlen($libAngl);
        $numLang = ctrlSaisies(($_POST['TypLang']));
        $numAngl = ctrlSaisies(($_POST['id']));

        if ($AngleLenght <= 60) {
            // modification effective du angle
            $monAngle->update($numAngl, $libAngl, $numLang);

            header("Location: ./angle.php");
        } else {
            $erreur = true;
            $errSaisies = "Erreur, le libellé est trop long.";
        }

    }  else {
        // Gestion des erreurs => msg si saisies ko
        $erreur = true;
        $errSaisies =  "Erreur, Veuillez remplir tous les champs de saisie !";
    }

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")

// Init variables form
include __DIR__ . '/initAngle.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Angle</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <h1>mon espace administrateur</h1>
    <div class=parentback>
        <div class=menu-back>
            <nav>
                <ul class="menuback-liens">
                    <li class="menu-back-gererArticles">
                        <a href="../article/article.php" class=articles>Gérer mes articles</a>
                    </li>
                    <li class="menu-back-gererLangues">
                        <a href="../langue/langue.php" class=langues>Gérer mes langues</a>
                    </li>
                    <li class="menu-back-angles">
                        <a href="../angle/angle.php" class=angles>Gérer mes angles</a>
                    </li>
                    <li class="menu-back-membres">
                        <a href="../membre/membre.php" class=membres>Gérer mes membres</a>
                    </li>
                    <li class="menu-back-utilisateurs">
                        <a href="../user/user.php" class=users>Gérer mes users</a>
                    </li>
                    <li class="menu-back-com">
                        <a href="../comment/comment.php" class=comment>Gérer mes commentaires</a>
                    </li>
                    <li class="menu-back-likeart">
                        <a href="../likeArt/likeArt.php" class=likeart>Gérer mes like</a>
                    </li>
                    <li class="menu-back-likecom">
                        <a href="../likeCom/likeCom.php" class=likecom>Gérer mes like sur commentaires</a>
                    </li>
                    <li class="menu-back-statut">
                        <a href="../statut/statut.php" class=stat>Gérer mes statuts</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../motCle/MotsCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class=formulaire>

    <h2>Modification d'un angle</h2>
<?php

    if (isset($_GET['id'])) {
        //ajouter ctrl saisies ici

        $id=ctrlSaisies($_GET['id']);
        $req = $monAngle->get_1AngleByLang($id);

        if ($req) {
            $libAngl = $req['libAngl'];
            $idLang = $req['numLang'];    
            $numAngl = $req['numAngl'];
        } 
    }
?>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Angle...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libAngl"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAngl" id="libAngl" size="80" maxlength="80" value="<?= $libAngl; ?>" tabindex="10" autofocus="autofocus" />
        </div>
        <br>
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
    <!-- Listbox Langue -->
    <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypLang" title="Sélectionnez la langue !">
                <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
            </label>

            <!-- Listbox langue => 2ème temps -->

            <input type="hidden" id="idTypLang" name="idTypLang" value="<?= $numLang; ?>" />
                <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez la langue !" > 

            <?php
                $listNumLang = "";
                $listlib1Lang = "";

                $result = $maLangue->get_AllLanguesOrderByLib1Lang();
                if($result){
                    foreach($result as $row) {
                        $listNumLang= $row["numLang"];
                        $listlib1Lang = $row["lib1Lang"];
            ?>
                        <option value="<?= ($listNumLang); ?>" <?= ((isset($idLang) && $idLang == $listNumLang) ? " selected='selected'" : null); ?>>
                            <?php echo $listlib1Lang; ?>
                        </option>
            <?php
                    } // End of foreach
                }   // if ($result)
            ?>

            </select>

            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
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
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; border-color: #0e1a27; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
    </div>
    </div>
<?php
require_once __DIR__ . '/footerAngle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
