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


    /* pop-up supprimer */
    //
    const openSupprimer = document.getElementById("supprimerOuvrir");
    const fermerSupprmier = document.getElementById("fermerSupprimer");
    const revenirSupprimer = document.getElementById("revenirSupprimer");
    const idDialogue1 = document.getElementById("dialogSupprimer");
    //
    /* Ouvir */
    openSupprimer.addEventListener("click", () => {
        idDialogue1.showModal();
    });
    /* ferme */
    fermerSupprmier.addEventListener("click", () => {
        idDialogue1.close();
    });
    /* Action + ferme */
    revenirSupprimer.addEventListener("click", () => {
        idDialogue1.close();
    });

    /* pop-up modifier */
    //
    const openModifier = document.getElementById("modifierOuvrir");
    const fermerModifier = document.getElementById("fermerModifier");
    const revenirModifier = document.getElementById("revenirModifier");
    const idDialogue2 = document.getElementById("dialogModifier");
    //
    /* Ouvir */
    openModifier.addEventListener("click", () => {
        console.log("test");
        idDialogue2.showModal();
    });
    /* ferme */
    fermerModifier.addEventListener("click", () => {
        idDialogue2.close();
    });
    /* Action + ferme */
    revenirModifier.addEventListener("click", () => {
        idDialogue2.close();
    });
    /* Pop-up Ajouter*/
    const openAjouter = document.getElementById("ajouterOuvrir");
    const fermerAjouter = document.getElementById("fermerAjouter");
    const RevenirAjouter = document.getElementById("revenirAjouter");
    const idDialogue3 = document.getElementById("dialogAjouter");
    //

    /* Ouvir */
    openAjouter.addEventListener("click", () => {
        idDialogue3.showModal();
    });
    /* ferme */
    fermerAjouter.addEventListener("click", () => {
        idDialogue3.close();
    });
    /* Action + ferme */
    RevenirAjouter.addEventListener("click", () => {
        idDialogue3.close();
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