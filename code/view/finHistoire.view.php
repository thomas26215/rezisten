<?php
$nomLieuEspaceEnPlus = "prison de Montluc";
?><!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fin histoire</title>
    <link rel="stylesheet" href="design/finHistoire.css">
    <link rel="stylesheet" href="design/global.css">
</head>

<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">
        <h1>Vous avez terminé l’Histoire</h1>
        <p>$DescriptionLieu ,  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
        <img class="img-milieu" src="./design/image/test_lieux.png" alt="">
        <p>Aller visiter le <a href="https://www.google.com/search?client=firefox-b-d&q=<?= $nomLieuEspaceEnPlus ?>"
                target="_blank"><span>lieu</span></a></p>
        <a href="">
            <button>Histoire Suivante -></button>
        </a>
    </main>
</body>
    <script src="./js/dyslexique.js"></script>

</html>