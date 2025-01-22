<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/afficherHistoire.css">
</head>
<article class="content">
    <article>

        <?php foreach ($dialogues as $index => $dialogue):
            if ($dialogue instanceof Dialog): ?>
                <div class="dialogues">
                    <section>
                        <label for="personnage">
                            <?php if ($dialogue->getContent() !== 'limquestion'): ?>
                                Personnage qui parle : <?= $dialogue->getSpeaker()->getFirstName() ?? "questions" ?></label>
                        <?php else: ?>
                            <h4>POSITION DE LA QUESTION</h4>
                        <?php endif; ?>

                    </section>
                    <section class="reponseContainer flex-row">
                        <p class="left-in-article" id="dialogue">
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
                                <button class="supprimerDialogueOuvrir poub" type="button" name="delete" value="delete">
                                    <img src="./view/design/image/poubelle.png" alt="poubelle" class="poubelle">
                                </button>
                                <dialog class="dialog dialogSupprimerDialogue">
                                    <div class="containerDialog">
                                        <h2>Voulez vous supprimer ce dialogue ?</h2>
                                        <div>
                                            <button type="submit" name="delete" value="delete"
                                                class="fermerSupprimerDialogue button-rouge">
                                                Supprimer
                                            </button>
                                            <button type="button" class="revenirSupprimerDialogue">
                                                Annuler
                                            </button>
                                        </div>
                                    </div>
                                </dialog>
                            </form>
                            <button class="modifierDialogueOuvrir" type="button" data-dialogue-id="<?= $dialogue->getId() ?>">
                                <img class="modif" src="./view/design/image/modifier.png" alt="Modifier">
                            </button>
                        <?php else: ?>
                            <div class="vide"></div>
                            <div class="vide"></div>
                        <?php endif; ?>
                    </section>
                </div>
                <hr>
            <?php elseif ($dialogue instanceof Question): ?>
                <div class="quest">
                    <section>
                        <h4 class="red">Question : </h4>
                        <label class="bold" for="personnage"> <?= $dialogue->getQuestion() ?></label>
                    </section>
                    <section class="reponseContainer flex-row">
                        <section class="reponseQuestion">
                            <h4 class="red">Réponse : </h4>
                            <p id="question">
                                <?= $dialogue->getAnswer() ?>
                            </p>
                        </section>
                        <div class="flecheInvisible" id="fleche">
                            <form class="invisble" method="GET" action="index.php">

                                <button type="button" class="bouton-modif invisble">^</button>
                            </form>
                            <form class="invisble" method="GET" action="index.php">

                                <button type="button" class="bouton-modif bouton-bas invisble">^</button>
                            </form>
                        </div>
                        <div class="flex-row supmodif">
                            <form method="GET" action="index.php?ctrl=personnages&article=afficherHistoire">
                                <input type="hidden" name="ctrl" value="creation">
                                <input type="hidden" name="article" value="afficherHistoire">
                                <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
                                <input type="hidden" name="idDialogue" value="<?= $dialogue->getHistory()->getId() ?>">
                                <input type="hidden" name="typeDialogue" value="question">
                                <button id="supprimerQuestionOuvrir" type="button" name="delete" value="delete" class="poub">
                                    <img src="./view/design/image/poubelle.png" alt="poubelle" id="poubelle">
                                </button>

                                <dialog class="dialog" id="dialogSupprimerQuestion">
                                    <div class="containerDialog">
                                        <h2>Voulez vous supprimer cette question ?</h2>
                                        <div>
                                            <button type="submit" name="delete" value="delete" id="fermerSupprimerQuestion"
                                                class="button-rouge">
                                                Supprimer
                                            </button>
                                            <button type="button" class="button-vert" id="revenirSupprimerQuestion">
                                                Annuler
                                            </button>
                                        </div>
                                    </div>
                                </dialog>
                            </form>
                            <button class="modifierQuestionOuvrir" type="button"
                                data-dialogue-id="<?= $dialogue->getHistory()->getId() ?>">
                                <img class="modif" src="./view/design/image/modifier.png" alt="Modifier">
                            </button>
                        </div>
                    </section>
                    <hr>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </article>
    <dialog class="dialogModif" id="editDialoguePopup">
        <form method="POST" action="index.php?ctrl=creation&article=editDialogue&id=<?= $histoire->getId() ?>">
            <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
            <input type="hidden" name="idDialogue" id="editDialogueId">
            <div class="flex-col">
                <label for="content">Modifier le dialogue :</label>
                <textarea class="modifInput" name="content" id="editDialogueContent" rows="4" cols="50"></textarea>
            </div>
            <div class="flex-col buttons">
                <button type="submit" class="button-vert">Enregistrer</button>
                <button type="button" id="closeEditDialoguePopup">Annuler</button>
            </div>
        </form>
    </dialog>
    <dialog class="dialogModif" id="editQuestionPopup">
        <form method="POST" action="index.php?ctrl=creation&article=editQuestion&id=<?= $histoire->getId() ?>">
            <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
            <input type="hidden" name="idQuestion" id="editQuestionId">
            <div class="flex-col">
                <label for="question">Modifier la question :</label>
                <textarea class="modifInput" name="question" id="editQuestionContent" rows="4" cols="50"></textarea>
            </div>
            <div class="flex-col">
                <label for="answer">Modifier la réponse :</label>
                <textarea class="modifInput" name="answer" id="editAnswerContent" rows="4" cols="50"></textarea>
            </div>
            <div class="flex-col buttons">
                <button type="submit">Enregistrer</button>
                <button type="button" id="closeEditQuestionPopup">Annuler</button>
            </div>
        </form>
    </dialog>

    <script src="./view/js/creation.js"></script>
</article>