<?php
////////////////////////////////////////////////////////////
//
//  CRUD ANGLE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteAngle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Angle
require_once __DIR__ . '/../../class_crud/angle.class.php';
// Instanciation de la classe angle
$monAngle = new ANGLE();

// Insertion classe Langue 
require_once __DIR__ . '/../../class_crud/langue.class.php';
require_once ROOT . '/front/includes/commons/___headerFront.php';

// Instanciation de la classe langue
$maLangue = new LANGUE();

// Ctrl CIR
$errCIR = 0;
$errDel=0;
// Insertion classe Article
require_once __DIR__ . '/../../class_crud/article.class.php';
// Instanciation de la classe Article
$monArticle = new ARTICLE();


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';
     //Submit = "";
    if ((isset($_POST['Submit'])) AND ($_POST["Submit"] === "Annuler")) {
        header("Location: ./angle.php");
    }
    // Mode création

    elseif (($_POST["Submit"] == "Valider")) {{
    
        // Saisies valides
        $erreur = false;
        $numAngl = ctrlSaisies($_POST['id']);
        $nbArticle = $monArticle->get_NbAllArticlesByNumAngl($numAngl);
        
        if ($nbArticle>0) {
            $erreur=true;
            $errSaisies = "Erreur, suppression impossible.";
            echo $errSaisies;
        } else {
            $erreur=false;
            $monAngle->delete($_POST['id']);
            header("Location: ./angle.php");
        } 
    }
    }// Fin if

} // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// delete effective 
              
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
                        <a href="../like_art/likeArt.php" class=likeart>Gérer mes like</a>
                    </li>
                    <li class="menu-back-likecom">
                        <a href="../like_com/likeCom.php" class=likecom>Gérer mes like sur commentaires</a>
                    </li>
                    <li class="menu-back-statut">
                        <a href="../statut/statut.php" class=stat>Gérer mes statuts</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../mot_cle/MotsCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
    
    <div class=formulaire>
    <h2>Suppression d'un angle</h2>
<?php
    // Supp : récup id à supprimer
    // id passé en GET
    if (isset($_GET['id'])) {
        //ajouter ctrl saisies ici

        $id= ctrlSaisies($_GET['id']);
        $req = $monAngle->get_1Angle($id);
        if ($req) {
            $numAngl = $req['numAngl'];
            $libAngl = $req['libAngl'];
            $numLang = $req['numLang'];
        }

        $request = $maLangue->get_1Langue($numLang);
        if ($request) {
            $lib1Lang = $request['lib1Lang'];
        }
    }
?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Angle...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libAngl"><b>Libellé :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="libAngl" id="libAngl" size="80" maxlength="80" value="<?= $libAngl; ?>" tabindex="10" disabled />
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

                    <option value="<?=$numLang; ?>">
                        <?php echo $lib1Lang; ?>
                    </option>

                </select>
            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- ---------------------------------------------------------------------- -->
<!-- ---------------------------------------------------------------------- -->
        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; border-color: #0e1a27; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
    <br>
    <!-- <i><div class="error"><br>=>&nbsp;Attention, une suppression doit respecter les CIR !</div></i> -->
    </div>
    </div>
    <?php
require_once ROOT . '/front/includes/commons/___footerFront.php';

?>
</body>
</html>
