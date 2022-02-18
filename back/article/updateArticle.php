<?php
////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié : 10 Juillet 2021
//
//  Script  : updateArticle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// => del + insert dans TJ motclearticle
// => upload image & update path si modif
//
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

require_once __DIR__ . '/../../util/preparerTags.php';

// Init constantes
include __DIR__ . '/initConst.php';
// Init variables
include __DIR__ . '/initVar.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Article
require_once __DIR__ . '/../../CLASS_CRUD/article.class.php';

// Instanciation de la classe Article
$monArticle = new ARTICLE();

// Insertion classe Thematique
require_once __DIR__ . '/../../CLASS_CRUD/thematique.class.php';
// Instanciation de la classe Thematique
$maThematique = new THEMATIQUE();

// Insertion classe Angle
require_once __DIR__ . '/../../CLASS_CRUD/angle.class.php';
// Instanciation de la classe Angle
$monAngle = new ANGLE();

// Insertion classe Langue
require_once __DIR__ . '/../../CLASS_CRUD/langue.class.php';
// Instanciation de la classe Langue
$maLangue = new LANGUE();

// Insertion classe MotCleArticle
require_once __DIR__ . '/../../CLASS_CRUD/motclearticle.class.php';
// Instanciation de la classe MotCleArticle
$monMotCleArticle = new MOTCLEARTICLE();

// Insertion classe MotCle
require_once __DIR__ . '/../../CLASS_CRUD/motcle.class.php';
// Instanciation de la classe MotCle
$monMotCle = new MOTCLE();

// Gestion des erreurs de saisie
$erreur = false;
// dossier images
$targetDir = TARGET;

// init mots cles

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

/************************************************************
 * Script d'upload
 *************************************************************/

/*-- --------------------------------------------------------------- --*/
// Recuperation extension fichier
$extension  = pathinfo($_FILES['monfichier']['name'], PATHINFO_EXTENSION);

// verif extension fichier
if (in_array(strtolower($extension), $tabExt)) {
  // recup dimensions fichier
  $infosImg = getimagesize($_FILES['monfichier']['tmp_name']);

  // verif type image
  if ($infosImg[2] >= 1 AND $infosImg[2] <= 14) {
    // verif dimensions et taille image
    if (($infosImg[0] <= WIDTH_MAX) AND ($infosImg[1] <= HEIGHT_MAX) AND
        (filesize($_FILES['monfichier']['tmp_name']) <= MAX_SIZE)) {
      // Parcours tableau erreurs
      if (isset($_FILES['monfichier']['error']) AND
         UPLOAD_ERR_OK === $_FILES['monfichier']['error']) { // Vérif typage
        // rename fichier
        $nomImage = 'imgArt' . md5(uniqid()) . '.' . $extension;

        if (move_uploaded_file($_FILES['monfichier']['tmp_name'], TARGET.$nomImage)) {
            // upload OK
            $etatImg = 1;
            $uploadOK = true;
        } else {
            // erreur systeme
            $etatImg = 2;
        }
      } else {
          // erreur interne
          $etatImg = 3;
      }
    } else {
        // erreur dimensions et taille image
        $etatImg = 4;
    }
  } else {
      // erreur type image
      $etatImg = 5;
  }
} else {
  // erreur pour l'extension
  $etatImg = 6;
}
/*-- --------------------------------------------------------------- --*/
    switch ($etatImg) {
        // Si OK, test upload
        case 1:
            $msg = "<p>Upload d'une image sur le serveur :<br>";
            $msg .= "<font color='green'>&nbsp;&nbsp;=>>&nbsp;&nbsp;L'envoi de l'image a bien été effectué !</font><br /></p>";
          break;
        case 2:
             // Sinon affiche erreur systeme
            $msg = "<p>Upload d'une image sur le serveur :<br>";
            $msg .= "<font color='red'>&nbsp;&nbsp;=>>&nbsp;&nbsp;Erreur systeme. Problème lors de l'upload !</font></p>";
          break;
        case 3:
            $msg = "<p>Upload d'une image sur le serveur :<br>";
            $msg .= "<font color='red'>&nbsp;&nbsp;=>>&nbsp;&nbsp;Upload de l'image impossible : erreur interne !</font></p>";
          break;
        case 4:
            $msg = "<p>Upload d'une image sur le serveur :<br>";
            $msg .= "<font color='red'>&nbsp;&nbsp;=>>&nbsp;&nbsp;Erreur dimensions : ";
            $msg .= "Le fichier est trop volumineux :<br />";
            $msg .= "<b>(Poids limité à 2Go) !</b></font></p>";
          break;
        case 5:
            $msg = "<p>Upload d'une image sur le serveur :<br>";
            $msg .= '<font color="red">&nbsp;&nbsp;=>>&nbsp;&nbsp;Upload de l\'image impossible : Le fichier n\'est pas une image !</font></p>';
          break;
        case 6:
            $msg = "<p>Upload d'une image sur le serveur :<br>";
            $msg .= "<font color='red'>&nbsp;&nbsp;=>>&nbsp;&nbsp;L'extension du fichier n'est pas autorisée. <br /></font>";
            $msg .= "<font color='red'>(Seuls les fichiers jpg, jpeg, gif, png sont acceptés.)</font></p>";
          break;
        default:
            $msg = '<p><font color="red">&nbsp;&nbsp;=>>&nbsp;&nbsp;Problème lors de l\'upload ! Contactez l\'administrateur.</font> </p>';
            break;
    }
