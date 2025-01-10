<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" type="text/css" href="./view/design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./view/design/global.css">
</head>

<body>

    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">
        <h1>$Chapitre 1 : Histoire 2 : Sabotage</h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="./view/design/image/image_test.png" alt="Fond">
            <div class="personnages">
                <img class="parle" src="./view/design/image/milicien.png" alt="milicien">
                <img class="parle-pas" src="./view/design/image/resistant.png" alt="resistant">
            </div>
        </article>

        <article>

            <section>

                <h2 class="speaker question"> $Type Question </h2>

                <button>Consulter le lieux</button>

                <p class="text"> $TextQuestion En chantier, je m'appelle teuse. Et toi ture. Et lui C'est cateur. Et
                    voici le père
                    Sécuteur.
                    Et la Mère Cedes. Il y a aussi le frère Jaques. Et enfin Vibro ma soeur. Et Moi sonnoneuse.
                </p>


                <div class="flex-row">
                    <label for="reponse">Réponse :</label>
                    <input type="number" name="reponse" id="reponse">
                    <button class="repondre button-vert"> <a href="#">
                            Répondre </a> </button> <!-- changer les href car je sais pas quoi mettre comme lien -->
                    <button class="autreQuestion button-gris"> <a href="#"> Accéder a la question $(simple/Complexe)</a>
                    </button>
                </div>


            </section>
        </article>

    </main>

</body>
<script src="./js/dyslexique.js"></script>
<script src="./js/machineAEcrire.js"></script>

</html>