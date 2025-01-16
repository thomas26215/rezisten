<?php
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./view/design/global.css">
    <link rel="stylesheet" href="./view/design/creation.css">
    <link rel="stylesheet" href="./view/design/popup.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col">

        <h1>Création d'histoire</h1>


        <section class="container">
            <section class="header">

                <form action="creation" method="get" class="formLieu">
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="id" value=<?= $id ?>>
                    <input type="hidden" name="sauvegarder" value="sauvegarder">

                    <div class="inputs flex-col">
                        <label for="titre">Titre : </label>
                        <input id="titre" type="text" name="titre" value="<?= $titre ?>" required
                            placeholder="Sabotage">
                    </div>

                    <div class="inputs flex-col">
                        <label for="lieux">Lieux : </label>
                        <div class="inputsRow">
                            <select id="lieux" name="lieux">
                                <?php foreach ($lieux as $lieu): ?>
                                    <option value="<?= $lieu->getId() ?>" <?= $lieu->getId() == $histoire->getPlace()->getId() ? 'selected' : '' ?>>
                                        <?= $lieu->getName() ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <a href="./consulterLieu.view.php"><img src="./view/design/image/info.png"
                                    alt="informations" id="info"></a>
                        </div>
                    </div>

                    <input type="hidden" name="id_lieu" id="id_lieu" value="">
                    <button>Sauvegarder</button>
                </form>

                <div class="inputs flex-col">
                    <label for="personnages">Personnages :</label>
                    <a href="./index.php?ctrl=personnages&id=<?= $id ?>">
                        <button class="personnage button-gris">Gérer
                            les
                            personnages
                        </button>
                    </a>
                </div>
            </section>

            <div class="containerBox">
                <section class="buttonsContainer">
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="ajouterDialogue">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button id="ajouterDialogue" class=button-gris>Ajouter un dialogue</button>
                    </form>
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="ajouterQuestion">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button id="ajouterQuestion" class=button-gris>Ajouter une question</button>
                    </form>
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="afficherHistoire">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button id="afficherHistoire" class=button-gris>Afficher toute l'histoire</button>
                    </form>
                </section>

                <?php
                include_once $lien;
                ?>


                <section class="footer flex-row">
                    <form method=get>
                        <input type="hidden" name="ctrl" value="mesHistoires">
                        <button class=button-rouge>Quitter</button>
                    </form>



                    <form method="get">
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="footer" value="publie">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <button class="button-vert"><?php if ($histoire->getVisibility() == true): ?>
                                Mettre en privé
                            <?php else: ?>
                                Publier
                            <?php endif ?></button>
                    </form>
                </section>
            </div>



            <?php include_once 'popup.view.php'; ?>
        </section>
        <script src="./js/popup.js"></script>
</body>
<script src="./js/dyslexique.js"></script>

<script>
    // Vérifiez si le mode dyslexique est activé dans le localStorage
    if (localStorage.getItem('dyslexique') === 'true') {
        document.body.classList.add('dyslexique');
    }

    // Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
    document.getElementById('toggleDyslexique').addEventListener('click', function () {
        document.body.classList.toggle('dyslexique');
        // Stockez la préférence dans le localStorage
        localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
    });
</script>
<script>
    // Fonction pour mettre à jour le champ caché
    function updateHiddenField() {
        document.getElementById('id_lieu').value = document.getElementById('lieux').value;
    }

    // Exécuter au chargement de la page
    window.onload = function () {
        updateHiddenField();
        document.getElementById('lieux').addEventListener('change', updateHiddenField);
    };
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var currentUrl = window.location.search;
        var afficher = document.getElementById("afficherHistoire");
        var ajouterD = document.getElementById("ajouterDialogue");
        var ajouterQ = document.getElementById("ajouterQuestion");

        if (currentUrl.includes('article=afficherHistoire')) {
            afficher.classList.remove("button-gris");
        } else if (currentUrl.includes('article=ajouterDialogue')) {
            ajouterD.classList.remove("button-gris");
        } else if (currentUrl.includes('article=ajouterQuestion')) {
            ajouterQ.classList.remove("button-gris");
        }
    });
</script>



</html>