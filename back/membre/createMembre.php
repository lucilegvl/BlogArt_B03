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
require_once __DIR__ . '/../../util/regex.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';
// Del accents sur string
require_once __DIR__ . '/../../util/delAccents.php';

// Insertion classe Membre
require_once __DIR__ . '/../../class_crud/membre.class.php';
// Instanciation de la classe Membre
$monMembre = new MEMBRE();

// Insertion classe Membre
require_once __DIR__ . '/../../class_crud/user.class.php';
// Instanciation de la classe Membre
$monUser = new USER();

// Insertion classe Statut
require_once __DIR__ . '/../../class_crud/statut.class.php';


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

    // Opérateur ternaire
    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

    if (isset($_POST["Submit"]) AND $Submit === "Initialiser") {
        header("Location: ./createMembre.php");
    }

    if (isset($_POST['prenomMemb']) AND !empty($_POST['prenomMemb'])
        AND isset($_POST['nomMemb']) AND !empty($_POST['nomMemb'])
        AND isset($_POST['pseudoMemb']) AND !empty($_POST['pseudoMemb'])
        AND isset($_POST['pass1Memb']) AND !empty($_POST['pass1Memb'])
        AND isset($_POST['pass2Memb']) AND !empty($_POST['pass2Memb'])
        AND isset($_POST['eMail1Memb']) AND !empty($_POST['eMail1Memb'])
        AND isset($_POST['eMail2Memb']) AND !empty($_POST['eMail2Memb'])
        AND isset($_POST['accordMemb']) AND !empty($_POST['accordMemb'])
        AND isset($_POST['idStat']) AND !empty($_POST['idStat']) AND $_POST['idStat'] != -1
        AND !empty($_POST['Submit']) AND $Submit === "Valider") {

        // Saisies valides
        $erreur = false;

        $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
        $nomMemb = ctrlSaisies($_POST['nomMemb']);
        $pseudoMemb = ctrlSaisies($_POST['pseudoMemb']);
        $pseudoLength = strlen($pseudoMemb);
        $pass1Memb = ctrlSaisies($_POST['pass1Memb']);
        $pass2Memb = ctrlSaisies($_POST['pass2Memb']);
        $eMail1Memb = ctrlSaisies($_POST['eMail1Memb']);
        $eMail2Memb = ctrlSaisies($_POST['eMail2Memb']);
        $dtCreaMemb = date("Y-m-d-H-i-s");
        $valAccordMemb = ctrlSaisies($_POST['accordMemb']); // Form
        $accordMemb = ($valAccordMemb == "on") ? 1 : 0; // test avant insert
        $idStat = ctrlSaisies($_POST['idStat']);

        // CTRL saisies
        // PSEUDO
        if($pseudoLength >= 6 AND $pseudoLength <= 70){
            $pseudoF1 = 1;
            $msgErrPseudo = "";
        }else{
            $pseudoF1 = 0;
            $msgErrPseudo = "&nbsp;&nbsp;- Votre pseudo doit être constitué de 6 à 70 caractères. <br>";
        }

        $pseudoExistMemb = $monMembre->get_ExistPseudo($pseudoMemb);
        $pseudoExistUser = $monUser->get_ExistPseudo($pseudoMemb);
        if($pseudoExistMemb == 0 AND $pseudoExistUser == 0){
            $pseudoExistF1 = 1;
            $msgErrExistPseudo = "";
        }else{
            $pseudoExistF1 = 0;
            $msgErrExistPseudo = "&nbsp;&nbsp;- Ce pseudo existe déjà<br>";
        }

        // ----------------------------------------------------------------
        // VALIDITÉ MAIL : Avec la fonction filter_var() ou un regex
        if(filter_var($eMail1Memb, FILTER_VALIDATE_EMAIL)){
            $mail1F1 = 1;    // TRUE
            $msgErrMail1 = "";
        }else{
            $mail1F1 = 0;    // FALSE
            $msgErrMail1 = "&nbsp;&nbsp;- Premier mail invalide<br>";
        }

        if(filter_var($eMail2Memb, FILTER_VALIDATE_EMAIL)){
            $mail2F1 = 1;    // TRUE
            $msgErrMail2 = "";
        }else{
            $mail2F1 = 0;    // FALSE
            $msgErrMail2 = "&nbsp;&nbsp;- Deuxième mail invalide<br>";
        }

        // MAIL IDENTIQUE
        if($mail1F1 == 1 AND $mail2F1 == 1){
            if($eMail1Memb == $eMail2Memb){
                $mailIdentiqF1 = 1;
                $msgErrMailIdentiq = "";
            }else{
                $mailIdentiqF1 = 0;
                $msgErrMailIdentiq = "&nbsp;&nbsp;- Vous avez rentré deux mails différents. <br>";
            }
        }

        //MAIL EXISTANT
        $eMailExistMemb = $monMembre->get_AllMembresByEmail($eMail1Memb);
        $eMailExistUser = $monUser->get_ExistEMail($eMail1Memb);
        if ($eMailExistMemb == 0 AND $eMailExistUser == 0){
            $eMailExistF1 = 1;
            $msgErrExistMail = "";
        }else{
            $eMailExistF1 = 0;
            $msgErrExistmail = "&nbsp;&nbsp;- Cet email est déjà utilisé<br>";
        }

        // ----------------------------------------------------------------
        // PASS VALIDE
        if($pass1Memb == $pass2Memb){
            $passIdentiqF1 = 1;
            $msgErrPassIdentiq = "";
        }else{
            $passIdentiqF1 = 0;
            $msgErrPassIdentiq = "&nbsp;&nbsp;- Vous avez rentré deux mots de passe différents. <br>";
        }

        if(isPassWord($pass1Memb)){
            $passValidF1 = 1;
            $msgErrPassValid = "";
            // Cryptage du password
            // cost : meilleur coût algo cryptage (10: defaut)
            // $pass1Memb = password_hash($pass1Memb, PASSWORD_DEFAULT, ['cost' => 15]);
        }else{
            $passValidF1 = 0;
            $msgErrPassValid = "&nbsp;&nbsp;- Votre mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, <br> 
            un caractère spécial, et être compris entre 6 et 15 carcatères.";
        }

        // ----------------------------------------------------------------
        // ACCORD RGPD
        if($accordMemb == 1){
            $RGPDOk = 1;
            $msgErrRGPDOk = "";
        }else{
            $RGPDOk = 0;
            $msgErrRGPDOk = "&nbsp;&nbsp;- Vous devez accepter la conservation des données pour vous inscrire<br>";
        }

        // ----------------------------------------------------------------
        // Ctrl cohérence de tous les différents éléments saisis avant insert
        if($prenomMemb != "" AND $nomMemb != "" 
            AND $mailIdentiqF1 == 1 AND $eMailExistF1 = 1 AND $passIdentiqF1 == 1 AND $passValidF1 == 1
            AND $pseudoF1 == 1 AND $pseudoExistF1 == 1 AND $RGPDOk == 1){

            $monMembre->create($prenomMemb, $nomMemb, $pseudoMemb, $pass1Memb, $eMail1Memb, $dtCreaMemb, $accordMemb, $idStat);

            header("Location: ./membre.php");
        }else{
            // Saisies invalides
            $erreur = true;
            $errSaisies = "Création impossible, incohérence des données saisies :<br>" . 
            $msgErrExistPseudo . $msgErrPseudo . $msgErrMail1 . $msgErrMail2 . 
            $msgErrMailIdentiq . $msgErrExistMail . $msgErrPassIdentiq . $msgErrPassValid . $msgErrRGPDOk;
        }
    }   // Fin if ((isset($_POST['prenomMemb'])) ...
    else{
        // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
    }   // Fin else erreur saisies
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
                        <a href="../mot_cle/MotsCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
    
    <div class=formulaire>
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

                <select size="1" name="idStat" id="idStat"  class="form-control form-control-create" title="Sélectionnez un statut." >
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
<?php
require_once ROOT . '/front/includes/commons/___footerFront.php';

?>
</body>
</html>
