<?php
////////////////////////////////////////////////////////////
//
//  Gestion des CRUD (PDO) - Modifié : 14 Juillet 2021
//
//  Script  : index1.php  -  (ETUD)  BLOGART22
//
////////////////////////////////////////////////////////////

// Mode DEV
require_once __DIR__ . '/connect/config.php';
require_once __DIR__ . '/util/utilErrOn.php';
?>

<link rel="stylesheet" href="<?php echo(ROOTFRONT . '/back/css/style.css');?>">

<?php
require_once ROOT . '/front/includes/commons/___headerFront.php';
?>


<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <title>Gestion des CRUD</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="" />
    <meta name="author" content="" />
</head>

<h1>Cette page est en construction</h1>
<img class=construction src='<?php echo(ROOTFRONT . '/front/assets/images/topage.png');?>' alt='truc'>

<!-- <section class="top-page-index" style="background-image: url('<?php echo(ROOTFRONT . '/front/assets/images/topage.png');?>')">
</section> -->

<style type="text/css">
    background-image: url("<?php echo(ROOTFRONT . '/front/assets/images/topage.png');?>");
    
</style>

<?php
require_once ROOT . '/front/includes/commons/___footerFront.php';
?>

</html>
