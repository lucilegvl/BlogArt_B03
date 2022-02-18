<?php
////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : createMembre.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Del accents sur string
require_once __DIR__ . '/../../util/delAccents.php';

// Insertion classe Membre
require_once __DIR__ . '/../../CLASS_CRUD/membre.class.php';
// Instanciation de la classe Membre
$monMembre = new MEMBRE();

// Insertion classe Statut
require_once __DIR__ . '/../../CLASS_CRUD/statut.class.php';
// Instanciation de la classe Statut
$monStatut = new STATUT();

// Constantes reCaptcha


// Gestion des erreurs de saisie
$erreur = false;

// init msg erreur
$errSaisies='';

//Définition du fuseau horaire
date_default_timezone_set('UTC');

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if(isset($_POST['Submit'])){
        $Submit = $_POST['Submit'];
    } else {
        $Submit = "";
    } 
    
    if ((isset($_POST["Submit"])) AND ($Submit === "Initialiser")) {
        header("Location: ./createLangue.php");
    }

    // controle des saisies du formulaire
    $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
    $nomMemb = ctrlSaisies($_POST['nomMemb']);
    $pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
    $pass1Memb = ctrlSaisies($_POST['pass1Memb']);
    $pass2Memb = ctrlSaisies($_POST['pass2Memb']);
    $eMail1Memb = ctrlSaisies($_POST['eMail1Memb']);
    $eMail2Memb = ctrlSaisies($_POST['eMail2Memb']);
    $idStat = ctrlSaisies($_POST['idStat']);

    // VALIDITÉ PSEUDO
        // Disponible ou non
        $NbPseudo = $monMembre->get_ExistPseudo($pseudoMemb);
        if ($NbPseudo>0){
            $PseudoUnique=0;
            $erreur=true;
            $errSaisiePU='Ce pseudo existe déjà. <br>';
            echo $errSaisiePU;
        } else {
            $erreur=false;
            $PseudoUnique=1;
        }

        // Longueur: 6 mini, 70 maxi
        if (preg_match('~^[[:alpha:]]{5,70}$~', $_POST['pseudoMemb'])) {
            $erreur=false;
            $CorrectPseudoSize=1;
        } else{
            $erreur=true;
            $errSaisiesPseudo="Votre pseudo doit être constitué de 6 à 70 caractères. <br>";
            echo $errSaisiesPseudo;
            $CorrectPseudoSize=0;
        }

    // VALIDITÉ MAIL
        // Vérification champs mails

        // 2 mails identiques
        if (strcmp($eMail1Memb, $eMail2Memb)==0) {
            $erreur = false;
            $CorrectMail = 1;
        } else {
            $erreur=true;
            $errSaisiesMail = "Vous avez rentré deux emails différents. <br>";
            echo $errSaisiesMail;
            $CorrectMail = 0;
        }

    // PASS VALIDE
        // majuscules, minuscules, chiffres, car. spéciaux

        // Vérification mdp identiques
        if (strcmp($pass1Memb, $pass2Memb)==0 ) {
            $erreur = false;
            $CorrectMDP = 1;
        } else {
            $erreur=true;
            $errSaisiesMDP = "Vous avez rentré deux mots de passe différents. <br>";
            echo $errSaisiesMDP;
            $CorrectMDP = 0;
        }

    // ACCORD RGPD
    if ($accordMemb='on'){
        $accordRGPD=1;
        $erreur=false;
    } elseif ($accordMemb='off'){
        $accordRGPD=0;
        $erreur=true;
    }
    
    // Saisies valides
    if ($CorrectMail=1 AND $CorrectMDP=1 AND $CorrectPseudoSize=1 AND $PseudoUnique=1 AND $accordMemb=1
    //AND !empty($prenomMemb) AND !empty($nomMemb) AND !empty($pseudoMemb)
    //AND !empty($passMemb) AND !empty($eMailMemb) AND !empty($idStat) 
    AND !empty($_POST['Submit']) AND $Submit === "Valider") { 
        echo "WAW";
        $erreur = false;
        //application méthode create
        $monMembre->create($prenomMemb, $nomMemb, $pseudoMemb, $pass1Memb, $eMail1Memb, $accordRGPD, $listlibStat);
        //header("Location: ./membre.php");
    } else { // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur! Certains champs sont vides ou incorrects. <br>";
        echo $errSaisies;
    }

}   // Fin if ($_SERVER["REQUEST_METHOD"] == "POST")

// Init variables form
include __DIR__ . '/initMembre.php';
?>

