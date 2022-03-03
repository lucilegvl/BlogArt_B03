<?php
////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateMembre.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';
require_once __DIR__ . '/../../util/regex.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Mise en forme date
require_once __DIR__ . '/../../util/dateChangeFormat.php';

// Insertion classe Membre
require_once __DIR__ . '/../../class_crud/membre.class.php';
// Instanciation de la classe Membre
$monMembre = new MEMBRE();

// Insertion classe Statut
require_once __DIR__ . '/../../class_crud/statut.class.php';
// Instanciation de la classe Statut
$monStatut = new STATUT();

// Gestion des erreurs de saisie
$erreur = false;

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Opérateur ternaire
    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

    if (isset($_POST["Submit"]) AND $Submit === "Initialiser") {
        $sameId=$_POST['id'];
        header("Location: ./updateMembre.php?id=".$sameId);
    }

    if (isset($_POST['prenomMemb']) AND !empty($_POST['prenomMemb'])
        AND isset($_POST['nomMemb']) AND !empty($_POST['nomMemb'])
        AND isset($_POST['pass1Memb']) AND !empty($_POST['pass1Memb'])
        AND isset($_POST['eMail1Memb']) AND !empty($_POST['eMail1Memb'])
        AND !empty($_POST['Submit']) AND $Submit === "Valider") {
        echo 1;
        // Saisies valides
        $erreur = false;

        $prenomMemb = ctrlSaisies($_POST['prenomMemb']);
        $nomMemb = ctrlSaisies($_POST['nomMemb']);
        $pass1Memb = ctrlSaisies($_POST['pass1Memb']);
        $pass2Memb = (isset($_POST['pass2Memb']) AND !empty($_POST['pass2Memb'])) ? ctrlSaisies($_POST['pass2Memb']) : '';
        $eMail1Memb = ctrlSaisies($_POST['eMail1Memb']);
        $eMail2Memb = $eMail2Memb = (isset($_POST['eMail2Memb']) AND !empty($_POST['eMail2Memb'])) ? ctrlSaisies($_POST['eMail2Memb']) : '';
        $idStat = ctrlSaisies($_POST['idStat']);
        $numMemb = ctrlSaisies($_POST['id']);

        // CTRL saisies
        // VALIDITÉ MAIL : Avec la fonction filter_var() ou un regex
        if(filter_var($eMail1Memb, FILTER_VALIDATE_EMAIL)){
            $mail1F1 = 1;    // TRUE
            $msgErrMail1 = "";
        }else{
            $mail1F1 = 0;    // FALSE
            $msgErrMail1 = "&nbsp;&nbsp;- Premier mail invalide<br>";
        }

        //VERIFICATION DEUXIEME MAIL
        if ($eMail2Memb != ''){
            //VERIFICATION fonction regex
            if(filter_var($eMail2Memb, FILTER_VALIDATE_EMAIL)){
                $mail2F1 = 1;    // TRUE
                $msgErrMail2 = "";
            }else{
                $mail2F1 = 0;    // FALSE
                $msgErrMail2 = "&nbsp;&nbsp;- Deuxième mail invalide<br>";
            }

            //VERIFICATION mails identiques
            if($mail1F1 == 1 AND $mail2F1 == 1){
                if($eMail1Memb == $eMail2Memb){
                    $mailIdentiqF1 = 1;
                    $msgErrMailIdentiq = "";
                }else{
                    $mailIdentiqF1 = 0;
                    $msgErrMailIdentiq = "&nbsp;&nbsp;- Vous avez rentré deux mails différents. <br>";
                }
            }
        } else {
            $mail2F1 = 1;
            $mailIdentiqF1 = 1;
            $testEMail2Memb = -1;
            $msgErrMail2 = '';
            $msgErrMailIdentiq = '';
        }

        // ----------------------------------------------------------------
        // PASS VALIDE
        if(isPassWord($pass1Memb)){
            $passValid1F1 = 1;
            $msgErrPassValid1 = "";
            // Cryptage du password
            // cost : meilleur coût algo cryptage (10: defaut)
            // $pass1Memb = password_hash($pass1Memb, PASSWORD_DEFAULT, ['cost' => 15]);
        }else{
            $passValidF1 = 0;
            $msgErrPassValid = "&nbsp;&nbsp;- Votre mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, <br> 
            un caractère spécial, et être compris entre 6 et 15 carcatères.";
        }

        if ($pass2Memb != '') {
            if(isPassWord($pass2Memb)){
                $passValid2F1 = 1;
                $msgErrPassValid2 = "";
                // Cryptage du password
                // cost : meilleur coût algo cryptage (10: defaut)
                // $pass1Memb = password_hash($pass1Memb, PASSWORD_DEFAULT, ['cost' => 15]);
            }else{
                $passValid2F1 = 0;
                $msgErrPassValid2 = "&nbsp;&nbsp;- Votre mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre, <br> 
                un caractère spécial, et être compris entre 6 et 15 carcatères.";
            }

            if($pass1Memb == $pass2Memb){
                $passIdentiqF1 = 1;
                $msgErrPassIdentiq = "";
            }else{
                $passIdentiqF1 = 0;
                $msgErrPassIdentiq = "&nbsp;&nbsp;- Vous avez rentré deux mots de passe différents. <br>";
            }

        } else {
            $passIdentiqF1 = 1;
            $passValid2F1 = 1;
            $testPass2Memb = -1;
            $msgErrPassValid2 = '';
            $msgErrPassIdentiq = '';
        }

        // ----------------------------------------------------------------
        // Ctrl cohérence de tous les différents éléments saisis avant insert
        if($prenomMemb != "" AND $nomMemb != "" 
            AND $mailIdentiqF1 == 1 AND $passIdentiqF1 == 1 AND $passValid1F1 == 1 AND $passValid2F1 == 1 
            AND $mail1F1 == 1 AND $mail2F1 == 1){

            $monMembre->update($numMemb, $prenomMemb, $nomMemb, $pass1Memb, $eMail1Memb, $idStat, $testPass2Memb, $testEMail2Memb);

            header("Location: ./membre.php");
        }else{
            // Saisies invalides
            $erreur = true;
            $errSaisies = "Création impossible, incohérence des données saisies :<br>" . 
            $msgErrMail1 . $msgErrMail2 . $msgErrMailIdentiq . 
            $msgErrPassIdentiq . $msgErrPassValid1 . $msgErrPassValid2;
        }
    }   // Fin if ((isset($_POST['prenomMemb'])) ...
    else{
        // Saisies invalides
        $erreur = true;
        $errSaisies =  "Erreur, la saisie est obligatoire !";
    }   // Fin else erreur saisies

}   // Fin if ($_SERVER["REQUEST_METHOD"] === "POST")
// Init variables form
include __DIR__ . '/initMembre.php';
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Admin - CRUD Membre</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />

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
                        <a href="../mot_cle/motCle.php" class=Mc>Gérer mes mots clés</a>
                    </li>
                    <li class="menu-back-MotsCles">
                        <a href="../thematique/thematique.php" class=them>Gérer mes thématiques</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class=formulaire>   
    <h2>Modification d'un membre</h2>
