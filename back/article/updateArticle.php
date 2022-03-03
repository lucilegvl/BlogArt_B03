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
require_once __DIR__ . '/initConst.php';
// Init variables
require_once __DIR__ . '/initVar.php';

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

    // Opérateur ternaire
    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

    if (isset($_POST["Submit"]) AND $Submit === "Initialiser") {
        $sameId=$_POST['id'];
        header("Location: ./updateArticle.php?id=".$sameId);
    }

    // controle des saisies du formulaire
    if (isset($_POST['dtCreArt']) and !empty($_POST['dtCreArt'])
    and isset($_POST['libTitrArt']) and !empty($_POST['libTitrArt'])
    and isset($_POST['libChapoArt']) and !empty($_POST['libChapoArt'])
    and isset($_POST['libAccrochArt']) and !empty($_POST['libAccrochArt'])
    and isset($_POST['parag1Art']) and !empty($_POST['parag1Art'])
    and isset($_POST['libSsTitr1Art']) and !empty($_POST['libSsTitr1Art'])
    and isset($_POST['parag2Art']) and !empty($_POST['parag2Art'])
    and isset($_POST['libSsTitr2Art']) and !empty($_POST['libSsTitr2Art'])
    and isset($_POST['parag3Art']) and !empty($_POST['parag3Art'])
    and isset($_POST['libConclArt']) and !empty($_POST['libConclArt'])
    and isset($_FILES['monfichier']['tmp_name']) and !empty($_FILES['monfichier']['tmp_name'])
    and !empty($_POST['Submit']) and $Submit === "Valider") {

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
        $numAngl = ctrlSaisies($_POST['numAngl']);
        $numThem = ctrlSaisies($_POST['numThem']);
    
if (isset($_FILES['monfichier']['tmp_name']) AND !empty($_FILES['monfichier']['tmp_name'])) {
    $target_file = $targetDir . $urlPhotArt;
    // Del old image sur serveur
    if(file_exists($delFile)){
        // delete
        unlink("./uploads/" . $urlPhotArt['urlPhotArt']);
        move_uploaded_file($_FILES['monfichier']['tmp_name'], $target_file);
    }
    // Traitnemnt : upload image => Chnager image
    require_once ROOT . 'back/article/ctrlerUploadImage.php';

    // Nom image à la volée
    $urlPhotArt = $_FILES['monfichier']['name'] ; 
} else {
    $urlPhotArt = -1;
}
    $monArticle->update($numNextArt, $dtCreArt, $libTitrArt,$libChapoArt, $libAccrochArt,  $parag1Art, $libSsTitr1Art, $parag2Art,$libSsTitr2Art,$parag3Art,$libConclArt,$urlPhotArt,$numAngl,$numThem);

        header("Location: ./article.php");

    }   // Fin if 
   
    // modification effective du article



    // Gestion des erreurs => msg si saisies ko
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
        echo $errSaisies;
    }   // End of else erreur saisies







}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
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
<!--     <script src="./script_global.js"></script> -->
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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
    <h2>Modification d'un article</h2>
<?php
    // Modif : récup id à modifier

    // id passé en GET
    if (isset($_GET['id'])) {
        //ajouter ctrl saisies ici

        $id=$_GET['id'];
        $req = $monArticle->get_1Article ($id);
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
    }

?>
    <form method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="chgLang">

    <fieldset>
        <legend class="legend1">Formulaire Article...</legend>

        <input type="hidden" id="id" name="id" value="<?php isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<?php echo $libTitrArt; ?>" tabindex="10" placeholder="Sur 100 car." autofocus="autofocus" />
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
            <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreArt" id="dtCreArt" value="<?php echo $dtCreArt  ?> "tabindex="20" placeholder="" disabled/>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libChapoArt"><b>Chapeau :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libChapoArt" id="libChapoArt" rows="10" cols="100" tabindex="30" placeholder="?" ><?php echo $libChapoArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libAccrochArt"><b>Accroche paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<?php echo $libAccrochArt; ?>" tabindex="40" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag1Art"><b>Paragraphe 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag1Art" id="parag1Art" rows="10" cols="100" tabindex="50" placeholder="Décrivez le premier paragraphe. Sur 1200 car." ><?php echo $parag1Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<?php echo $libSsTitr1Art; ?>" tabindex="60" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag2Art"><b>Paragraphe 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag2Art" id="parag2Art" rows="10" cols="100" tabindex="70" placeholder="Décrivez le deuxième paragraphe. Sur 1200 car." ><?php echo $parag2Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<?php echo $libSsTitr2Art; ?>" tabindex="80" placeholder="Sur 100 car." />
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="parag3Art"><b>Paragraphe 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="parag3Art" id="parag3Art" rows="10" cols="100" tabindex="90" placeholder="Décrivez le troisième paragraphe. Sur 1200 car." ><?php echo $parag3Art; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="libConclArt"><b>Conclusion :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <div class="controls">
                <textarea name="libConclArt" id="libConclArt" rows="10" cols="100" tabindex="100" placeholder="Décrivez la conclusion. Sur 800 car." ><?php echo $libConclArt; ?></textarea>
            </div>
        </div>

        <br>
        <div class="control-group">
            <div class="controls">
                <p><b><i>Image associée :&nbsp;&nbsp;<img src="<?= $targetDir . htmlspecialchars($urlPhotArt); ?>" height="183" width="275" /></i></b></p>
            </div>
        </div>
        <br>
