<?php
////////////////////////////////////////////////////////////
//
//  CRUD LIKEART (PDO) - Modifié : 4 Juillet 2021
//
//  Script  : updateLikeArt.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/../../util/utilErrOn.php';

// controle des saisies du formulaire
require_once __DIR__ . '/../../util/ctrlSaisies.php';

// Insertion classe Likeart
include __DIR__ . '/../../CLASS_CRUD/likeArt.class.php';
// Instanciation de la classe Likeart
$monLikeArt= new LIKEART;


// Gestion des erreurs de saisie
$erreur = false;

// Init variables form
include __DIR__ . '/initLikeArt.php';

// Gestion du $_SERVER["REQUEST_METHOD"] => En GET
if ($_SERVER["REQUEST_METHOD"] === "GET") {
    
    if (isset($_GET['id1']) AND !empty($_GET['id1']) 
    AND isset($_GET['id2']) AND !empty($_GET['id2'])) {
   
        // Ctrl saisies form
        $numMemb = ctrlSaisies($_GET['id1']);
        $numArt = ctrlSaisies($_GET['id2']);

        // Insert / update likeart
        $likeA = $monLikeArt->get_1LikeArt($numMemb, $numArt)['likeA'];

        if($likeA == 1){
            $likeA = 0;
        }
        else{
            $likeA = 1;
        }

        $monLikeArt->update($numMemb, $numArt, $likeA);
        header("Location: ./likeArt.php");
        }
        else{
            $erreur = true;
            $errSaisies =  "Erreur lors de l'update!";
        }

            $numMemb = intval(ctrlSaisies($_GET['id1']));
            $numArt = intval(ctrlSaisies($_GET['id2']));

            $likeA = $monLikeArt->get_1LikeArt($numMemb, $numArt)['likeA'];

            if($likeA == 1){
                $likeA = 0;
            }
            else{
                $likeA = 1;
            }

            $monLikeArt->update($numMemb, $numArt, $likeA);
            header("Location: ./likeArt.php");
        }
        else{
            $erreur = true;
            $errSaisies =  "Erreur lors de l'udpate !";
        }









}   // Fin if ($_SERVER["REQUEST_METHOD"] === "GET")
