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
        <?php foreach ($chaptersStatus as $chapterStatus): ?>
            <?php
            $chapitre = $chapterStatus['chapitre'];
            $numChapitre = $chapitre->getNumchap();
            $isUnlocked = $chapterStatus['isUnlocked'];
            ?>
            <form method="get" class="chapter-form">
                <input type="hidden" name="ctrl" value="listeHistoire">
                <input type="hidden" name="idChap" value="<?= $numChapitre ?>">
                <?php if ($isUnlocked): ?>
                    <button class="button-gris" type="submit">
                        Chapitre <?= $numChapitre ?>
                    </button>
                <?php else: ?>
                    <button class="bloque button-gris" type="button">
                        Chapitre <?= $numChapitre ?>
                        <img class="img-button" src="./view/design/image/cadenas.png" alt="(Bloqué)">
                    </button>
                    <div class="msgCreateur">Terminer toutes les histoires du chapitre précédent</div>
                <?php endif; ?>
            </form>
        <?php endforeach; ?>

        <form method="get" action="index.php">
            <input type="hidden" name="ctrl" value="listeHistoire">
            <input type="hidden" name="idChap" value="100">
            <button class="button-gris" type="submit">Chapitres des créateurs</button>
        </form>
        <form method="post" action="index.php?ctrl=listeChapitre">
            <input type="hidden" name="reload" value="true">
            <button class="button-bleu" type="submit">Recommencer tout <img class="img-button"
                    src="./view/design/image/recommencer.png" alt="(Recommencer)">
            </button>
        </form>
    </main>
    <?php include_once './view/footer.view.php'; ?>

</body>
<script src="./view/js/dyslexique.js"></script>

</html>