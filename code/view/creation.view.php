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
                <div>
                    <label for="titre">Titre : </label>
                    <form action="creation" method="get"><input type="text" name="titre" value=<?= $titre ?> required placeholder="Sabotage"></form>
                </div>

                <div>
                    <label for="lieux">Lieux : </label>
                    <select name="example">
                        <?php foreach ($lieux as $lieu) : ?>
                        <option value="A">
                            <?= $lieu?>
                        </option>
                        <?php endforeach; ?>
                    </select>

                    <a href="./consulterLieu.view.php"><img src="./view/design/image/info.png" alt="informations"
                            id="info"></a>
                </div>

                <div>
                    <label for="personnages">Personnages :</label>
                    <a href="./consulterPersonnage.view.php"><button class=button-gris>Consulter les personnages</button></a>
                </div>

            </section>

            <section class="flex-col ">
                <form method=get>
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="article" value="ajouterDialogue">
                    <button class=button-gris>Ajouter un dialogue</button>
                </form>
                <form method=get>
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="article" value="ajouterQuestion">
                    <button class=button-gris>Ajouter une question</button>
                </form>
                <form method=get>
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="article" value="afficherHistoire">
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
                    <input type="hidden" name="ctrl" value="creation">
                    <input type="hidden" name="id" value=<?= $id ?>  >
                    <input type="hidden" name="sauvegarder" value="sauvegarder">
                    <button>Sauvegarder</button>
                </form>

                <form method=get>
                    <input type="hidden" name="ctrl" value="mesHistoires">
                    <input type="hidden" name="footer" value="publie">
                    <button class=button-vert>Publier</button>
                </form>
            </section>
            
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
        document.getElementById('toggleDyslexique').addEventListener('click', function() {
            document.body.classList.toggle('dyslexique');
            // Stockez la préférence dans le localStorage
            localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
        });
    </script>

</html>