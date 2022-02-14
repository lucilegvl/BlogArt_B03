<?php
////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié : 10 Juillet 2021
//
//  Script  : createArticle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// insert dans TJ motclearticle
// upload image & insert path
//
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// Init constantes
include __DIR__ . '/initConst.php';
// Init variables
include __DIR__ . '/initVar.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Article

// Instanciation de la classe Article


// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {




    // controle des saisies du formulaire

    // création effective de l'article



    // Gestion des erreurs => msg si saisies ko



    // Traitnemnt : upload image => Nom image à la volée


}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")
// Init variables form
include __DIR__ . '/initArticle.php';
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
    <h2>Ajout d'un article</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="chgLang">

      <fieldset>
        <legend class="legend1">Formulaire Article...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<? if(isset($_GET['id'])) echo $_POST['libTitrArt']; ?>" tabindex="10" placeholder="Sur 100 car." autofocus="autofocus" />
            </div>
        </div>
        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="datetime-local" name="dtCreArt" id="dtCreArt" value="<? if(isset($_GET['id'])) echo $_POST['dtCreArt']; ?>" tabindex="20" placeholder="" />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libChapoArt" id="libChapoArt" rows="10" cols="100" value="<? if(isset($_GET['id'])) echo $_POST['libChapoArt']; else echo $libChapoArt; ?>" tabindex="30" placeholder="Décrivez le chapeau. Sur 500 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<? if(isset($_GET['id'])) echo $_POST['libAccrochArt']; else echo $libAccrochArt; ?>" tabindex="40" placeholder="Sur 100 car." />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag1Art" id="parag1Art" rows="10" cols="100" value="<? if(isset($_GET['id'])) echo $_POST['parag1Art']; else echo $parag1Art; ?>" tabindex="50" placeholder="Décrivez le premier paragraphe. Sur 1200 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>b></label>
            <div class="controls">
                <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<? if(isset($_GET['id'])) echo $_POST['libSsTitr1Art']; else echo $libSsTitr1Art; ?>" tabindex="60" placeholder="Sur 100 car." />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag2Art" id="parag2Art" rows="10" cols="100" value="<? if(isset($_GET['id'])) echo $_POST['parag2Art']; else echo $parag2Art; ?>" tabindex="70" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>b></label>
            <div class="controls">
                <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<? if(isset($_GET['id'])) echo $_POST['libSsTitr2Art']; else echo $libSsTitr2Art; ?>" tabindex="80" placeholder="Sur 100 car." />
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag3Art" id="parag3Art" rows="10" cols="100" value="<? if(isset($_GET['id'])) echo $_POST['parag3Art']; else echo $parag3Art; ?>" tabindex="90" placeholder="Décrivez le troisième paragraphe. Sur 1200 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libConclArt" id="libConclArt" rows="10" cols="100" value="<? if(isset($_GET['id'])) echo $_POST['libConclArt']; else echo $libConclArt; ?>" tabindex="100" placeholder="Décrivez la conclusion. Sur 800 car." ></textarea>
            </div>
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="urlPhotArt"><b>Importez l'illustration :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="hidden" name="MAX_FILE_SIZE" value="<?= MAX_SIZE; ?>" />
                <input type="file" name="monfichier" id="monfichier" required="required" accept=".jpg,.gif,.png,.jpeg" size="70" maxlength="70" value="<? if(isset($_GET['id'])) echo $_POST['urlPhotArt']; else echo $urlPhotArt; ?>" tabindex="110" placeholder="Sur 70 car." title="Recherchez l'image à uploader !" />
                <p>
<?php              // Gestion extension images acceptées
                  $msgImagesOK = "&nbsp;&nbsp;>> Extension des images acceptées : .jpg, .gif, .png, .jpeg" . "<br>" .
                    "(lageur, hauteur, taille max : 80000px, 80000px, 200 000 Go)";
                  echo "<i>" . $msgImagesOK . "</i>";
?>
                </p>
            </div>
        </div>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Langue -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypLang">
                    <b>Quelle langue :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                </label>



                <input type="text" name="idLang" id="idLang" size="5" maxlength="5" value="<?= $numAngl; ?>" autocomplete="on" />

                <!-- Listbox langue => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Langue -->
<!-- --------------------------------------------------------------- -->
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


                <input type="text" name="idAngl" id="idAngl" size="5" maxlength="5" value="<?= $numAngl; ?>" autocomplete="on" />

                <!-- Listbox angle => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Angle -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Thématique -->
    <!-- Grp 7 -->
        <br>
        <div class="control-group">
            <div class="controls">
                <label class="control-label" for="LibTypThem">
                    <b>Quelle thématique :&nbsp;&nbsp;&nbsp;</b>
                </label>


                <input type="text" name="idThem" id="idThem" size="5" maxlength="5" value="<?= $numThem; ?>" autocomplete="on" />

                <!-- Listbox thematique => 2ème temps -->

            </div>
        </div>
    <!-- FIN Listbox Thématique -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
<!-- Drag and drop sur Mots clés -->
<!-- --------------------------------------------------------------- -->
    <br><br>
    <div class="controls">
        <label class="control-label" for="LibTypMotsCles1">
            <b>Choisissez les mots clés liés à l'article :&nbsp;&nbsp;&nbsp;</b>
        </label>
    </div>
    <!-- A faire dans un 2/3ème temps  -->

<!-- --------------------------------------------------------------- -->
<!-- End of Drag and drop sur Mots clés -->
<!-- --------------------------------------------------------------- -->

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

<!-- --------------------------------------------------------------- -->
    <!-- Début Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

    <!-- A faire dans un 3ème temps  -->

<!-- --------------------------------------------------------------- -->
    <!-- Fin Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

<?php
require_once __DIR__ . '/footerArticle.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
