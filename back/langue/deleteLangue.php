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
require_once __DIR__ . '/../../class_crud/langue.class.php';
// Instanciation de la classe langue
$maLangue = new LANGUE();

// Instanciation de la classe pays
$monPays = new PAYS();

// Ctrl CIR
$errCIR = 0;
$errDel=0;

// Insertion classe Angle
require_once __DIR__ . '/../../class_crud/angle.class.php';
// Instanciation de la classe Angle
$monAngle = new ANGLE();

// Insertion classe Thematique
require_once __DIR__ . '/../../class_crud/thematique.class.php';
// Instanciation de la classe Thematique
$maThematique = new THEMATIQUE();

// Insertion classe Motcle
require_once __DIR__ . '/../../class_crud/motcle.class.php';
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

 <!-- section pour ajouter le header sans qu'il gene avec le location-->
 <section> 
<?php require_once ROOT . '/front/includes/commons/___headerFront.php'; ?>
</section>

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
                        <a href="../mot_cle/motCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
    <div class=formulaire>    
    <h2>Suppression d'une langue</h2>
<?php
    if (isset($_GET['id'])) {
        $id=$_GET['id'];
        $req = $maLangue->get_1Langue($id);
        $lib1Lang = $req['lib1Lang'];
        $lib2Lang = $req['lib2Lang'];
        $numLang = $req['numLang'];
        $numPays = $req['numPays'];

        $request=$monPays->get_1Pays($numPays);
        $frPays=$request['frPays'];
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

            <input type="hidden" id="idPays" name="idPays" value="<?= $numLang; ?>" />
            <select size="1" name="TypPays" id="TypPays"  class="form-control form-control-create" title="Sélectionnez le pays!" >

                <option value="<?php $numPays; ?>">
                    <?php echo $frPays; ?>
                </option>
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
                    <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider" style="cursor:pointer; border-color: #0e1a27; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                    <br>
                </div>
            </div>
        </fieldset>
    </form>
    </div>
    </div>
</body>
</html>
      <div class="control-group">
      </fieldset>
    </form>

    <br>

<?php
require_once ROOT . '/front/includes/commons/___footerFront.php';

?>
</body>
</html>