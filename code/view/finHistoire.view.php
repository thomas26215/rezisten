<?php
$nomLieuEspaceEnPlus = "prison de Montluc";
?><!DOCTYPE html>
<html lang="fr">

<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fin histoire</title>
    <link rel="stylesheet" href="./view/design/finHistoire.css">
    <link rel="stylesheet" href="./view/design/global.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col">
        <h1>Vous avez terminé l’Histoire <?=$story->getId()?> : <?=$story->getTitle()?> !</h1>
        <h2>Voici quelques informations sur le lieu qui vous était présenté : <?=$place->getName()?></h2>
        <p><?=$place->getDescription()?></p>
        <img class="img-milieu" src="./view/design/image/test_lieux.png" alt="">
        <p>Aller visiter le <a href="https://www.google.com/search?client=firefox-b-d&q=<?= $nomLieuEspaceEnPlus ?>"
                target="_blank"><span>lieu</span></a></p>
        <a href="">
            <button>Histoire Suivante -></button>
        </a>
    </main>
</body>
    <script src="./view/js/dyslexique.js"></script>

</html>