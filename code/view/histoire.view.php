<?php
$nom="Michel";
?>
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
    <main>
        <h1>$Chapitre 1 : Histoire 2 : Sabotage</h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="./design/image/image_test.png" alt="Fond">
            <div class="personnages">
                <img class="parle" src="./design/image/milicien.png" alt="milicien">
                <img class="parle-pas" src="./design/image/resistant.png" alt="resistant">
            </div>
        </article>

        <article id="test">
            <section> <!-- Pour la zone de texte -->

                <h2 class="speaker"> <?= $nom ?> </h2>

                <p class="text"> En chantier, je m'appelle teuse. Et toi ture. Et lui C'est cateur. Et voici le père
                    Sécuteur.
                    Et la Mère Cedes. Il y a aussi le frère Jaques. Et enfin Vibro ma soeur. Et Moi sonnoneuse.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Modi harum, numquam repellat voluptate qui fugiat similique quod. Inventore veniam, cupiditate quasi aliquam beatae asperiores provident excepturi. Quasi unde doloremque corrupti.
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Incidunt quasi unde quos at laboriosam doloremque, dicta esse iusto, veniam quod excepturi non fuga a harum corporis, vitae doloribus animi modi.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Eius, maxime rerum? Voluptas, dolore in, autem totam sint deleniti explicabo odit, molestiae modi itaque fugiat nam error ipsa rem libero nihil.
                </p>
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