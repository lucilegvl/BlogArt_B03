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
    require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
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

            $monStatut->update($idStat, $libStat);

            header("Location: ./statut.php");
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

    <body>
        <h1>BLOGART22 Admin - CRUD Statut</h1>
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
                        else {
                            $errSaisies = "Données mises à jour";
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
        <?php
        require_once __DIR__ . '/footerStatut.php';

        require_once __DIR__ . '/footer.php';
        ?>
    </body>
</html>
