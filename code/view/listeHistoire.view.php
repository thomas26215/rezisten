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
        <div>
            <h1><?= $nomChap ?></h1>
            <h2>Les Histoires</h2>
        </div>
        <?php foreach ($stories as $storie): ?>
            <form method="get" class="story-form">
                <input type="hidden" name="ctrl" value="histoire">
                <input type="hidden" name="idChap" value="<?= $idChap ?>">
                <input type="hidden" name="idStory" value="<?= $storie->getId() ?>">
                <input type="hidden" name="idDialog" value="1">
                <?php if (isset($progressions[$storie->getId()]) && $progressions[$storie->getId()]->getStatus() == 1): ?>
                    <button class="button-gris" type="submit">
                        <?= $storie->getTitle() ?>
                    </button>
                <?php else: ?>
                    <button class="bloque button-gris" type="button">
                        <?= $storie->getTitle() ?>
                        <img class="img-button" src="./view/design/image/cadenas.png" alt="(Bloqué)">
                    </button>
                    <div class="msgCreateur">Terminer l’histoire précédente</div>
                <?php endif; ?>
            </form>
        <?php endforeach; ?>
    </main>
    <?php include_once './view/footer.view.php'; ?>

</body>
<script src="./view/js/dyslexique.js"></script>

</html>