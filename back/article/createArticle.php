 <?php
 
////////////////////////////////////////////////////////////
//
//  CRUD ARTICLE (PDO) - Modifié : 10 Juillet 2021
//
//  Script  : createArticle.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// insert dans TJ motclearticle
// images uploadées sur DD (serveur)

// constante
define('MAX_SIZE', 200000000); 

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaireg
require_once __DIR__ . '/../../util/ctrlSaisies.php';

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

// Gestion des erreurs de saisie
$erreur = false;


// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    } 

    // controle des saisies du formulaire
    if (
      /*  isset($_POST['dtCretArt']) and !empty($_POST['dtCretArt'])
    and*/

    isset($_POST['libTitrArt']) and !empty($_POST['libTitrArt'])
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

        $numAngl = ctrlSaisies($_POST['TypAngl']);
        $numThem = ctrlSaisies($_POST['TypThem']);

    require_once ROOT . '/back/article/ctrlerUploadImage.php';
    $urlPhotArt = $nomImage ; 

        $monArticle->create($dtCreArt, $libTitrArt, $libChapoArt, $libAccrochArt, $parag1Art, $libSsTitr1Art, $parag2Art, $libSsTitr2Art, $parag3Art, $libConclArt, $urlPhotArt, $numAngl, $numThem);


        //header("Location: ./article.php");

    }   // Fin if 
    else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
        echo $errSaisies;
    }   // End of else erreur saisies

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

<?php
require_once ROOT . '/front/includes/commons/___headerFront.php';
?>

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
                        <a href="../likeArt/likeArt.php" class=likeart>Gérer mes like</a>
                    </li>
                    <li class="menu-back-likecom">
                        <a href="../likeCom/likeCom.php" class=likecom>Gérer mes like sur commentaires</a>
                    </li>
                    <li class="menu-back-statut">
                        <a href="../statut/statut.php" class=stat>Gérer mes statuts</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../motCle/MotsCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class =formaulaire>
        <h2>Ajout d'un article</h2>
        <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="chgLang">

        <fieldset>
            <legend class="legend1">Formulaire Article...</legend>

            <input type="hidden" id="id" name="id" value="<?php isset($_GET['id']) ? $_GET['id'] : '' ?>" />

            <div class="control-group">
                <label class="control-label" for="libTitrArt"><b>Titre :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <div class="controls">
                    <input type="text" name="libTitrArt" id="libTitrArt" size="100" maxlength="100" value="<?php if(isset($_GET['id'])){echo $_POST['libTitrArt'];} ?>" tabindex="10" placeholder="Sur 100 car." autofocus="autofocus" />
                </div>
            </div>
            <br>
            <div class="control-group">
                <div class="controls">
                <label class="control-label" for="DtCreA"><b>Date de création :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                    <input type="datetime-local" name="dtCreArt" id="dtCreArt" value="<?php if(isset($_GET['id'])) echo $_POST['dtCreArt']; ?>" tabindex="20" placeholder="" />
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
                    <input type="text" name="libAccrochArt" id="libAccrochArt" size="100" maxlength="100" value="<?php if(isset($_GET['id'])) echo $_POST['libAccrochArt']; else echo $libAccrochArt; ?>" tabindex="40" placeholder="Sur 100 car." />
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
                <label class="control-label" for="libSsTitr1Art"><b>Sous-titre 1 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <div class="controls">
                    <input type="text" name="libSsTitr1Art" id="libSsTitr1Art" size="100" maxlength="100" value="<?php  if(isset($_GET['id'])) echo $_POST['libSsTitr1Art']; else echo $libSsTitr1Art; ?>" tabindex="60" placeholder="Sur 100 car." />
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
                <label class="control-label" for="libSsTitr2Art"><b>Sous-titre 2 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <div class="controls">
                    <input type="text" name="libSsTitr2Art" id="libSsTitr2Art" size="100" maxlength="100" value="<?php if(isset($_GET['id'])) echo $_POST['libSsTitr2Art']; else echo $libSsTitr2Art; ?>" tabindex="80" placeholder="Sur 100 car." />
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
                <label class="control-label" for="LibTypLang" title="Sélectionnez la langue !">
                    <b>Quelle langue :&nbsp;&nbsp;&nbsp;</b>
                </label>

                <!-- Listbox langue => 2ème temps -->

                    <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez la langue !" > 
                    <option value="-1">- - - Choisissez une langue - - -</option>

                <?php
                    $listNumLang = "";
                    $listlib1Lang = "";

                    $result = $maLangue->get_AllLanguesOrderByLib1Lang();
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

    <!-- --------------------------------------------------------------- -->
        <!-- FK : Angle, Thématique + TJ Mots Clés -->
    <!-- --------------------------------------------------------------- -->
    <!-- --------------------------------------------------------------- -->
    <!-- Listbox angle -->
    <br/><br/>
      	  <label><b>&nbsp;&nbsp;&nbsp;Quel angle :&nbsp;&nbsp;</b></label>
		  <div id='' style='display:inline'>
      	    <select size="1" name="etudiant" title="Sélectionnez l'étudiant !" style="padding:2px; border:solid 1px black; color:steelblue; border-radius:5px;">
			  <option value='-1'>- - - Aucun - - -</option>
      	    </select>
      	  </div>
      	  <br /><br /><br />
		</fieldset>
		<br/><br/>
		</form>
  	<h3><a href="./twoListbox.php" title="Réinit du formulaire">Réinit du formulaire</a></h3>
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
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
			var xhr = getXhr();
			// On définit quoi faire quand réponse reçue
			xhr.onreadystatechange = function() {
				// test si tout est reçu et si serveur est ok
				if(xhr.readyState == 4 && xhr.status == 200){
					di = document.getElementById('etudiant');
					di.innerHTML = xhr.responseText;
				}
			}

			// Traitement en POST
			xhr.open("POST","./ajaxEtudiant.php",true);
			// pour le post
			xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
			// poster arguments : ici, numClas
			numClas = document.getElementById('classe').options[document.getElementById('classe').selectedIndex].value;

			// Recup numClas à classe (PK) à passer en "m" à etudiant (FK)
			xhr.send("numClas="+numClas);
		}	// End of function
  </script>
<!-- --------------------------------------------------------------- -->
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
    </div>
</div>
<?php
require_once ROOT . '/front/includes/commons/___footerFront.php';

?>
</body>
</html>