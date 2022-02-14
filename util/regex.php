<?php
///////////////////////////////////////////////////////
//
//  Script : regex.php
//  Modifié : 28 déc. 21 - 19h15
//
//  CTRL password à partir des expressions régulières
//  CTRL email à partir des expressions régulières
//
///////////////////////////////////////////////////////
/******************************************************
*
*   Le "i" après le délimiteur du pattern indique :
*       => que la recherche est insensible à la casse
*
*   Délimiteur du pattern : /
*   Début de la chaine : ^
*   Fin de la chaine : $
*
*   Caractères autorisés :
*       [-a-z0-9\._-]+
*     - (autant que désirés, de 1 à n) : +
*     - (autant que désirés, de 0 à n) : *
*     - (lettres, chiffres, point, souligné) : [-a-z0-9\._-]
*
*   Nombre de caracteres (2 car mini, 7 car maxi) :
*       {2,7}
*
*   Autres écritures de pattern :
*
*       $pattern = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,7}$#';
*       $pattern = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9-]+\.[a-zA-Z.]{2,7}$/";
*
*******************************************************/

// password
// KO erreur format :
// (preg_match("#\;\,\!\?\*\#\:\%[a-zA-Z0-9_-.]{6,70}#", $pass1Memb))
// OK, valide :
// $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/";
function isPassWord(string $password) {
    // Pattern à appliquer à la chaine $password
    // Password doit comporter des lettres, chiffres et au moins un caractère spécial
    // Password doit avoir 6 caractères au mini et 15 au maxi
    $pattern = "/^(?=.*\d)(?=.*[A-Za-z])(?=.*[!@#$%])[0-9A-Za-z!@#$%]{6,15}$/";

    return (preg_match ($pattern, $password)) ? true : false;
}

// eMail
// (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $eMail1Memb))
function isEmail(string $eMail) {
    // Pattern à appliquer à la chaine $eMail
    $pattern = "/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-z]{6,70}$/i";

    return (preg_match ($pattern, $eMail)) ? true : false;
}
