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

                    <button> <a href="#"> < Précédent </a> </button>   <!-- changer les href car je sais pas quoi mettre comme lien -->
                    <button> <a href="#"> Suivant > </a> </button>



                </section>

            </article>
<img src="/users/info/etu-2a/bilsb/SAE/rendus/code/view/design/image/logo.png" alt="Logo">





    </body>