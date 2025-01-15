<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./view/design/afficherHistoire.css">
</head>
<article class="content">
    <div>
        <h2 class="titre"> Afficher toute l'histoire</h2>
    </div>
    <article>
        <form action="">


            <?php foreach ($dialogues as $dialogue):
                if ($dialogue instanceof Dialog): ?>

                    <section>
                        <label for="personnage">Personnage qui parle :
                            <?= $dialogue->getSpeaker()->getFirstName() ?? "questions" ?></label>
                    </section>
                    <!-- il faut que le premier n'est pas de fleche vers le haut et que le dernier n'est pas de fleche vers le bas -->
                    <section class=flex-row>
                        <p>
                            <?= $dialogue->getContent() ?>
                        </p>
                        <div id="fleche">
                            <button class="bouton-modif">^</button>
                            <button class="bouton-modif bouton-bas">^</button>
                        </div>
                        <form method="GET" action="index.php?ctrl=personnages&article=afficherHistoire">
                            <input type="hidden" name="ctrl" value="creation">
                            <input type="hidden" name="article" value="afficherHistoire">
                            <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                            <input type="hidden" name="idDialogue" value="<?= $dialogue->getId() ?>">
                            <input type="hidden" name="typeDialogue" value="dialogue">
                            <button type="submit" name="delete" value="delete"><img src="./view/design/image/poubelle.png"
                                    alt="poubelle" id="poubelle"></button>
                        </form>

                    </section>
                <?php elseif ($dialogue instanceof Question): ?>


                    <section>
                        <p>Question : </p>
                        <label for="personnage"> <?= $dialogue->getQuestion() ?></label>
                    </section>
                    <!-- il faut que le premier n'est pas de fleche vers le haut et que le dernier n'est pas de fleche vers le bas -->
                    <section class=flex-row>
                        <p>
                            <?= $dialogue->getAnswer() ?>
                        </p>
                        <div id="fleche">
                            <button class="bouton-modif">^</button>
                            <button class="bouton-modif bouton-bas">^</button>
                        </div>

                        <form method="GET" action="index.php?ctrl=personnages&article=afficherHistoire">
                            <input type="hidden" name="ctrl" value="creation">
                            <input type="hidden" name="article" value="afficherHistoire">
                            <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                            <input type="hidden" name="idDialogue" value="<?= $dialogue->getHistory()->getId() ?>">
                            <input type="hidden" name="typeDialogue" value="question">
                            <button type="submit" name="delete" value="delete"><img src="./view/design/image/poubelle.png"
                                    alt="poubelle" id="poubelle"></button>
                        </form>

                    </section>




                <?php endif; ?>
            <?php endforeach; ?>

        </form>
    </article>
    <!-- boutons -->
    <section class="last-button">
        <button class=button-rouge>Annuler</button>
        <button class=button-vert>Valider</button>
    </section>
</article>