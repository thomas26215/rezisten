<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/afficherHistoire.css">
</head>
<article class="content">
    <article>

            <?php foreach ($dialogues as $index => $dialogue):
                if ($dialogue instanceof Dialog): ?>

                    <section>
                        <label for="personnage">
                            <?php if ($dialogue->getContent() !== 'limquestion'): ?>
                                Personnage qui parle : <?= $dialogue->getSpeaker()->getFirstName() ?? "questions" ?></label>
                        <?php else: ?>
                            <h4>POSITION DE LA QUESTION</h4>
                        <?php endif; ?>

                    </section>
                    <section class=flex-row>
                        <p class="left-in-article">
                            <?php if ($dialogue->getContent() !== 'limquestion'): ?>
                                <?= $dialogue->getContent() ?>
                            <?php else: ?>
                                Flèche pour déplacer la position de la question ->
                            <?php endif; ?>
                        </p>
                        <div id="fleche">
                            <?php if ($index > 1): ?>
                                <form method="GET" action="index.php">
                                    <input type="hidden" name="ctrl" value="creation">
                                    <input type="hidden" name="article" value="afficherHistoire">
                                    <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                                    <input type="hidden" name="action" value="moveUp">
                                    <input type="hidden" name="idDialogue" value="<?= $dialogue->getId() ?>">
                                    <button type="submit" class="bouton-modif">^</button>
                                </form>
                            <?php endif; ?>
                            <?php if ($index < count($dialogues) - 1): ?>
                                <form method="GET" action="index.php">
                                    <input type="hidden" name="ctrl" value="creation">
                                    <input type="hidden" name="article" value="afficherHistoire">
                                    <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                                    <input type="hidden" name="action" value="moveDown">
                                    <input type="hidden" name="idDialogue" value="<?= $dialogue->getId() ?>">
                                    <button type="submit" class="bouton-modif bouton-bas">^</button>
                                </form>
                            <?php endif; ?>
                        </div>
                        <?php if ($dialogue->getContent() !== 'limquestion'): ?>
                            <form method="GET" action="index.php">
                                <input type="hidden" name="ctrl" value="creation">
                                <input type="hidden" name="article" value="afficherHistoire">
                                <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                                <input type="hidden" name="idDialogue" value="<?= $dialogue->getId() ?>">
                                <input type="hidden" name="typeDialogue" value="dialogue">
                                <button type="submit" name="delete" value="delete" class="poub">
                                    <img src="./view/design/image/poubelle.png" alt="poubelle" id="poubelle">
                                </button>
                            </form>
                        <?php else: ?>
                            <div id="poubelle"></div>
                        <?php endif; ?>
                    </section>
                <?php elseif ($dialogue instanceof Question): ?>
                    <div class="">
                        <section>
                            <p>Question : </p>
                            <label for="personnage"> <?= $dialogue->getQuestion() ?></label>
                        </section>
                        <section class=flex-row>

                            <p class="left-in-article">
                                <?= $dialogue->getAnswer() ?>
                            </p>
                            <div id="fleche">
                                <form class="invisble" method="GET" action="index.php">

                                    <button type="button" class="bouton-modif invisble">^</button>
                                </form>
                                <form class="invisble" method="GET" action="index.php">

                                    <button type="button" class="bouton-modif bouton-bas invisble">^</button>
                                </form>
                            </div>
                            <form method="GET" action="index.php?ctrl=personnages&article=afficherHistoire">
                                <input type="hidden" name="ctrl" value="creation">
                                <input type="hidden" name="article" value="afficherHistoire">
                                <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                                <input type="hidden" name="idDialogue" value="<?= $dialogue->getHistory()->getId() ?>">
                                <input type="hidden" name="typeDialogue" value="question">
                                <button type="submit" name="delete" value="delete" class="poub">
                                    <img src="./view/design/image/poubelle.png" alt="poubelle" id="poubelle">
                                </button>
                            </form>
                        </section>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

    </article>

</article>