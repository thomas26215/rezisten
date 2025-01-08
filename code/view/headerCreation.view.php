<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rézisten</title>
    <link rel="stylesheet" href="./design/global.css">
    <link rel="stylesheet" href="./design/headerCreation.css">
</head>

<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">

        <h1>Création d'histoire</h1>

        <section class="container">
            <section class="header">
                <div>
                    <label for="titre">Titre : </label>
                    <input type="text" id="objet" name="objet" value="" required placeholder="Sabotage">
                </div>

                <div>
                    <label for="lieux">Lieux : </label>
                    <select name="example">
                        <option value="A">Prison</option><!-- mettre un foreache -->
                        <option value="B">Cimetiere</option>
                        <option value="-">Camps de concentration</option>
                    </select>
                    <a href="./consulterLieu.view.php"><img src="./design/image/info.png" alt="informations"
                            id="info"></a>
                </div>

                <div>
                    <label for="personnages">Personnages :</label>
                    <a href="./login.view.php"><button class=button-gris>Consulter les personnages</button></a>
                </div>

            </section>

            <section class="menu">
                <a href="./ajouterDialogue.view.php"><button>Ajouter un dialogue</button></a>
                <a href="./ajouterQuestion.view.php"><button class=button-gris>Ajouter une question</button></a>
                <a href="./afficherHistoire.view.php"><button class=button-gris>Afficher toute l'histoire</button></a>
            </section>

            <?php
            /* CHANGER EN FONCTION DE CONTROLEUR */
            include_once 'ajouterDialogue.view.php'; 
            ?>

            <section class="footer">
                <a href="./ajouterDialogue.view.php"><button class=button-rouge>Quitter</button></a>
                <a href="./ajouterQuestion.view.php"><button>Sauvegarder</button></a>

                <a href="./afficherHistoire.view.php"><button class=button-vert>Publier</button></a>
            </section>
        </section>
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