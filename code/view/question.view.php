<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Question</title>
    <link rel="stylesheet" type="text/css" href="./view/design/global.css">
    <link rel="stylesheet" type="text/css" href="./view/design/histoire.css">
</head>

<body>

    <?php include_once 'headerHistoire.view.php'; ?>
    <main >
        <h1>Chapitre <?=$story->getChapter()->getNumchap()?> : Histoire <?=$story->getId()?> : <?=$story->getTitle()?></h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="<?=$background?>" alt="Fond">
            <div class="personnages">
            </div>
        </article>

        <article>

            <section>

                <h2 class="speaker question"> Question <?= $question->getType() ?> </h2>

                <form>
                    <input type="hidden" name="ctrl" value="question">
                    <input type="hidden" name="action" value="lookPlace">
                    <button class="consulter-lieux">Consulter le lieux</button>
                </form>

                <p class="text"> <?=$question->getQuestion()?>
                </p>


                <div class="flex-row">
                            <form class="flex-row" action="?">
                                <label for="answer">Réponse :
                                    <input type="number" name="answer" id="answer">
                                </label>
                                <input type="hidden" name="ctrl" value="question">
                                <input type="hidden" name="background" value="<?=$background?>">
                                <input type="hidden" name="action" value="answer">
                                <button class="repondre button-vert"> Répondre </button> 
                            </form>
                    
                            <p class="text-error"><?=$error?></p>

                            <form action="?">
                                <input type="hidden" name="action" value="change">
                                <input type="hidden" name="ctrl" value="question">
                                <?php if($story->getChapter()->getNumchap() != 100){ ?>
                                <button class="autreQuestion button-gris"> Accéder à l'autre question</button>
                                <?php }?>
                            </form>
                </div>
            </section>
        </article>
        <script src="./view/js/dyslexique.js"></script>
        <script src="./view/js/machineAEcrire.js"></script>
    </main>
</body>

</html>
