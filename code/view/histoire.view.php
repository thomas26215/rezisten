<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <title>Rézisten</title>
    <meta name="author" content="Brayan" />
    <link rel="stylesheet" type="text/css" href="./design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./design/global.css">
</head>

<body>

    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">
        <h1>$Chapitre 1 : Histoire 2 : Sabotage</h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="./design/image/image_test.png" alt="Fond">
            <div class="personnages">
                <img class="parle" src="./design/image/milicien.png" alt="milicien">
                <img class="parle-pas" src="./design/image/resistant.png" alt="resistant">
            </div>
        </article>

        <article>

            <section> <!-- Pour la zone de texte -->

                <h2 class="speaker"> $Name1 </h2>

                <p class="text"> En chantier, je m'appelle teuse. Et toi ture. Et lui C'est cateur. Et voici le père
                    Sécuteur.
                    Et la Mère Cedes. Il y a aussi le frère Jaques. Et enfin Vibro ma soeur. Et Moi sonnoneuse.</p>
                <div class="flex-row">
                    <button class="before button-gris"> <a href="#">
                            < Précédent </a> </button> <!-- changer les href car je sais pas quoi mettre comme lien -->
                    <button class="next button-gris"> <a href="#"> Suivant > </a> </button>
                </div>


            </section>
        </article>

    </main>

</body>
<script src="./js/dyslexique.js"></script>
<script src="./js/machineAEcrire.js"></script>

</html>