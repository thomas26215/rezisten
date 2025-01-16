<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
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
                    <input type="hidden" name="article" value="consulterPersonnage">

                    <button id="consulter" class="button-gris">Consulter un personnage</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="article" value="ajouterPersonnage">

                    <button id="ajouter" class="button-gris">Ajouter un personnage</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="article" value="modifierPersonnage">

                    <button id="modifier" class="button-gris">Modifier un personnage</button>
                </form>
                <form method="get" action="index.php">
                    <input type="hidden" name="ctrl" value="personnages">
                    <input type="hidden" name="article" value="supprimerPersonnage">

                    <button  class="button-gris" id="supprimer">Supprimer un personnage</button>
                </form>
            </section>

            <div class="flex-col">
                <?php include_once $lien; ?>
                <form action="index.php" method="get" class="footer">
                    <button type="submit" name="ctrl" value="creation" id="dialogQuitter" class=button-rouge>Quitter</button>
                </form>
            </div>
        </section>
</body>
<script src="./view/js/popup.js"></script>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/photoSelect.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
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