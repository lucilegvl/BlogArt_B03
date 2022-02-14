<?php
///////////////////////////////////////////////////////
//
//  Script : separerTags.php
//  A chaque espace détecté entre 2 mots => 
//  les mettre dans des tags différents
///////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/utilErrOn.php';

function separerTags($tags){

    $nbcar = strlen($tags);
    $formatTags = array();
    $nbMots = 1;  // dans $tags

    for ($i=0; $i < $nbcar; $i++) {
      if ($tags[$i] == ' ') {
        $nbMots++;
      }
    }
    $formatTags = explode(" ", $tags);

    return $formatTags;
}
