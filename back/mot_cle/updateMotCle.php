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
require_once __DIR__ . '/../../class_crud/motcle.class.php';

// Instanciation de la classe MotCle
$monMotCle = new MOTCLE();

// Insertion classe Langue
require_once __DIR__ . '/../../class_crud/langue.class.php';

// Instanciation de la classe langue
$maLangue = new LANGUE();

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
        $sameId= $_POST['id'];
        header("Location: ./updateMotCle.php?id=".$sameId);
    }  

    if (((isset($_POST['libMotCle'])) AND !empty($_POST['libMotCle']))
    AND ((isset($_POST['TypLang'])) AND !empty($_POST['TypLang']))
    AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) { // Saisies valides

        $erreur = false;

        $numMotCle = ctrlSaisies($_POST['id']);
        $libMotCle = ctrlSaisies($_POST['libMotCle']);
        $TailleMotCle = strlen($libMotCle);
        $numLang = ctrlSaisies($_POST['TypLang']);
       
        if ($TailleMotCle <= 60){
            $monMotCle->update($numMotCle, $libMotCle, $numLang); //modification effective du mot clé

            header("Location: ./motCle.php");
        } else {
            $erreur = true;
            $errSaisies = "Erreur, le libellé est trop long.";
        }
    }   // Fin if ((isset($_POST['libStat'])) 
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, Veuillez remplir tous les champs de saisie !";
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
<!-- section pour ajouter le header sans qu'il gene avec le location-->
<section> 
<?php require_once ROOT . '/front/includes/commons/___headerFront.php';?>
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
                    <li class="menu-back-thematiques">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class=formulaire>    
    <h2>Modification d'un Mot Clé</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET

        //ajouter ctrl saisies ici

        if (isset($_GET['id'])) { //toujours update delete

            $id = ctrlSaisies($_GET['id']);
           
            $req = $monMotCle->get_1MotCleByLang($id);
            if ($req) {
                $libMotCle = $req['libMotCle'];
                $idLang = $req['numLang'];               

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
        <label for="LibTypLang" title="Sélectionnez la langue !">
            <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
        </label>
        <input type="hidden" id="idTypLang" name="idTypLang" value="<?= $idLang; ?>" />
            <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez la langue !" >
<?php
                $listNumLang = "";
                $listLib1Lang = "";

                $result = $maLangue->get_AllLanguesOrderByLib1Lang();
                if($result){
                    foreach($result as $row) {
                        $listNumLang = $row["numLang"];
                        $listLib1Lang = $row["lib1Lang"];
?>
                        <option value="<?= ($listNumLang); ?>" <?= ((isset($idLang) && $idLang == $listNumLang) ? " selected='selected'" : null); ?>>
                                <?= $listLib1Lang; ?>
                        </option>
<?php
                    } // End of foreach
                }   // if ($result)
?>
            </select>
        
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
