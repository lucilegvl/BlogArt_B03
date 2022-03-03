<?php
    ////////////////////////////////////////////////////////////
    //
    //  CRUD STATUT (PDO) - Modifié : 4 Juillet 2021
    //
    //  Script  : updateStatut.php  -  (ETUD)  BLOGART22
    //
    ////////////////////////////////////////////////////////////

    // Mode DEV
    require_once __DIR__ . '/../../util/utilErrOn.php';

    // controle des saisies du formulaire
    require_once __DIR__ . '/../../util/ctrlSaisies.php';

    // Insertion classe Statut
    require_once __DIR__ . '/../../class_crud/statut.class.php';
    // Instanciation de la classe Statut
    $monStatut = new STATUT();

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
            header("Location: ./updateStatut.php?id=".$sameId);
        }   
    
        // controle des saisies du formulaire
        if (((isset($_POST['libStat'])) AND !empty($_POST['libStat']))
        AND (!empty($_POST['Submit']) AND ($Submit === "Valider"))) {
        
            // Saisies valides
            $erreur = false;

            $libStat = ctrlSaisies(($_POST['libStat']));
            $idStat = ctrlSaisies(($_POST['id']));
            $StatutLenght = strlen($libStat);

            if ($StatutLenght <= 60) {
                $monStatut->update($idStat, $libStat);

                header("Location: ./statut.php");
            } else {
                $erreur = true;
                $errSaisies = "Erreur, le libellé est trop long.";
            }
        }      // Fin if ((isset($_POST['libStat'])) ...
        else { // Saisies invalides
            $erreur = true;
            $errSaisies =  "Erreur, la saisie est obligatoire !";
        }  

    } // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
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
        <h2>Modification d'un statut</h2>

        <?php
        if (isset($_GET['id'])) {
            $id=$_GET['id'];
            $req = $monStatut->get_1Statut($id);
            $libStat = $req['libStat'];
            $id = $req['idStat'];
        }
        ?>
        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

            <fieldset>
                <legend class="legend1">Formulaire Statut...</legend>

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