<?php

    if (isset($_GET['id'])) {

        $id=ctrlSaisies($_GET['id']);
        $req = $monMembre->get_1Membre($id);

        if ($req) {
            $nomMemb = $req['nomMemb'];
            $prenomMemb = $req['prenomMemb']; 
            $pseudoMemb = $req['pseudoMemb'];
            $eMail1Memb = $req['eMailMemb'];
            $pass1Memb = $req['passMemb']; 
            $accordMemb = 1;
            $idStat = $req['idStat'];
            $dtCreaMemb = $req['dtCreaMemb'];
            $numMemb = $req['numMemb'];
        } 
    }

?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Membre...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />

        <div class="control-group">
            <label class="control-label" for="prenomMemb"><b>Prénom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?= $prenomMemb; ?>" autocomplete="on" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?= $nomMemb; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?= $pseudoMemb; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1Memb"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1Memb" id="myInput1" size="80" maxlength="80" value="<?= $pass1Memb; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput1')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass2Memb"><b>Confirmez le mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass2Memb" id="myInput2" size="80" maxlength="80" value="<?= $pass2Memb; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput2')">
            &nbsp;&nbsp;
            <label><i>Afficher mot de passe</i></label>
        </div>
        <small class="error">*Champ obligatoire si nouveau mot de passe</small><br>
        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1Memb"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1Memb" id="eMail1Memb" size="80" maxlength="80" value="<?= $eMail1Memb; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail2Memb"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail2Memb" id="eMail2Memb" size="80" maxlength="80" value="<?= $eMail2Memb; ?>" autocomplete="on" />
        </div>
        <small class="error">*Champ obligatoire si nouveau email</small><br>

        <br>
        <div class="control-group">
            <label class="control-label" for="accordMemb"><b>J'ai accepté que mes données soient conservées :</b></label>
            <div class="controls">
               <fieldset>
                  <input type="radio" name="accordMemb"
                  <?php if($accordMemb == 1) echo 'checked="checked"'; ?>
                  value="on" disabled />&nbsp;&nbsp;Oui&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="radio" name="accordMemb"
                  <?php if($accordMemb == 0) echo 'checked="checked"'; ?>
                  value="off" disabled />&nbsp;&nbsp;Non
               </fieldset>
            </div>
        </div>
        <br><br>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->
        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_GET['idStat']) ? $_GET['idStat'] : '' ?>" />

                <select size="1" name="idStat" id="idStat"  class="form-control form-control-create" title="Sélectionnez un statut." >

                    <?php
                        $listidStat = "";
                        $listlibStat = "";

                        $result = $monStatut->get_AllStatuts();
                        if($result){
                            foreach($result as $row) {
                                $listidStat= $row["idStat"];
                                $listlibStat = $row["libStat"];
                    ?>
                                <option value="<?= $listidStat; ?>"  <?= ((isset($idStat) && $idStat == $listidStat) ? " selected='selected'" : null); ?>>
                                    <?= $listlibStat; ?>
                                </option>
                    <?php
                            } // End of foreach
                        }   // if ($result)
                    ?>
                </select>

        </div>
    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
        <br>
        <div class="control-group">
            <label class="control-label" for="dtCreaMemb"><b>Date création :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreaMemb" id="dtCreaMemb" value="<?= $dtCreaMemb; ?>" disabled />
        </div>
        <small>(Pour mémoire)</small><br>

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
