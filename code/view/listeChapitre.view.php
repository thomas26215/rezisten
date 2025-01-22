<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapitre</title>
    <link rel="stylesheet" href="./view/design/chapitre.css">
    <link rel="stylesheet" href="./view/design/popup.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>

    <main class="flex-col">
        <h1>Les Chapitres</h1>
        <form action="index.php">
            <input type="hidden" name="ctrl" value="didacticiel">
            <button class="button-bleu" type="submit">Didacticiel</button>
        </form>
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
        <form method="post" action="index.php">
            <button id="recommencerOuvrir" class="button-bleu" type="button">Recommencer tout <img class="img-button"
                    src="./view/design/image/recommencer.png" alt="(Reload)">
            </button>

            <dialog class="dialog" id="dialogRecommencer">
                <div class="containerDialog">
                    <h2>Voulez vous recommencer vos histoires ?</h2>
                    <div>

                        <button type="submit" id="fermerRecommencer" name="fermer" class="button-vert">
                            Oui
                        </button>
                        <button type="button" id="revenirRecommencer" class="button-rouge">
                            Revenir
                        </button>
                    </div>
                </div>
            </dialog>
        </form></q>
    </main>
    <?php include_once './view/footer.view.php'; ?>

</body>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/listeChapitre.js"></script>

</html>