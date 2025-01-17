
<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <title><?=$story->getTitle()?></title>
    <meta name="author" content="Brayan" />
    <link rel="stylesheet" type="text/css" href="./view/design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./view/design/global.css">
    <style>
        .texte-machine {
            font-family: 'Courier New', Courier, monospace;
            white-space: nowrap; /* Évite les retours à la ligne */
            overflow: hidden;   /* Masque le texte qui n'est pas encore affiché */
            border-right: 2px solid black; /* Curseur clignotant */
            display: inline-block;
            animation: blink 0.7s steps(1) infinite;
        }

        /* Animation pour le curseur clignotant */
        @keyframes blink {
            0%, 50% {
                border-color: black;
            }
            51%, 100% {
                border-color: transparent;
            }
        }
    </style>
</head>

<body>

    <?php include_once './view/headerHistoire.view.php'; ?>
    <main class="flex-col">
        <audio src="<?=$dub?>" autoplay></audio>
        <h1>Chapitre <?=$story->getChapter()->getNumchap()?> : Histoire <?=$story->getId()?> : <?= $story->getTitle()?></h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="<?=$background?>" alt="Fond">
            <div class="personnages">
                <img class="parle" src="<?= $imgSpeaker ?>" alt="<?=$speaker->getFirstName()?>">
                <img class="parle-pas" src="<?=$prevSpeaker?>" alt="">
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
                        <?php if($idDialog == 1 || $idDialog == $firstbonus || $_SESSION['lastDialog'] == $idDialog-1){ ?>
                            <button class="button-vide" type="button"></button>
                        <?php }
                        else{?>
                         <button class="before button-gris" type="submit" onclick="document.getElementById('idDialogInput').value = <?= max($idDialog -1, 1) ?>">
                         < Précédent </button>
                        <?php } ?>
                       

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
