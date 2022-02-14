<?php
////////////////////////////////////////////////////////////
//
//  CRUD COMMENT (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : deleteComment.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Del logique du Comment
//
// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Comment

// Instanciation de la classe Comment


// Gestion des erreurs de saisie
$erreur = false;

// Init variables form
include __DIR__ . '/initComment.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {




    // create / update effective du comment








}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")
