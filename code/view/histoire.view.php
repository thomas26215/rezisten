
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <title>Rézisten</title>
    <meta name="author" content="Brayan" />
    <link rel="stylesheet" type="text/css" href="./view/design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./view/design/global.css">
</head>

<body>

    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">
        
        <h1>Chapitre <?=$idChap?> : Histoire <?=$idStory?> : Sabotage</h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="./view/design/image/image_test.png" alt="Fond">
            <div class="personnages">
                <img class="parle" src="./view/design/image/milicien.png" alt="milicien">
                <img class="parle-pas" src="./view/design/image/resistant.png" alt="resistant">
            </div>
        </article>

        <article id="test">
            <section> <!-- Pour la zone de texte -->

                <h2 class="speaker"> Michel </h2>

                <p class="text"> En chantier, je m'appelle teuse. Et toi ture. Et lui C'est cateur. Et voici le père
                    Sécuteur.
                    Et la Mère Cedes. Il y a aussi le frère Jaques. Et enfin Vibro ma soeur. Et Moi sonnoneuse.</p>
                <form action="?" method="get">
                    <div class="flex-row">
                        <input type="hidden" name="idStory" value="<?=$idStory?>">
                        <input type="hidden" name="idChap" value="<?=$idChap?>">
                        <button class="before button-gris" type="submit" name="action" value="prevDial"> < Précédent </button> <!-- changer les href car je sais pas quoi mettre comme lien -->
                        <button class="next button-gris" type="submit" name="action" value="nextDial"> Suivant ></button>
                        <input type="hidden" name="ctrl" value="histoire">
            
            
                     </div>
                </form>
                


            </section>
        </article>

    </main>
</body>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/machineAEcrire.js"></script>

</html>