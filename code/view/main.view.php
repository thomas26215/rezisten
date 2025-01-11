<!DOCTYPE html>
<html lang="fr">

<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <meta charset="utf-8">
    <title>Rézisten</title>
    <meta name="author" content="Groupe 11" />
    <link rel="stylesheet" type="text/css" href="./view/design/main.css">
</head>

<body>
    <main>
        <?php include_once './view/headerHistoire.view.php'; ?>

        <div id="maindiv" class="flex-col">
            <img id="logo" src="./view/design/image/logo.png" alt="Logo">
            <a href="./listeChapitre.view.php?ctrl=listeChapitre">
                <button class="button-gris" type="submit">Lire les histoires</button>
            </a>
            <a href="./Creation.view.php" class="bloque">
                <button class="button-gris" type="submit">Créer une histoire <img src="./view/design/image/cadenas.png" alt="(Bloqué)"></button>
                <div class="msgCreateur">Vous devez être créateur pour accéder à cette fonctionnalité : faites une demande sur votre profil</div>
            </a>
            <a href="./mesHistoire.view.php" class="bloque">
                <button class="button-gris" type="submit">Consulter mes histoires <img src="./view/design/image/cadenas.png" alt="(Bloqué)"></button>
                <div class="msgCreateur">Vous devez être créateur pour accéder à cette fonctionnalité : faites une demande sur votre profil</div>
            </a>
        </div>

    </main>
    <?php include_once './view/footer.view.php'; ?>
</body>
    <script src="./view/js/dyslexique.js"></script>
</html>