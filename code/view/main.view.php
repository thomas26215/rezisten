<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Rézisten</title>
    <meta name="author" content="Groupe 11" />
    <link rel="stylesheet" type="text/css" href="./design/main.css">
</head>

<body>
    <main>
        <?php include_once 'headerHistoire.view.php'; ?>

        <div id="maindiv" class="flex-col">
            <img id="logo" src="./design/image/logo.png" alt="Logo">
            <a href="./chapitre.view.php">
                <button class="button-gris" type="submit">Lire les histoires</button>
            </a>
            <a href="./Creation.view.php" class="bloque">
                <button class="button-gris" type="submit">Créer une histoire <img src="./design/image/cadenas.png" alt="(Bloqué)"></button>
                <div class="msgCreateur">Vous devez être créateur pour accéder à cette fonctionnalité : faites une demande sur votre profil</div>
            </a>
            <a href="./mesHistoire.view.php" class="bloque">
                <button class="button-gris" type="submit">Consulter mes histoires <img src="./design/image/cadenas.png" alt="(Bloqué)"></button>
                <div class="msgCreateur">Vous devez être créateur pour accéder à cette fonctionnalité : faites une demande sur votre profil</div>
            </a>
        </div>

    </main>
    <?php include_once 'footer.view.php'; ?>
</body>
    <script src="./js/dyslexique.js"></script>
</html>