<?php
////////////////////////////////////////////////////////////
//
//  CRUD MEMBRE (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteMembre.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

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

// Insertion classe Comment
require_once __DIR__ . '/../../class_crud/comment.class.php';
// Instanciation de la classe Statut
$monCommentaire = new COMMENT();

// Gestion du $_SERVER["REQUEST_METHOD"] => En POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Opérateur ternaire
    $Submit = isset($_POST['Submit']) ? $_POST['Submit'] : '';

    if (isset($_POST["Submit"]) AND $Submit === "Annuler") {
        header("Location: ./membre.php");
    }

    if ($_POST['Submit'] == 'Valider'){
        $erreur = false;
        $numMemb=$_POST['id'];
        $nbComments = $monCommentaire->get_NbAllCommentsBynumMemb($numMemb);
        if ($nbComments>0){
            $erreur = true;
            $errSaisie = 'Erreur, suppression impossible. <br> Ce membre a posté des commentaires.';
            echo $errSaisie;
        } else {
            $erreur = false;
            $errSaisie = '';
            $monMembre->delete($numMemb);
            header("Location: ./membre.php");
        }
    }

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
</head>
<body>
    <h1>BLOGART22 Admin - CRUD Membre</h1>
    <h2>Suppression d'un membre</h2>
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

        $request = $monStatut->get_1Statut($idStat);
        if ($request) {
            $libStat = $request['libStat'];
        }
    }
    
?>
    <form method="POST" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" accept-charset="UTF-8">

      <fieldset>
        <legend class="legend1">Formulaire Membre...</legend>

        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>" />
        <div class="control-group">
            <label class="control-label" for="prenomMemb"><b>Prénom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="prenomMemb" id="prenomMemb" size="80" maxlength="80" value="<?= $prenomMemb; ?>" disabled />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="nomMemb"><b>Nom :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="nomMemb" id="nomMemb" size="80" maxlength="80" value="<?= $nomMemb; ?>" disabled />
        </div>
        <br>
        <div class="control-group">
            <label class="control-label" for="pseudoMemb"><b>Pseudonyme :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="pseudoMemb" id="pseudoMemb" size="80" maxlength="80" value="<?= $pseudoMemb; ?>" disabled />
        </div>

        <br>
        <div class="control-group">
            <label class="control-label" for="eMail1Memb"><b>eMail :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
            <input type="email" name="eMail1Memb" id="eMail1Memb" size="80" maxlength="80" value="<?= $eMail1Memb; ?>" disabled />
        </div>
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
        <br>

<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
    <!-- Listbox statut -->
        <div class="control-group">
            <label class="control-label" for="LibTypStat"><b>Statut :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></label>
                <input type="hidden" id="idStat" name="idStat" value="<?= $idStat ?>" />

                <select size="1" name="TypStat" id="TypStat"  class="form-control form-control-create" title="Sélectionnez la langue !" >
                    <option value="<?php $idStat; ?>">
                        <?php echo $libStat; ?>
                    </option>
                </select>

        </div>

    <!-- FIN Listbox statut -->
<!-- --------------------------------------------------------------- -->
    <!-- FK : Statut -->
<!-- --------------------------------------------------------------- -->
<!-- --------------------------------------------------------------- -->
        <br>
        <br>
        <div class="control-group">
            <label class="control-label" for="dtCreaMemb"><b>Date création :&nbsp;&nbsp;&nbsp;</b></label>
            <input type="text" name="dtCreaMemb" id="dtCreaMemb" value="<?= $dtCreaMemb; ?>" disabled />
        </div>
        <div class="control-group">
            <div class="controls">
                <br><br>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Annuler" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="Valider" style="cursor:pointer; padding:5px 20px; background-color:lightsteelblue; border:dotted 2px grey; border-radius:5px;" name="Submit" />
                <br>
            </div>
        </div>
      </fieldset>
    </form>
    <br>
    <i><div class="error"><br>=>&nbsp;Attention, une suppression doit respecter les CIR !</div></i>
<?php
require_once __DIR__ . '/footerMembre.php';

require_once __DIR__ . '/footer.php';
?>
</body>
</html>
