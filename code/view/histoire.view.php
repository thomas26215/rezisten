
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <title><?=$story->getTitle()?></title>
    <meta name="author" content="Brayan" />
    <link rel="stylesheet" type="text/css" href="./view/design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./view/design/global.css">
</head>

<body>

    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col">
        <audio src="<?=$dub?>" autoplay></audio>
        <h1>Chapitre <?=$story->getChapter()->getNumchap()?> : Histoire <?=$story->getId()?> : <?= $story->getTitle()?></h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="./view/design/image/image_test.png" alt="Fond">
            <div class="personnages">
                <img class="parle" src="<?= $imgSpeaker ?>" alt="<?=$speaker->getFirstName()?>">
                <img class="parle-pas" src="<?=$prevSpeaker?>" alt="resistant">
            </div>
        </article>

        <article id="test">
            <section> <!-- Pour la zone de texte -->

                <h2 class="speaker"> <?= $speaker->getFirstName() ?> </h2>
                <p class="text"> <?= $dialog->getContent() ?></p>
                <form action="?" method="get">
                    <div class="flex-row">
                        <input type="hidden" name="idStory" value="<?= $idStory ?>">
                        <input type="hidden" name="ctrl" value="histoire">
                        <input type="hidden" name="idDialog" id="idDialogInput" value="<?= $idDialog ?>">
                        <input type="hidden" name="prevSpeaker" value="<?=$speaker->getImage()?>">

                        <button class="before button-gris" type="submit" onclick="document.getElementById('idDialogInput').value = <?= max($idDialog -1, 1) ?>">
                        < Précédent </button>

                        <button class="next button-gris" type="submit" onclick="document.getElementById('idDialogInput').value = <?= $idDialog + 1 ?>">
                        Suivant ></button>
                    </div>
                </form>

                
                


            </section>
        </article>

    </main>
</body>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/machineAEcrire.js"></script>

</html>