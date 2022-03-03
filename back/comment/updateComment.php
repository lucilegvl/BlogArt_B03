<?php
////////////////////////////////////////////////////////////
//
//  CRUD COMMENT (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateComment.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Comment

// Instanciation de la classe Comment


//--> Appel parser BBCode


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {



    // controle des saisies du formulaire

    // modification effective du comment



    // Gestion des erreurs => msg si saisies ko







}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initComment.php';
$htmlCode    = "";
$noBBCode    = "";
$description = "";
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Commentaire</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

  <!-- Style du formulaire et des boutons -->
    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <script src="./script_global.js"></script>

    <style type="text/css">
        textarea { /* Désactivez redimensionnement par défaut */
            resize: none;
        }
    </style>
</head>

<!-- section pour ajouter le header sans qu'il gene avec le location-->
<!-- <section> 
</section> -->

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
    <h2>Mise à jour d'un commentaire</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET








?>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Modération : validez un commentaire...</legend>

        <input type="hidden" id="id1" name="id1" value="<?= isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
        <input type="hidden" id="id2" name="id2" value="<?= isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

<!-- --------------------------------------------------------------- -->
    <!-- FK : Membre, Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Membre -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypAngl">
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
    <!-- Listbox Article -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypThem">
                <b>Quel article :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>
            <input type="hidden" id="idTypArt" name="idTypArt" value="<?= $numArt; ?>" />

            <input type="text" name="idArt" id="idArt" size="5" maxlength="5" value="<?= $idArt; ?>" autocomplete="on" />

            <!-- Listbox article => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : Membre, Article -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- textarea comment -->
        <br>
        <div class="control-group">
            <label class="control-label" for="libCom"><b>Commentaire à valider :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">

            <textarea name="libCom" id="libCom" tabindex="30"  rows="20" cols="70" style="background-color:white;" disabled="disabled"><?= $libCom; ?></textarea>
            </div>
        </div>
    <!-- End textarea comment -->
<!-- --------------------------------------------------------------- -->

        <br>
        <div class="control-group">
            <label class="control-label" for="attModOK"><b>En tant que modérateur, je valide le post :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="attModOK"
                  <? if($attModOK == 1) echo 'checked="checked"'; ?>
                  value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="attModOK"
                  <? if($attModOK == 0) echo 'checked="checked"'; ?>
                  value="off" />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>

<!-- --------------------------------------------------------------- -->
     <!-- Début textarea notification commentaire -->
        <div class="control-group">
            <label class="control-label" for="notifComKOAff"><b>En voici les raisons :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="notifComKOAff" id="notifComKOAff" rows="10" cols="70" tabindex="70" placeholder="Décrivez la raison pour laquelle vous ne voulez pas afficher le post." ><?= $notifComKOAff; ?></textarea>
            </div>
        </div>
       <small class="error">Vous pouvez ajouter une notification de rejet du post (propos difammatoires, injures, vulgarité,...)</small><br>
    <!-- End textarea notification commentaire -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
    <!-- Suppression logique du commentaire -->
       <br>
        <div class="control-group">
            <label class="control-label" for="delLogiq"><b>En tant que modérateur, je veux que le post soit supprimé :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="delLogiq"
                  <? if($delLogiq == 1) echo 'checked="checked"'; ?>
                  value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="delLogiq"
                  <? if($delLogiq == 0) echo 'checked="checked"'; ?>
                  value="off" />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>
        <br>
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
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Initialiser" style="cursor:pointer; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; border-color: #0e1a27; padding:5px 20px; background-color:#0e1a27" name="Submit" />
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
