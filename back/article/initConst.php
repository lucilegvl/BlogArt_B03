<?php
// initConst.php
//
/********************************************
 * Definition des constantes
 ********************************************/
// 1 Go : 1 024 mégaoctets
// 200 000 Go : 204 800 mégaoctets
//
// Constantes

// Dossier cible
define('TARGET', "../../uploads/");

// Parametres max fichier image
define('MAX_SIZE', 200000000);    // Taille en octets
define('WIDTH_MAX', 80000);       // Largeur en pixels
define('HEIGHT_MAX', 80000);      // Hauteur en pixels