/*-- --------------------------------------------------------------- --*/


    // controle des saisies du formulaire
    if (isset($_POST['numArt']) AND !empty($_POST['numArt'])
    AND isset($_POST['dtCreArt']) AND !empty($_POST['dtCreArt'])
    AND isset($_POST['libTitrArt']) AND !empty($_POST['libTitrArt'])
    AND isset($_POST['libChapoArt']) AND !empty($_POST['libChapoArt'])
    AND isset($_POST['libAccrochArt']) AND !empty($_POST['libAccrochArt'])
    AND isset($_POST['parag1Art']) AND !empty($_POST['parag1Art'])
    AND isset($_POST['libSsTitr1Art']) AND !empty($_POST['libSsTitr1Art'])
    AND isset($_POST['parag2Art']) AND !empty($_POST['parag2Art'])
    AND isset($_POST['libSsTitr2Art']) AND !empty($_POST['libSsTitr2Art'])
    AND isset($_POST['parag3Art']) AND !empty($_POST['parag3Art'])
    AND isset($_POST['libConclArt']) AND !empty($_POST['libConclArt'])
    AND isset($_POST['urlPhotArt']) AND !empty($_POST['urlPhotArt'])
    AND isset($_POST['numAngl']) AND !empty($_POST['numAngl'])
    AND isset($_POST['numThem']) AND !empty($_POST['numThem'])
    AND !empty($_POST['Submit']) AND $Submit === "Valider") {

        $erreur = false;
        $dtCreArt = ctrlSaisies($_POST['dtCreArt']);
        $libTitrArt = ctrlSaisies($_POST['libTitrArt']);
        $libChapoArt = ctrlSaisies($_POST['libChapoArt']);
        $libAccrochArt = ctrlSaisies($_POST['libAccrochArt']);
        $parag1Art = ctrlSaisies($_POST['parag1Art']);
        $libSsTitr1Art = ctrlSaisies($_POST['libSsTitr1Art']);
        $parag2Art = ctrlSaisies($_POST['parag2Art']);
        $libSsTitr2Art = ctrlSaisies($_POST['libSsTitr2Art']);
        $parag3Art = ctrlSaisies($_POST['parag3Art']);
        $libConclArt = ctrlSaisies($_POST['libConclArt']);
        $urlPhotArt = ctrlSaisies($_POST['urlPhotArt']);
        $numAngl = ctrlSaisies($_POST['numAngl']);
        $numThem = ctrlSaisies($_POST['numThem']);
    

        $numNextArt = $monArticle->getNextNumArt($numLang);

        $monArticle->update($numNextArt, $dtCreAr, $libTitrArt,$libChapoArt, $libAccrochArt,  $parag1Art, $libSsTitr1Art, $parag2Art,$libSsTitr2Art,$parag3Art,$libConclArt,$urlPhotArt,$numAngl,$numThem);

        header("Location: ./article.php");
    }   // Fin if 
   
    // modification effective du article



    // Gestion des erreurs => msg si saisies ko
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
        echo $errSaisies;
    }   // End of else erreur saisies

    // Traitnemnt : upload image => Chnager image
    // Nom image à la volée





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
<!--     <script src="./script_global.js"></script> -->
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body>
    <h1>BLOGART22 Admin - CRUD Article</h1>
    <h2>Modification d'un article</h2>
