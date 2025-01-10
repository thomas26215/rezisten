<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./view/design/global.css">
    <link rel="stylesheet" href="./view/design/personnages.css">
    <link rel="stylesheet" href="./view/design/popup.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>

    <main class="flex-col">

        <h1>Vos personnages</h1>

        <section class="container">
            <section class="flex-col menu">
                <a href="./consulterPersonnage.view.php"><button class=button-gris>Consulter un personnage</button></a>
                <a href="./ajouterPersonnage.view.php"><button class=button-gris>Ajouter un personnage</button></a>
                <a href="./modifierPersonnage.view.php"><button class=button-gris>Modifier un personnage</button></a>
                <a href="./supprimerPersonnage.view.php"><button>Supprimer un personnage</button></a>
            </section>


            <?php
           /* include_once 'consulterPersonnage.view.php';*/
            include_once 'ajouterPersonnage.view.php';/*
            include_once 'modifierPersonnage.view.php';
            include_once 'supprimerPersonnage.view.php';*/ ?>
            <section class="footer">
                <a href="#"><button id="dialogQuitter" class=button-rouge>Quitter</button></a>
                <a href="./ajouterQuestion.view.php"><button>Sauvegarder</button></a>
            </section>


        </section>
</body>
<script src="./view/js/popup.js"></script>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/photoSelect.js"></script>

</html>