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


// Insertion classe Langue 
require_once ROOT . '/class_crud/article.class.php';
// Instanciation de la classe angle
$monArticle = new ARTICLE();
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

<section class="top-page-index" style="background-image: url('<?php echo(ROOTFRONT . '/front/assets/images/topage.png');?>')">
    <div class="top-page-index_content" >
        <h1>Paranormal à Bordeaux</h1>
    </div>
</section>

<section class="presentation">
    <p>
        Postremo ad id indignitatis est ventum, ut cum peregrini ob formidatam haut ita dudum alimentorum 
        inopiam pellerentur ab urbe praecipites, sectatoribus disciplinarum liberalium inpendio paucis sine 
        respiratione ulla extrusis, tenerentur minimarum adseclae veri, quique id simularun
    </p>
</section>

<section class="lastArticles">
    <h2>Les derniers articles</h2>
    <?php
        $allArticles=$monArticle->get_4DerniersArticles();
        $dernierArticle=$monArticle->get_LastArticlebyDate();
        $i=1;
    ?>

    <a href="/front/includes/commons/article_front.php">
    <?php foreach($dernierArticle as $row) {?>
        <img src='uploads/<?php echo $row['urlPhotArt'] ?>'>
        <h3> <?php echo $row["libTitrArt"] ?> </h3>
        <p> <?php echo $row["dtCreArt"] ?> </p>
        <p> <?php echo $row["libChapoArt"] ?> </p>
        <?php } ?>
    </a>
    
    <?php foreach($allArticles as $ligne) {
        if ($i == 1){
            $image = $ligne['urlPhotArt']; ?> 
        <?php } else { ?>
            <div>
            <?php
            $image=$row['urlPhotArt']; 
            $titre= $row['libTitrArt'];
            $date=$row['dtCreArt'];
            $chapeau=$row['libChapoArt'];
            echo $titre . "<br>" . $date . "<br>";
            ?>
            <img src='uploads/<?php echo $image ?>'>
            <?php
            echo $chapeau . "<br>";
            ?>
            </div>
            <?php } 
        $i = $i+1;
    } 
    ?>

</section>



<?php
require_once ROOT . '/front/includes/commons/___footerFront.php';
?>

</html>
