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
require_once __DIR__ . '/../../class_crud/article.class.php';


// Instanciation de la classe Article
$monArticle = new ARTICLE();

// Insertion classe Thematique
require_once __DIR__ . '/../../class_crud/thematique.class.php';
// Instanciation de la classe Thematique
$maThematique = new THEMATIQUE();

// Insertion classe Angle
require_once __DIR__ . '/../../class_crud/angle.class.php';
// Instanciation de la classe Angle
$monAngle = new ANGLE();

// Insertion classe Langue
require_once __DIR__ . '/../../class_crud/langue.class.php';
// Instanciation de la classe Langue
$maLangue = new LANGUE();

// Ctrl CIR
$errCIR = 0;
$errDel=0;

// Insertion classe MotCleArticle
require_once __DIR__ . '/../../class_crud/motclearticle.class.php';
// Instanciation de la classe MotCleArticle
$monMotCleArticle = new MOTCLEARTICLE();

// Insertion classe MotCle
require_once __DIR__ . '/../../class_crud/motcle.class.php';
// Instanciation de la classe MotCle
$monMotCle = new MOTCLE();


// Gestion des erreurs de saisie
$erreur = false;
// dossier images
$targetDir = TARGET;

// init mots cles

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {


    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    }


   if ((isset($_POST['Submit'])) AND ($_POST["Submit"] === "Annuler")) {
       header("Location: ./article.php");
   }
   // Mode création

   elseif (($_POST["Submit"] == "Valider")) {

   
       // Saisies valides
       $erreur = false;
       $numArt = ctrlSaisies($_POST['id']);
       $nbArticle = $monArticle->get_NbAllArticlesByNumAngl($_POST["id"]);
      
       if ($nbArticle < 1) {
        $monArticle->delete($_POST["id"], $FILES);
        header("Location: ./article.php");
    } else {
        header("Location: article.php?errCIR=1");
}
}
if (((isset($_POST["Submit"])) AND ($Submit === "Valider"))) {
    $nbArticle = $monArticle->get_NbAllArticlesByNumThem($_POST["id"]);
    //print_r($nbMembre);
    //print_r($monMembre->get_AllMembersByStat($_POST["id"]));
    if ($nbArticle < 1) {
            $monArticle->delete($_POST["id"]);
            header("Location: ./article.php");
        } else {
            header("Location: article.php?errCIR=1");
        }
}
    
if (isset($_FILES['monfichier']['tmp_name']) AND !empty($_FILES['monfichier']['tmp_name'])) {
    $target_file = $targetDir . $urlPhotArt;
    // Del old image sur serveur
    if(file_exists($delFile)){
        // delete
        unlink("./uploads/" . $urlPhotArt['urlPhotArt']);
        move_uploaded_file($_FILES['monfichier']['tmp_name'], $target_file);
    }
}
    // Traitnemnt : upload image => Chnager image
    require_once ROOT . 'back/article/ctrlerUploadImage.php';
 }

  // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")

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

<section>
    <?php
    require_once ROOT . '/front/includes/commons/___headerFront.php';
    ?>
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
                        <a href="../mot_cle/MotsCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
        
        <div class=formulaire>
 
    <h2>Suppression d'un article</h2>

<?php
    // Supp : récup id à supprimer
    // id passé en GET

    if (isset($_GET['id']) and $_GET['id'] != '') {

        $id= ctrlSaisies($_GET['id']);
        
        $req = $monArticle->get_1Article($id);
        if ($req) {
            $numArt = $req['numArt'];
            $dtCreArt = $req['dtCreArt'];
            $libTitrArt = $req['libTitrArt'];
            $libChapoArt = $req['libChapoArt'];
            $libAccrochArt = $req['libAccrochArt'];
            $parag1Art = $req['parag1Art'];
            $libSsTitr1Art = $req['libSsTitr1Art'];
            $parag2Art = $req['parag2Art'];
            $libSsTitr2Art = $req['libSsTitr2Art'];
            $parag3Art = $req['parag3Art'];
            $libConclArt = $req['libConclArt'];
            $urlPhotArt = $req['urlPhotArt'];
            $numAngl = $req['numAngl'];
            $numThem = $req['numThem'];
            $id = $req['numArt']; 
        }
        $request = $monAngle->get_1Angle($numAngl);
        if ($request) {
            $libAngl = $request['libAngl'];
        }
    
        $request = $maThematique->get_1Thematique($numThem);
        if ($request) {
            $libThem = $request['libThem'];
        }
    }

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
                    <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
                </label>

                <select name="Langue" id="Langue"  class="form-control form-control-create" disabled>
                    <?php
                        $LangByAngle = $monAngle->get_1LangByAngle($numAngl);
                    ?>

                    <option value="<?= ($LangByAngle['numLang']); ?>"> <?= $LangByAngle['lib1Lang']; ?> </option>                

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
                <label class="control-label" for="LibTypAngl" >
                    <b>Quel angle :&nbsp;&nbsp;&nbsp;</b>
                </label>


            <!-- Listbox Angle => 2ème temps -->

                 <input type="hidden" id="idTypAngl" name="idTypAngl" value="<?= $numAngl; ?>" />
                    <select size="1" name="TypAngl" id="TypAngl"  class="form-control form-control-create" title="Sélectionnez l'angle !"disabled > 

                            <option value="<?= $numAngl; ?>">
                                <?php echo $libAngl; ?>
                            </option>

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
                <label class="control-label" for="LibTypThem" >
                    <b>Quelle thematique :&nbsp;&nbsp;&nbsp;</b>
                </label>

            <!-- Listbox Thématique=> 2ème temps -->

            <input type="hidden" id="idTypThem" name="idTypThem" value="<?= $numThem; ?>" />
                <select size="1" name="TypThem" id="TypThem"  class="form-control form-control-create" title="Sélectionnez la thematique !"disabled > 
             
                        <option value="<?= $NumThem; ?>">
                            <?php echo $libThem; ?>
                        </option>
           
    
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
                <input type="Submit" value="Annuler" style="cursor:pointer; border-color: #0e1a27; padding:5px 20px; background-color:#0e1a27" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="Submit" value="Valider" style="cursor:pointer; border-color: #0e1a27; padding:5px 20px; background-color:#0e1a27" name="Submit" />
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
