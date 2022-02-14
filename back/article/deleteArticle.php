<?php
////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié : 10 Juillet 2021
//
//  Script  : deleteArticle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Init constantes
include __DIR__ . '/initConst.php';
// Init variables
include __DIR__ . '/initVar.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Article

// Instanciation de la classe Article


// Ctrl CIR
// Insertion classe MotCleArticle

// Instanciation de la classe MotCleArticle


// Insertion classe MotCle

// Instanciation de la classe MotCle



// Gestion des erreurs de saisie
$erreur = false;
// dossier images
$targetDir = TARGET;

// init mots cles

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {



    // controle CIR

    // delete effective du article










}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initArticle.php';
// En dur
$urlPhotArt = "../uploads/imgArt2dd0b196b8b4e0afb45a748c3eba54ea.png";
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Article</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <link href="../css/style.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Article</h1>
    <h2>Suppression d'un article</h2>

<?php
    // Supp : récup id à supprimer
    // id passé en GET





?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Article...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<?= $libTitrArt; ?>" tabindex="10" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreArt" id="dtCreArt" value="<?= $dtCreArt; ?>" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libChapoArt" id="libChapoArt" rows="10" cols="100" disabled><?= $libChapoArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<?= $libAccrochArt; ?>" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag1Art" id="parag1Art" rows="10" cols="100" disabled><?= $parag1Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b></label>
            <div class="controls">
                <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<?= $libSsTitr1Art; ?>" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag2Art" id="parag2Art" rows="10" cols="100" disabled><?= $parag2Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b></label>
            <div class="controls">
                <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<?= $libSsTitr2Art; ?>" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag3Art" id="parag3Art" rows="10" cols="100" disabled><?= $parag3Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libConclArt" id="libConclArt" rows="10" cols="100" disabled><?= $libConclArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
                <p><b><i>Image associée :&nbsp;&nbsp;<img src="<?= $targetDir . htmlspecialchars($urlPhotArt); ?>" height="183" width="275" /></i></b></p>
            </div>
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Langue -->
        <br>
        <div class="control-group">
          <div class="controls">
            <label class="control-label" for="LibTypLang">
                <b>Quelle langue :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>


            <input type="text" name="idLang" id="idLang" size="5" maxlength="5" value="<?= $numAngl; ?>" autocomplete="on" disabled />

            <!-- Listbox langue => 2ème temps -->

          </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
    <!-- FK : Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Angle live share -->
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypAngl">
                <b>Quel angle :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
            </label>


            <input type="text" name="idAngl" id="idAngl" size="5" maxlength="5" value="<?= $numAngl; ?>" autocomplete="on" disabled />

            <!-- Listbox angle => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Angle -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Thématique -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypThem">
                    <b>Quelle thématique :&nbsp;&nbsp;&nbsp;</b>
                </label>


                <input type="text" name="idThem" id="idThem" size="5" maxlength="5" value="<?= $numThem; ?>" autocomplete="on" disabled />

                <!-- Listbox thematique => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Thématique -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Drag and drop Mot Clé -->
<!-- --------------------------------------------------------------- -->
    <br><br>

    <div class="controls">
        <label class="control-label" for="LibTypMotsCles1">
            <b>Choisissez les mots clés liés à l'article :&nbsp;&nbsp;&nbsp;</b>
        </label>
    </div>
    <!-- A faire dans un 2/3ème temps  -->

<!-- --------------------------------------------------------------- -->
    <!-- FIN Drag and drop Mot Clé -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Fin FK : Angle, Thématique + TJ Mots Clés -->
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
<?php
require_once __DIR__ . '/footerArticle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
