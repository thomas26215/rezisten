<!DOCTYPE html>
<html lang="fr">

<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapitre</title>
    <link rel="stylesheet" href="./view/design/chapitre.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>

    <main class="flex-col">
        <h1>Les Chapitres</h1>
        <?php foreach ($chapitres as $chapitre): ?>
            <?php
            $numChapitre = $chapitre->getNumchap();
            $lien = "index.php?idChap=$numChapitre&ctrl=listeHistoire";
            ?>
            <a href="<?= $lien ?>">
                <button class="button-gris" type="submit">
                    Chapitre <?= $numChapitre ?> 
                    <img class="img-button" src="./view/design/image/cadenas.png" alt="(Bloqué)">
                </button>
            </a>

        <?php endforeach; ?>

        <a>
            <button class="button-gris" type="submit">Chapitres des créateurs</button>
        </a>
        <a>
            <button class="button-bleu" type="submit">Recommencer tout <img class="img-button"
                    src="./view/design/image/recommencer.png" alt="(Reload)"> </button>
        </a>
    </main>
    <?php include_once './view/footer.view.php'; ?>

</body>
    <script src="./view/js/dyslexique.js"></script>

</html>