<?php
// images uploadées sur DD (serveur)
//
// Script : ctrlerUploadImage.php
// Init constantes
include __DIR__ . '/initConst.php';

// Init variables
include __DIR__ . '/initVar.php';

/************************************************************
 * Creation dossier cible si inexistant
 *************************************************************/
if (!is_dir(TARGET)) {
    if (!mkdir(TARGET, 0755)) {
      exit("<p><font color='red'>Erreur : création du dossier 'uploads' impossible ! <br>Vérifiez les droits en création ou créer le dossier en amont !</font>");
    } // End of if (!mkdir(TARGET, 0755))
} else {
    $target_OK = true;
}

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
