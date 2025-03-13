<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Histoires</title>
    <link rel="stylesheet" href="./view/design/mesHistoires.css">
    <link rel="stylesheet" href="./view/design/popup.css">

</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>

    <main class="flex-col">
        <h1>Mes Histoires</h1>
        <a href="index.php?ctrl=didacticiel#partie-createur">
            <button class="creer">Didacticiel</button>
        </a>
        <?php if (!empty($publishedStories)): ?>
            <div class="histoires">
                <p class="titres">Sauvegardées :</p>
                <?php foreach ($publishedStories as $story): ?>
                    <div class="container">
                        <p><?= htmlspecialchars($story->getTitle()) ?></p>
                        <div class="flex-row">
                            <a href="index.php?ctrl=creation&id=<?= $story->getId() ?>">
                                <img class="modif" src="./view/design/image/modifier.png" alt="Modifier">
                            </a>
                            <a href="#" class="delete-button" data-story-id="<?= $story->getId() ?>">
                                <img class="poubelle" src="./view/design/image/poubelle.png" alt="Supprimer">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($savedStories)): ?>
            <div class="histoires after">
                <p class="titres">Publiées :</p>
                <?php foreach ($savedStories as $story): ?>
                    <div class="container">
                        <p><?= htmlspecialchars($story->getTitle()) ?></p>
                        <div class="flex-row">
                            <a href="index.php?ctrl=creation&id=<?= $story->getId() ?>">
                                <img class="modif" src="./view/design/image/modifier.png" alt="Modifier">
                            </a>
                            <a href="#" class="delete-button" data-story-id="<?= $story->getId() ?>">
                                <img class="poubelle" src="./view/design/image/poubelle.png" alt="Supprimer">
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (empty($publishedStories) && empty($savedStories)): ?>
            <p>Vous n'avez créé aucune histoire.</p>
        <?php endif; ?>

        <a href="./index.php?ctrl=creation">
            <button class="creer" type="submit">Créer une histoire</button>
        </a>

    </main>
    <?php include_once './view/footer.view.php'; ?>

    <!-- Pop-up de confirmation de suppression -->
    <dialog class="dialog" id="delete-dialog">
        <div class="containerDialog">
            <h2>Voulez vous effacer votre histoire ?</h2>
            <div>
                <button id="confirm-delete" class="button-rouge">
                    Supprimer
                </button>
                <button id="cancel-delete">
                    Annuler
                </button>
            </div>
        </div>
    </dialog>
    <!-- Fin Pop-up de confirmation de suppression -->
    <script src="./view/js/dyslexique.js"></script>
    <script src="./view/js/mesHistoires.js"></script>
</body>

</html>