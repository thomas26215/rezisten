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

                <form action="creation" method="get" class="flex-row">
                    <div class="flex-row">
                        <label for="titre">Titre : </label>


                        <input  type="hidden" name="ctrl" value="creation">

                        <input id="titre" type="text" name="titre" value="<?= $titre ?>" required placeholder="Sabotage">

                        <input type="hidden" name="id" value=<?= $id ?>>
                        <input type="hidden" name="sauvegarder" value="sauvegarder">

                    </div>

                    <div class="flex-row">
                        <label for="lieux">Lieux : </label>
                        <select id="lieux" name="lieux">
                            <?php foreach ($lieux as $lieu): ?>
                                <option value="<?= $lieu->getId() ?>" <?= $lieu->getId() == $histoire->getPlace()->getId() ? 'selected' : '' ?>>
                                    <?= $lieu->getName() ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <a href="./consulterLieu.view.php"><img src="./view/design/image/info.png" alt="informations"
                                id="info"></a>
                    </div>
                    <input type="hidden" name="id_lieu" id="id_lieu" value="">
                    <button>Sauvegarder</button>
                </form>
                <div>
                    <label for="personnages">Personnages :</label>
                    <a href="./index.php?ctrl=personnages"><button class=button-gris>Consulter les
                            personnages</button></a>
                </div>

            </section>

            <div class="containerBox">
                <section class="flex-col ">
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="ajouterDialogue">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button class=button-gris>Ajouter un dialogue</button>
                    </form>
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="ajouterQuestion">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button class=button-gris>Ajouter une question</button>
                    </form>
                    <form method=get>
                        <input type="hidden" name="ctrl" value="creation">
                        <input type="hidden" name="article" value="afficherHistoire">
                        <input type="hidden" name="id" value=<?= $id ?>>
                        <button class=button-gris>Afficher toute l'histoire</button>
                    </form>
                </section>

                <?php
                include_once $lien;
                ?>


                <section class="footer">
                    <form method=get>
                        <input type="hidden" name="ctrl" value="mesHistoires">
                        <button class=button-rouge>Quitter</button>
                    </form>


                    <form method=get>
                        <input type="hidden" name="ctrl" value="mesHistoires">
                        <input type="hidden" name="footer" value="publie">
                        <button class=button-vert>Publier</button>
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



</html>