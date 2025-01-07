<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>Rézisten</title>
    <meta name="author" content="Brayan" />
    <link rel="stylesheet" type="text/css" href="./design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./design/global.css">
</head>

<body>

    <?php include_once 'headerHistoire.view.php'; ?>

    <h1>Chapitre 1 : Histoire 2 : Sabotage</h1>
    <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


    <article class="image">
        <li>
            <ul> <img src="./design/image/milicien.png" alt="milicien"> </ul> <!-- Affichage des personnages -->
            <ul> <img src="./design/image/resistant.png" alt="resistant"> </ul>
        </li>
    </article>
    <article>

        <section> <!-- Pour la zone de texte -->

            <div>
                <h2 class="speaker"> $Name1 </h2>
            </div>

            <p class="text"> Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                Nam mattis sed est eu efficitur. Fusce vitae congue arcu, et rhoncus magna.
                Suspendisse eget eleifend ante. Suspendisse facilisis, orci egestas molestie interdum,
                odio massa ultrices ligula, eget accumsan justo erat id purus.
                Aliquam interdum tempor magna, eget pharetra nisi cursus id. Nam ut bibendum libero.
                Maecenas fermentum nunc vitae mauris rhoncus volutpat. Praesent eget sagittis nunc. </p>
            <div class="flex-row">
                <button class="before button-gris"> <a href="#">
                        < Précédent </a> </button> <!-- changer les href car je sais pas quoi mettre comme lien -->
                <button class="next button-gris"> <a href="#"> Suivant > </a> </button>
            </div>


        </section>
    </article>

    <img src="./design/image/logo.png" alt="Logo" class="logo">


</body>
<script src="./js/machineAEcrire.js"></script>

</html>