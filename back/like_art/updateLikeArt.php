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

<body>
    <h1>BLOGART21 Admin - Gestion du CRUD Like Article</h1>
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
                    <input type="submit" value="Annuler"  name="Submit" />
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Valider"  name="Submit" />
                    <br>
                </div>
            </div>

        </fieldset>
    </form>

<?php
require_once __DIR__ . '/footerLikeArt.php';

require_once __DIR__ . '/../../footer.php';
?>
</body>

</html>