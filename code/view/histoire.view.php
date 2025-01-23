<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <title><?= $story->getTitle() ?></title>
    <meta name="author" content="Brayan" />
    <link rel="stylesheet" type="text/css" href="./view/design/histoire.css">
    <link rel="stylesheet" type="text/css" href="./view/design/global.css">
    <link rel="stylesheet" type="text/css" href="./view/design/popup.css">
    <link rel="stylesheet" href="./view/design/headerHistoire.css">

</head>

<body>
    <header>
        <form action="index.php" method="get">
            <input type="hidden" name="ctrl" value="main">
            <button class="buttons home" type="button" id="homeOuvrir">
                <img src="./view/design/image/home.png" alt="home">
                <span class="accueil-text">Accueil</span>
            </button>
            <dialog class="dialog" id="dialogHome">
                <div class="containerDialog">
                    <h2>Voulez vous quitter la page ? Vous perdrez toute votre progression.</h2>
                    <div>
                        <button type="submit" id="fermerHome" name="fermer" class="button-rouge">
                            Quitter
                        </button>
                        <button type="button" id="revenirHome" class="button-vert">
                            Revenir
                        </button>
                    </div>
                </div>
            </dialog>
        </form>

        <a href="./index.php?ctrl=profil" class="flex-col">
            <img class="img-profile" src="./view/design/image/photoProfil.jpg" alt="user">
            <p class="nomUser"><?= (User::read((int) $_SESSION['user_id']))->getUsername() ?></p>
            <!-- affichage du pseudo du user -->
        </a>
    </header>


    <main class="flex-col">
        <audio src="<?= $dub ?>" autoplay></audio>
        <h1>Chapitre <?= $story->getChapter()->getNumchap() ?> : Histoire <?= $story->getId() ?> :
            <?= $story->getTitle() ?>
        </h1>
        <!--Remplacer après, de façon a récupérer les informations en fonction de l'histoire  -->


        <article class="fond-container">
            <img class="fond" src="<?= $background ?>" alt="Fond">
            <div class="personnages">
                <img class="parle" src="<?= $imgSpeaker ?>" alt="<?= $speaker->getFirstName() ?>">
                <img class="parle-pas" src="<?= $prevSpeaker ?>" alt="">
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
                        <input type="hidden" name="prevSpeaker" value="<?= $speaker->getImage() ?>">
                        <?php if ($idDialog == 1 || $idDialog == $firstbonus || $_SESSION['lastDialog'] == $idDialog - 1) { ?>
                            <button class="button-vide" type="button"></button>
                        <?php } else { ?>
                            <button class="before button-gris" type="submit"
                                onclick="document.getElementById('idDialogInput').value = <?= max($idDialog - 1, 1) ?>">
                                < Précédent </button>
                                <?php } ?>


                                <button class="next button-gris" type="submit"
                                    onclick="document.getElementById('idDialogInput').value = <?= $idDialog + 1 ?>">
                                    Suivant ></button>
                    </div>
                </form>





            </section>
        </article>

    </main>
</body>
<script src="./view/js/dyslexique.js"></script>
<script src="./view/js/machineAEcrire.js"></script>
<script src="./view/js/histoire.js"></script>

</html>