<?php
    // Modif : récup id à modifier
    // id passé en GET


    if (isset($_GET['id'])) {
        //ajouter ctrl saisies ici

        $id=$_GET['id'];
        $req = $monAngle->get_1Angle($id);
        if ($req) {
            $numArt = $req['numArt'];
            $dtCreArt = $req['dtCreArt'];
            $libTitrArt = $req['libTitrArt'];
            $libChapoArt = $req['libChapoArt'];
            $libAccrochArt = $req['libAccrochArt'];
            $parag1Art = $req['parag1Art'];
            $libSsTitr1Art = $req['ibSsTitr1Art'];
            $parag2Art = $req['parag2Art'];
            $libSsTitr2Art = $req['ibSsTitr2Art'];
            $parag3Art = $req['parag3Art'];
            $libConclArt = $req['libConclArt'];
            $urlPhotArt = $req['urlPhotArt'];
            $numAngl = $req['numAngl'];
            $numThem = $req['numThem'];
            $id = $req['numArt'];   
        }
    }

?>
    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="chgLang">

    <fieldset>
        <legend class="legend1">Formulaire Article...</legend>

        <input type="hidden" id="id" name="id" value="<?php isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<?php $libTitrArt; ?>" tabindex="10" placeholder="Sur 100 car." autofocus="autofocus" />
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreArt" id="dtCreArt" value="<?php  $dtCreArt; ?>" tabindex="20" placeholder="" disabled />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libChapoArt" id="libChapoArt" rows="10" cols="100" tabindex="30" placeholder="Décrivez le chapeau. Sur 500 car." ><?php $libChapoArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<?php $libAccrochArt; ?>" tabindex="40" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag1Art" id="parag1Art" rows="10" cols="100" tabindex="50" placeholder="Décrivez le premier paragraphe. Sur 1200 car." ><?php $parag1Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<?php $libSsTitr1Art; ?>" tabindex="60" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag2Art" id="parag2Art" rows="10" cols="100" tabindex="70" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car." ><?php $parag2Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<?php $libSsTitr2Art; ?>" tabindex="80" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag3Art" id="parag3Art" rows="10" cols="100" tabindex="90" placeholder="Décrivez le troisième paragraphe. Sur 1200 car." ><?php $parag3Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libConclArt" id="libConclArt" rows="10" cols="100" tabindex="100" placeholder="Décrivez la conclusion. Sur 800 car." ><?php $libConclArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="urlPhotArt"><b>Importez l'illustration :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="hidden" name="MAX_FILE_SIZE" id="MAX_FILE_SIZE" value="<?php MAX_SIZE; ?>" />
                <input type="file" name="monfichier" id="monfichier" required="required" accept=".jpg,.gif,.png,.jpeg" size="70" maxlength="70" value="<?php "$urlPhotArt"; ?>" tabindex="110" placeholder="Sur 70 car." title="Recherchez l'image à uploader !" />
                <p>