<!-- Listbox Langue -->
<br>
           <div class="control-group">
               <div class="controls">
               <label class="control-label" for="LibTypLang" title="Sélectionnez la langue !">
                   <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
               </label>
 
               <!-- Listbox langue => 2ème temps -->
 
                <select size="1" name="Langue" id="Langue"  class="form-control form-control-create" title="Sélectionnez la langue !" onchange='change()' >
                <?php
                    $LangByAngle = $monAngle->get_1LangByAngle($numAngl);
                ?>
                   <option value="-1"> <?php  ($LangByAngle ['numLang']);?> <?php echo $LangByAngle['lib1Lang']; ?></option>
 
 
               </select>
 
               </div>
           </div>
              
       <!-- FIN Listbox langue-->
    <!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->

    <!-- --------------------------------------------------------------- -->
        <!-- FK : Angle, Thématique + TJ Mots Clés -->
    <!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->
    <!-- Listbox angle -->
    <br/><br/>
      	  <label><b>&nbsp;&nbsp;&nbsp;Quel angle :&nbsp;&nbsp;</b></label>
		  <div id='TypAngl' style='display:inline'>
      	    <select size="1" name="TypAngl" title="Sélectionnez l'angle !" style="padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;">
			  <option value='-1'>- - - Choissisez l'angle - - -</option>
      	    </select>
      	  </div>
      	  <br /><br /><br />
		</fieldset>
		<br/><br/>
		</form>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
 
<!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->




      <!-- Listbox thematique -->
        <br/><br/>
      	  <label><b>&nbsp;&nbsp;&nbsp;Quel thematique :&nbsp;&nbsp;</b></label>
		  <div id='TypThem' style='display:inline'>
      	    <select size="1" name="TypThem" title="Sélectionnez la thematique !" style="padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;">
			  <option value='-1'>- - - Choissisez une thematique - - -</option>
      	    </select>
      	  </div>
      	  <br /><br /><br />
		</fieldset>
		<br/><br/>
		</form>
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

<!-- --------------------------------------------------------------- -->
    <!-- Début Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

    <!-- A faire dans un 3ème temps  -->

<!-- --------------------------------------------------------------- -->
    <!-- Fin Ajax : Langue => Angle, Thématique + TJ Mots Clés -->
<!-- --------------------------------------------------------------- -->

<?php
require_once ROOT . '/front/includes/commons/___footerFront.php';

?>
<!-- Script JS/AJAX -->
<script type='text/javascript'>
		function getXhr() {
      		var xhr = null;
			if(window.XMLHttpRequest){ // Firefox & autres
			   xhr = new XMLHttpRequest();
			}else
				if(window.ActiveXObject){ // IE / Edge
				   try {
						xhr = new ActiveXObject("Msxml2.XMLHTTP");
				   }catch(e){
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
				   }
				}else{
				   alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
				   xhr = false;
				}
        	return xhr;
		}	// End of function

		/**
		* Méthode appelée sur le click du bouton/listbox
		*/
		function change() {
			var xhrangl = getXhr();
			// On définit quoi faire quand réponse reçue
			xhrangl.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
				if(xhrangl.readyState == 4 && xhrangl.status == 200){
					di = document.getElementById('TypAngl');
					di.innerHTML = xhrangl.responseText;
				}
			}

			// Traitement en POST
			xhrangl.open("POST","./ajaxAngleCreate.php",true);
			// pour le post
			xhrangl.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numLang
			numLang = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;

			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhrangl.send("numLang="+numLang);

//Thematique
            var xhrthem = getXhr();
			// On définit quoi faire quand réponse reçue
			xhrthem.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
				if(xhrthem.readyState == 4 && xhrthem.status == 200){
					di = document.getElementById('TypThem');
					di.innerHTML = xhrthem.responseText;
				}
			}

			// Traitement en POST
			xhrthem.open("POST","./ajaxThematiqueCreate.php",true);
			// pour le post
			xhrthem.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numLang
			numLang = document.getElementById('Langue').options[document.getElementById('Langue').selectedIndex].value;

			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhrthem.send("numLang="+numLang);
		}	// End of function
  </script>
</body>
</html>
