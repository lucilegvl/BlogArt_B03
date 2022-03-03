<?php
// nom de votre serveur (ou 127.0.0.1)
$hostBD = "localhost";
// nom BD
$nomBD = "BLOGART22";
//$nomBD = "db_mmi_03";

// Serveur
// Avec encodage UTF8
$serverBD = "mysql:dbname=$nomBD;host=$hostBD;charset=utf8";

// nom utilisateur de connexion à la BDD
$userBD = 'root';         // Votre login
//$userBD = 'etummiuser_db_03';         // Votre login
// mot de passe de connexion à la BDD

$passBD = '';         // Votre Pass
//$passBD = 'mmi-etu';         // Votre Pass

define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/BlogArt_B03');
define('ROOTFRONT', "http://" . $_SERVER['SERVER_NAME'] . '/BlogArt_B03');

/*define('ROOT', $_SERVER['DOCUMENT_ROOT'] . '/etu-mmi-03');
define('ROOTFRONT', "http://" . $_SERVER['SERVER_NAME'] . '/etu-mmi-03');*/

