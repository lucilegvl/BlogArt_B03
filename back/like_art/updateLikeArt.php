<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateLikeArt.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likeart
include __DIR__ . '/../../class_crud/likeart.class.php';
// Instanciation de la classe Likeart
$monLikeArt= new LIKEART;


// Gestion des erreurs de saisie
$erreur = false;
$errSaisies='';

// Init variables form
include __DIR__ . '/initLikeArt.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    
    if (isset($_GET['id1']) AND !empty($_GET['id1']) 
    AND isset($_GET['id2']) AND !empty($_GET['id2'])) {
   
        // Ctrl saisies form
        $numMemb = ctrlSaisies($_GET['id1']);
        $numArt = ctrlSaisies($_GET['id2']);

        // Insert / update likeart
        $likeA = $monLikeArt->get_1LikeArt($numMemb, $numArt)['likeA'];

        if($likeA == 1){
            $likeA = 0;
        }
        else{
            $likeA = 1;
        }

        $monLikeArt->update($numMemb, $numArt, $likeA);
        header("Location: ./likeArt.php");
    } else{
        $erreur = true;
        $errSaisies =  "Erreur lors de l'update!";
    }

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8" />
    <title>Admin - Gestion du CRUD Like Article</title>
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
    <h2>Modification d'un like</h2>
    <?php
    if (isset($_GET['id1']) AND isset($_GET['id2'])) {
        
        $numMemb = ctrlSaisies(($_GET['id1']));
        $numArt = ctrlSaisies(($_GET['id2']));

        $req = $monLikeArt->get_1LikeArt($numMemb, $numArt);

        if ($req) {
            $likeA = $req['likeA'];
            $numMemb =  ctrlSaisies(($_GET['id1']));
            $numArt =  ctrlSaisies(($_GET['id2']));
            
        }
    }
    ?>

    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Formulaire Like Article...</legend>

            <input type="hidden" id="id1" name="id1" value="<?php isset($_GET['id1']) ? $_GET['id1'] : '' ?>" />
            <input type="hidden" id="id2" name="id2" value="<?php isset($_GET['id2']) ? $_GET['id2'] : '' ?>" />

            <div class="control-group">
                <label class="control-label" for="numMemb"><b>Quel Membre :&nbsp;</b></label>
                <input type="hidden" id="idTypMemb" name="idTypMemb" value="<?php echo $numMemb?>" />
                <select size="1" name="idMemb" id="idMemb" class="form-control form-control-create" tabindex="30" disabled="disabled">
                    <option value="-1">--- Selectionner un membre ---</option>

                <?php
                global $db;
                $numMemb = "";
                $pseudoMemb = "";

                $queryText = 'SELECT * FROM membre ORDER BY pseudoMemb;';
                $result = $db->query($queryText);
                if ($result) {
                    while ($tuple = $result->fetch()) {
                        $ListNumMemb = $tuple["numMemb"];
                        $ListPseudoMemb = $tuple["pseudoMemb"];
                ?>
                    <option value="<?php ($ListNumMemb); ?>" <?php ((isset($idMemb) && $idMemb == $ListNumMemb) ?  "selected=\"selected\"" : null); ?>>
                        <?php echo $ListPseudoMemb; ?>
                    </option>
                <?php
                    }
                }   
                ?>
                </select>

                <br><br>
                <label class="control-label" for="numArt"><b>Quel Article :&nbsp;</b></label>
                <input type="hidden" id="idTypArt" name="idTypArt" value="<?php echo $numArt;?>" >
                <select size="1" name="idArt" id="idArt" class="form-control form-control-create" tabindex="30" disabled="disabled">
                    <option value="-1">--- Selectionner un Article ---</option>

                <?php
                global $db;
                $numArt = "";
                $libTitrArt = "";

                $queryText = 'SELECT * FROM article ORDER BY libTitrArt;';
                $result = $db->query($queryText);
                if ($result) {
                    while ($tuple = $result->fetch()) {
                        $ListNumArt = $tuple["numArt"];
                        $ListLibTitrArt = $tuple["libTitrArt"];
                ?>
                    <option value="<?php ($ListNumArt); ?>" <?php echo ((isset($idArt) && $idArt == $ListNumArt) ?  "selected=\"selected\"" : null); ?>>
                        <?php echo $ListLibTitrArt; ?>
                    </option>
                <?php
                    } 
                }
                ?>
                </select>
                <br><br>
                <label class="control-label" for=""><b> Voulez vous liker cet article? :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label><br>
                
                <input type="checkbox" name="likeA" id="likeA" <?php echo ($likeA == 1)  ? 'checked="checked" "value="on" ' : 'value="on"' ?> />

            </div>

            <?php
            if ($erreur)
            {
                echo ($errSaisies);
            }
            else {
                $errSaisies= "";
                echo ($errSaisies);
    
            }
            ?>

            <div class="control-group">
                <div class="controls">
                    <br><br>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Annuler"  name="Submit" style="cursor:pointer; padding:5px 20px; background-color:#0e1a27"/>
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