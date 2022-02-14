<?php
// initVar.php
//
/********************************************
 * Definition des tableaux et variables
 ********************************************/

// Init variables
$extension  = "";
$infosfile = "";
$name = "";
$file = $nomImage = "";

// init état trait image
// Code erreur Upload Image
// = 1 image uploadée OK : l'envoi de l'image a bien été effectué
// = 2 image non uploadée : l'extension n'est pas autorisée
// = 3 image non uploadée : le fichier est trop volumineux
$etatImg = 0;
$msg = '';

// Dossier inexistant par défaut
$target_OK = false;

// Extensions permises
$tabExt = array('jpg','gif','png','jpeg');
$infosImg = array();

// Upload KO par défaut
$uploadOK = false;