<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Membre</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8;" />
    <!-- Responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <!--  Le script reCaptcha : api.js  -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link href="../css/style.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .error {
            padding: 2px;
            border: solid 0px black;
            color: red;
            font-style: italic;
            border-radius: 5px;
        }
    </style>
    <script>
        // Affichage pass
        function myFunction(myInputPass) {
            var x = document.getElementById(myInputPass);
            if (x.type === "password") {
              x.type = "text";
            } else {
              x.type = "password";
            }
        }
    </script>
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Membre</h1>
    <h2>Ajout d'un membre : Inscription</h2>

    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

        <fieldset>
            <legend class="legend1">Formulaire Membre...</legend>

            <input type="hidden" id="id" name="id" value="<?= isset($_POST['id']) ? $_POST['id'] : '' ?>" />

            <div class="control-group">
                <label class="control-label" for="prenomMemb"><b>Prénom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?php echo $prenomMemb; ?>" autocomplete="on" autofocus="autofocus" />
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="nomMemb"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?php echo $nomMemb; ?>" autocomplete="on" />
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="pseudoMemb"><b>Pseudonyme<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?php echo $pseudoMemb; ?>" placeholder="6 car. minimum" autocomplete="on" />
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="pass1Memb"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="password" name="pass1Memb" id="myInput1" size="80" maxlength="80" value="<?php echo $pass1Memb; ?>" autocomplete="on" />
                <br>
                <input type="checkbox" onclick="myFunction('myInput1')">
                &nbsp;&nbsp;
                <label><i>Afficher Mot de passe</i></label>
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="pass2Memb"><b>Confirmez la Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="password" name="pass2Memb" id="myInput2" size="80" maxlength="80" value="<?php echo $pass2Memb; ?>" autocomplete="on" />
                <br>
                <input type="checkbox" onclick="myFunction('myInput2')">
                &nbsp;&nbsp;
                <label><i>Afficher Mot de passe</i></label>
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="eMail1Memb"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="email" name="eMail1Memb" id="eMail1Memb" size="80" maxlength="80" value="<?php echo $eMail1Memb; ?>" autocomplete="on" />
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="eMail2Memb"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="email" name="eMail2Memb" id="eMail2Memb" size="80" maxlength="80" value="<?php echo $eMail2Memb; ?>" autocomplete="on" />
            </div>

            <br>
            <div class="control-group">
                <label class="control-label" for="accordMemb"><b>J'accepte que mes données soient conservées :</b></label>
                <div class="controls">
                    <fieldset>
                        <input type="radio" name="accordMemb"
                        <?= ($accordMemb == "on") ? 'checked="checked"' : ''
                        ?> value="on" />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="accordMemb"
                        <?= ($accordMemb == "off") ? 'checked="checked"' : ''
                        ?> value="off" checked="checked" />&nbsp;&nbsp;Non
                    </fieldset>
                </div>
            </div>
            <i><div class="error"><br>*&nbsp;Champs obligatoires</div></i>

        <!-- --------------------------------------------------------------- -->
        <!-- --------------------------------------------------------------- -->
        <!-- FK : Statut -->
        <!-- --------------------------------------------------------------- -->
        <!-- Listbox statut -->
            <br><br>
            <div class="control-group">
                <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;</b></label>

                <input type="hidden" id="idStat" name="idStat" value="<?php echo $idStat;?>" />    

                <select size="1" name="TypLang" id="TypLang"  class="form-control form-control-create" title="Sélectionnez un statut." >
                    <option value="-1">- - - Choisissez un statut - - -</option>

                    <?php
                        $listidStat = "";
                        $listlibStat = "";

                        $result = $monStatut->get_AllStatuts();
                        if($result){
                            foreach($result as $row) {
                                $listidStat= $row["idStat"];
                                $listlibStat = $row["libStat"];
                    ?>
                                <option value="<?= $listidStat; ?>">
                                    <?= $listlibStat; ?>
                                </option>
                    <?php
                            } // End of foreach
                        }   // if ($result)
                    ?>
                </select>
            </div>
            <br>
        <!-- FIN Listbox statut -->
        <!-- --------------------------------------------------------------- -->
        <!-- FK : Statut -->
        <!-- --------------------------------------------------------------- -->
        <!-- --------------------------------------------------------------- -->
        <!-- -->
            <!--    Captcha Blogart22    -->
            <!-- Type de reCaptcha V2 Case à cocher : OK -->

        <!-- -->
            <div class="control-group">
                <div class="error">
        <?php
                if ($erreur) {
                    echo ($errSaisies);
                }
                else {
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
require_once __DIR__ . '/footerMembre.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
