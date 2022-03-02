<?php
////////////////////////////////////////////////////////////
//
//  CRUD LANGUE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createLangue.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Langue
require_once __DIR__ . '/../../class_crud/langue.class.php';

require_once ROOT . '/front/includes/commons/___headerFront.php';

// Instanciation de la classe langue
$maLangue = new LANGUE();

// Instanciation de la classe pays
$monPays = new PAYS();

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
        header("Location: ./createLangue.php");
    }

    // controle des saisies du formulaire    
    if (isset($_POST['lib1Lang']) AND !empty($_POST['lib1Lang'])
    AND isset($_POST['lib2Lang']) AND !empty($_POST['lib2Lang'])
    AND isset($_POST['TypPays']) AND !empty($_POST['TypPays']) AND $_POST['TypPays'] != -1
    AND !empty($_POST['Submit']) AND ($Submit === "Valider")) { // Saisies valides
        $erreur = false;

        $lib1Lang = ctrlSaisies($_POST['lib1Lang']);
        $lib1Lenght = strlen($lib1Lang);
        $lib2Lang = ctrlSaisies($_POST['lib2Lang']);
        $lib2Lenght = strlen($lib2Lang);
        $numPays = ctrlSaisies($_POST['TypPays']);
  
        if ($lib1Lenght <= 30 AND $lib2Lenght <= 60) {
            $numLang = $maLangue->getNextNumLang($numPays);
            $maLangue->create($numLang, $lib1Lang, $lib2Lang, $numPays);

            header("Location: ./Langue.php");
        } else {
            $erreur = true;
            $errSaisies = "Le(s) libellé(s) dépasse(nt) le nombre maximal de caractères.";
        }
    } else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, Veuillez remplir tous les champs de saisie !";
    }   // End of else erreur saisies

}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

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
    <h2>Ajout d'une langue</h2>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Formulaire Langue...</legend>

            <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

            <div class="control-group">
                <label class="control-label" for="lib1Lang"><b>Libellé court :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="lib1Lang" id="lib1Lang" size="80" maxlength="80" value="<?= $lib1Lang; ?>" tabindex="10" autofocus="autofocus" /><br><br>
            </div>
            <div class="control-group">
                <label class="control-label" for="lib2Lang"><b>Libellé long :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="lib2Lang" id="lib2Lang" size="80" maxlength="80" value="<?= $lib2Lang; ?>" tabindex="20" />
            </div>
            <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    
<!-- Listbox Pays -->
<br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypPays" title="Sélectionnez le pays !">
                <b>Quel pays :&nbsp;&nbsp;&nbsp;</b>
            </label>
 
            <select size="1" name="TypPays" id="TypPays"  class="form-control form-control-create" title="Sélectionnez le pays!" >
                <option value="-1">- - - Choisissez un pays - - -</option>

            <?php
                $listNumPays = "";
                $listfrPays = "";

                $result = $monPays->get_AllPaysOrderByNumPays();
                if($result){
                    foreach($result as $row) {
                        $listNumPays= $row["numPays"];
                        $listfrPays = $row["frPays"];
            ?>
                        <option value="<?= $listNumPays; ?>">
                            <?=  $listfrPays; ?>
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
    require_once ROOT . '/front/includes/commons/___footerFront.php';

    ?>

</body>
</html>