<?php
/* ----------------------------------------------------------------
**
**  Script : regex.php
**  Modifié : 15 févr. 22 - 19h15
**
**  CTRL à partir des expressions régulières :
**    - password 
**    - email
**
** ---------------------------------------------------------------- */

// Pattern sur password
function isPassWord(string $password) {
    /*
    Detail pattern ci-dessus :
        ^  ->  ancré au début de la chaîne
        \S*  ->  n'importe quel ensemble de caractères
        (?=\S{8,15}) ->  d'au moins longueur 8 et au max longueur 15
        (?=\S*[a-z]) ->  contenant au moins une lettre minuscule
        (?=\S*[A-Z]) ->  et au moins une lettre majuscule
        (?=\S*[\d])  ->  et au moins un chiffre
        (?=\S*[\W])  ->  pour inclure car spéciaux (car. non verbaux)
        $  ->  ancré au bout de la corde
     */
    $pattern = "/^\S*(?=\S{8,15})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])(?=\S*[\W])\S*$/";

    return (preg_match ($pattern, $password)) ? true : false;
}

// Pattern sur eMail
function isEmail(string $eMail) {
    $pattern = '/^(([^<>()[\]\\.,;:\s@"\']+(\.[^<>()[\]\\.,;:\s@"\']+)*)|("[^"\']+"))@((\[\d' .
    '{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\])|(([a-zA-Z\d\-]+\.)+[a-zA-Z]{2,}))$/';

    return (preg_match ($pattern, $eMail)) ? true : false;
}

// Pattern sur eMail
function isEmail1(string $eMail) {
    $pattern = "/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/";

    return (preg_match ($pattern, $eMail)) ? true : false;
}