<?php              // Gestion extension images acceptées
                  $msgImagesOK = "&nbsp;&nbsp;>> Extension des images acceptées : .jpg, .gif, .png, .jpeg" . "<br>" .
                    "(lageur, hauteur, taille max : 80000px, 80000px, 200 000 Go)";
                  echo "<i>" . $msgImagesOK . "</i>";
?>
                </p>
                <p><b><i>Image actuelle :&nbsp;&nbsp;<img src="<?php $targetDir . htmlspecialchars($urlPhotArt); ?>" height="183" width="275" /></i></b></p>

            </div>
        </div>
        <br>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Langue -->
 <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypLang" title="Sélectionnez la langue !">
                <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
            </label>

            <!-- Listbox langue => 2ème temps -->

            <input type="hidden" id="idTypLang" name="idTypLang" value="<?= $numLang; ?>" />
                <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez la langue !" > 
                <option value="-1">- - - Choisissez une langue - - -</option>

            <?php
                $listNumLang = "";
                $listlib1Lang = "";

                $result = $maLangue->get_AllLanguesByLib1Lang();
                if($result){
                    foreach($result as $row) {
                        $listNumLang= $row["numLang"];
                        $listlib1Lang = $row["lib1Lang"];
            ?>
                        <option value="<?= $listNumLang; ?>">
                            <?= $listlib1Lang; ?>
                        </option>
            <?php
                    } // End of foreach
                }   // if ($result)
            ?>

            </select>

            </div>
        </div>
            
    <!-- FIN Listbox langue-->
<!-- --------------------------------------------------------------- -->

<!-- --------------------------------------------------------------- -->
    <!-- FK : Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox Angle -->
    <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypAngl" title="Sélectionnez l'angle !">
                <b>Quel angle :&nbsp;&nbsp;&nbsp;</b>
            </label>

            <!-- Listbox Angle => 2ème temps -->

            <input type="hidden" id="idTypAngl" name="idTypAngl" value="<?= $numAngl; ?>" />
                <select size="1" name="TypAngl" id="TypAngl"  class="form-control form-control-create" title="Sélectionnez l'angle !" > 
                <option value="-1">- - - Choisissez un angle - - -</option>

            <?php
                $listNumAngl = "";
                $listlibAngl = "";

                $result = $monAngle-> get_AllAnglesByLibAngl();
                if($result){
                    foreach($result as $row) {
                        $listNumAngl= $row["numAngl"];
                        $listlibAngl = $row["libAngl"];
            ?>
                        <option value="<?= $listNumAngl; ?>">
                            <?= $listlibAngl; ?>
                        </option>
            <?php
                    } // End of foreach
                }   // if ($result)
            ?>

            </select>

            </div>
        </div>
    <!-- FIN Listbox Angle -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
     <!-- Listbox Thématique -->
     <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="LibTypThem" title="Sélectionnez la thematique !">
                <b>Quelle thematique :&nbsp;&nbsp;&nbsp;</b>
            </label>

            <!-- Listbox Thématique=> 2ème temps -->

            <input type="hidden" id="idTypThem" name="idTypThem" value="<?= $numThem; ?>" />
                <select size="1" name="TypThem" id="TypThem"  class="form-control form-control-create" title="Sélectionnez la thematique !" > 
                <option value="-1">- - - Choisissez une thematique - - -</option>

            <?php
                $listNumThem = "";
                $listlibThem = "";

                $result = $maThematique->get_AllThematiquesByLibThem ();
                if($result){
                    foreach($result as $row) {
                        $listNumThem= $row["numThem"];
                        $listlibThem = $row["libThem"];
            ?>
                        <option value="<?= $listNumThem; ?>">
                            <?= $listlibThem; ?>
                        </option>
            <?php
                    } // End of foreach
                }   // if ($result)
            ?>

            </select>

            </div>
        </div>
            
    <!-- FIN Listbox Thematique-->
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
