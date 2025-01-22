<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vos personnages</title>
    <link rel="stylesheet" href="./view/design/global.css">
    <link rel="stylesheet" href="./view/design/personnages.css">
    <link rel="stylesheet" href="./view/design/popup.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>

    <main class="flex-col">

        <h1>Vos personnages</h1>

        <section class="container flex-col">
            <section class="flex-row menu">
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <input type="hidden" name="article" value="consulterPersonnage">

                    <button id="consulter" class="button-gris">Consulter un personnage</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <input type="hidden" name="article" value="ajouterPersonnage">

                    <button id="ajouter" class="button-gris">Ajouter un personnage</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <input type="hidden" name="article" value="modifierPersonnage">

                    <button id="modifier" class="button-gris">Modifier un personnage</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <input type="hidden" name="article" value="supprimerPersonnage">

                    <button class="button-gris" id="supprimer">Supprimer un personnage</button>
                </form>
            </section>

            <div class="flex-col bottomContainer">
                <?php include_once $lien; ?>
                <form action="index.php?ctrl=creation&id=<?= $id ?>" method="post" class="footer">

                    <button type="button" id="quitterOuvrir" class=button-rouge>
                        Quitter
                    </button>
                    <dialog class="dialog" id="dialogQuitter">
                        <div class="containerDialog">
                            <h2>Voulez vous quitter la page personnages et revenir à création ?</h2>
                            <div>

                                <button type="submit" id="fermerQuitter" name="fermer" class="button-vert">
                                    Quitter
                                </button>
                                <button type="button" id="revenirQuitter" class="button-rouge">
                                    Revenir
                                </button>
                            </div>
                        </div>
                    </dialog>
                </form>
            </div>
        </section>
</body>
<script src="./view/js/popup.js"></script>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/photoSelect.js"></script>
<script src="./view/js/personnages.js"></script>

</html>