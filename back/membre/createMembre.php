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

// Instanciation de la classe Membre


// Constantes reCaptcha



// Gestion des erreurs de saisie
$erreur = false;
// init msg erreur



// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {




    // controle des saisies du formulaire

    // création effective du user



    // Gestion des erreurs => msg si saisies ko



        // CTRL saisies
        // PSEUDO : valide, longueur: 6 mini, 70 maxi

        // VALIDITÉ MAIL
        // 1ère mail == valide
        // 2ème mail == valide
        // 2 mails identiques


        // PASS VALIDE
        // majuscules, minuscules, chiffres, car. spéciaux
        // 2 mails identiques

        // ACCORD RGPD



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
            <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<? if(isset($_POST['prenomMemb'])) echo $_POST['prenomMemb']; ?>" autocomplete="on" autofocus="autofocus" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<? if(isset($_POST['nomMemb'])) echo $_POST['nomMemb']; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudonyme<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<? if(isset($_POST['pseudoMemb'])) echo $_POST['pseudoMemb']; ?>" placeholder="6 car. minimum" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass1Memb"><b>Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass1Memb" id="myInput1" size="80" maxlength="80" value="<? if(isset($_POST['pass1Memb'])) echo $_POST['pass1Memb']; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput1')">
            &nbsp;&nbsp;
            <label><i>Afficher Mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="pass2Memb"><b>Confirmez la Mot passe<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="password" name="pass2Memb" id="myInput2" size="80" maxlength="80" value="<? if(isset($_POST['pass2Memb'])) echo $_POST['pass2Memb']; ?>" autocomplete="on" />
            <br>
            <input type="checkbox" onclick="myFunction('myInput2')">
            &nbsp;&nbsp;
            <label><i>Afficher Mot de passe</i></label>
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1Memb"><b>eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1Memb" id="eMail1Memb" size="80" maxlength="80" value="<? if(isset($_POST['eMail1Memb'])) echo $_POST['eMail1Memb']; ?>" autocomplete="on" />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail2Memb"><b>Confirmez l'eMail<span class="error">(*)</span> :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail2Memb" id="eMail2Memb" size="80" maxlength="80" value="<? if(isset($_POST['eMail2Memb'])) echo $_POST['eMail2Memb']; ?>" autocomplete="on" />
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
                <input type="hidden" id="idStat" name="idStat" value="<?= isset($_POST['idStat']) ? $_POST['idStat'] : '' ?>" />

                <input type="text" name="idStat" id="idStat" size="5" maxlength="5" value="<?= $idStat; ?>" autocomplete="on" />

                <!-- Listbox statut => 2ème temps -->

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
