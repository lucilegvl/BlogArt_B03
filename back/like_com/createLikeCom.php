<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKECOM (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createLikeCom.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likecom

// Instanciation de la classe Likecom



// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {




    // controle des saisies du formulaire

    // création effective du likecom



    // Gestion des erreurs => msg si saisies ko





}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initLikeCom.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Like Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
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
    <h2>Ajout d'un like sur un Commentaire d'un Article</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Like Commentaire d'un Article...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />
        <input type="hidden" id="id3" name="id3" value="<?= isset($_GET['id3']) ? $_GET['id3'] : '' ?>" />
        <br>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Membre -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypMemb">
                <b>Quel membre :&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?= $numMemb; ?>" />

            <input type="text" name="idMemb" id="idMemb" size="5" maxlength="5" value="<?= $idMemb; ?>" autocomplete="on" />

            <!-- Listbox membre => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Membre -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Commentaire / Article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypArt">
                <b>Quel commentaire par article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />
            <input type="hidden" id="idTypSeqCom" name="idTypSeqCom" value="<?= $numSeqCom; ?>" />

            <input type="text" name="idArt" id="idArt" size="5" maxlength="5" value="<?= $idArt; ?>" autocomplete="on" />

            <!-- Listbox article => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Commentaire / Article -->
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
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
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
