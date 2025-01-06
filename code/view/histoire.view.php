<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Rézisten</title>
        <meta name="author" content="Jean-Pierre Chevallet" />
        <link rel="stylesheet" type="text/css" href="../design/footer.css">
    </head>

    <body>

            <h1>Chapitre 1 : Histoire 2 : Sabotage</h1>  <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->

            <article>
                <li>
                    <ul><?= $Charactere1 ?> <?= $Name1 ?> </ul> <!-- Affichage des personnages avec leurs noms -->
                    <ul><?= $Charactere2 ?> <?= $Name2 ?> </ul>
                </li>

                <section> <!-- Pour la zone de texte -->
                    <h2> <?= $Name1 ?> </h2>

                    <p> <?= $text ?> </p>

                    <button> <a href="#"> < Précédent </a> </button>
                    <button> <a href="#"> Suivant > </a> </button>



                </section>

            </article>






    </body>