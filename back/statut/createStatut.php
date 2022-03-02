<?php
////////////////////////////////////////////////////////////
//
//  CRUD STATUT (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createStatut.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Statut
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';

require_once ROOT . '/front/includes/commons/___headerFront.php';


// Instanciation de la classe Statut
$monStatut = new STATUT();

// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    //Opérateur ternaire
    //$Submit = isset($_POST(['Submit'])) ? $_POST['Submit'] : '';
    //ou


    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }

    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {

        header("Location: ./createStatut.php");
    }   // End of if ((isset($_POST["submit"]))

    // controle des saisies du formulaire
    // Saisies valides
    if (((isset($_POST['libStat'])) AND !empty($_POST['libStat']))
    AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {
        $erreur = false;

        $libStat = ctrlSaisies(($_POST['libStat']));
        $StatutLenght = strlen($libStat);
        if ($StatutLenght <= 60) {
            // insertion effective du statut
            $monStatut->create($libStat);

            header("Location: ./statut.php");
        } else {
            $erreur = true;
            $errSaisies = "Erreur, le libellé est trop long.";
        }
    }   // Fin if ((isset($_POST['libStat'])) ...
    else {
        // Saisies invalides
        $erreur = true;
        // Gestion des erreurs => msg si saisies ok
        $errSaisies =  "Erreur, la saisie est obligatoire !";
    }   // End of else erreur saisies

}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

// Init variables form
include __DIR__ . '/initStatut.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Statut</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />

    </head>
<body>
    <h1> Mon espace administrateur</h1>
    
    <!-- <h2>Ajout d'un statut</h2> -->

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
            <h2>Créer un statut</h2>

            <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

            <fieldset>
                <legend class="legend1">Formulaire création d'un statut </legend>

                <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

                <div class="control-group">
                    <label class="control-label" for="libStat"><b>Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                    <input type="text" name="libStat" id="libStat" size="80" maxlength="80" value="<?= $libStat; ?>" autofocus="autofocus" />
                </div>

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
                        <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:#263d57" name="Submit" />
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="submit" value="Valider" style="cursor:pointer; border-color: #263d57; padding:5px 20px; background-color:#263d57" name="Submit" />
                        <br>
                    </div>
                </div>
            </fieldset>
            </form>
        </div>
    </div>

<?php
/*require_once __DIR__ . '/footerStatut.php';

require_once __DIR__ . '/footer.php';*/

require_once ROOT . '/front/includes/commons/___footerFront.php';

?>
</body>
</html>
