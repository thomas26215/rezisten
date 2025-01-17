<!DOCTYPE html>
<html lang="fr">

<head>
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
<script>
    /* Pop-up Quitter*/
    const openQuitter = document.getElementById("quitterOuvrir");
    const fermerQuitter = document.getElementById("fermerQuitter");
    const RevenirQuitter = document.getElementById("revenirQuitter");
    const idDialogue = document.getElementById("dialogQuitter");
    //

    /* Ouvir */
    openQuitter.addEventListener("click", () => {
        idDialogue.showModal();
    });
    /* ferme */
    fermerQuitter.addEventListener("click", () => {
        idDialogue.close();
    });
    /* Action + ferme */
    RevenirQuitter.addEventListener("click", () => {
        idDialogue.close();
    });


    document.addEventListener('DOMContentLoaded', function () {
        // Supprimer personnage
        var supprimerOuvrir = document.getElementById('supprimerOuvrir');
        var dialogSupprimer = document.getElementById('dialogSupprimer');
        var fermerSupprimer = document.getElementById('fermerSupprimer');
        var revenirSupprimer = document.getElementById('revenirSupprimer');

        if (supprimerOuvrir && dialogSupprimer && fermerSupprimer && revenirSupprimer) {
            supprimerOuvrir.addEventListener('click', function () {
                dialogSupprimer.showModal();
            });

            fermerSupprimer.addEventListener('click', function () {
                dialogSupprimer.close();
            });

            revenirSupprimer.addEventListener('click', function () {
                dialogSupprimer.close();
            });
        }

        // Ajouter personnage
        var ajouterOuvrir = document.getElementById('ajouterOuvrir');
        var dialogAjouter = document.getElementById('dialogAjouter');
        var fermerAjouter = document.getElementById('fermerAjouter');
        var revenirAjouter = document.getElementById('revenirAjouter');

        if (ajouterOuvrir && dialogAjouter && fermerAjouter && revenirAjouter) {
            ajouterOuvrir.addEventListener('click', function () {
                dialogAjouter.showModal();
            });

            fermerAjouter.addEventListener('click', function () {
                dialogAjouter.close();
            });

            revenirAjouter.addEventListener('click', function () {
                dialogAjouter.close();
            });
        }

        // Modifier personnage
        var modifierOuvrir = document.getElementById('modifierOuvrir');
        var dialogModifier = document.getElementById('dialogModifier');
        var fermerModifier = document.getElementById('fermerModifier');
        var revenirModifier = document.getElementById('revenirModifier');

        if (modifierOuvrir && dialogModifier && fermerModifier && revenirModifier) {
            modifierOuvrir.addEventListener('click', function () {
                dialogModifier.showModal();
            });

            fermerModifier.addEventListener('click', function () {
                dialogModifier.close();
            });

            revenirModifier.addEventListener('click', function () {
                dialogModifier.close();
            });
        }
    });
</script>
<script src="./view/js/popup.js"></script>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/photoSelect.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var currentUrl = window.location.search;
        var supprimer = document.getElementById("supprimer");
        var modifier = document.getElementById("modifier");
        var ajouter = document.getElementById("ajouter");
        var consulter = document.getElementById("consulter");

        if (currentUrl.includes('article=supprimerPersonnage')) {
            supprimer.classList.remove("button-gris");
        } else if (currentUrl.includes('article=modifierPersonnage')) {
            modifier.classList.remove("button-gris");
        } else if (currentUrl.includes('article=ajouterPersonnage')) {
            ajouter.classList.remove("button-gris");
        } else if (currentUrl.includes('article=consulterPersonnage')) {
            consulter.classList.remove("button-gris");
        }
    });
</script>

</html>