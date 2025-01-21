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
                                                class="fermerSupprimerDialogue button-vert">
                                                Supprimer
                                            </button>
                                            <button type="button" class="revenirSupprimerDialogue button-rouge">
                                                Annuler
                                            </button>
                                        </div>
                                    </div>
                                </dialog>
                            </form>
                            <button class="modifierDialogueOuvrir" type="button" data-dialogue-id="<?= $dialogue->getId() ?>">
                                <img class="modif" src="./view/design/image/modifier.png" alt="Modifier">
                            <?php else: ?>
                                <div id="poubelle"></div>
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
                                            class="button-vert">
                                            Supprimer
                                        </button>
                                        <button type="button" class="button-rouge" id="revenirSupprimerQuestion">
                                            Annuler
                                        </button>
                                    </div>
                                </div>
                            </dialog>
                        </form>
                    </section>
                    <hr>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>

    </article>
    <dialog id="editDialoguePopup">
        <form method="POST" action="index.php?ctrl=creation&article=editDialogue">
            <input type="hidden" name="id" value="<?= $histoire->getId() ?>">
            <input type="hidden" name="idDialogue" id="editDialogueId">
            <label for="content">Modifier le dialogue :</label>
            <textarea name="content" id="editDialogueContent" rows="4" cols="50"></textarea>
            <button type="submit">Enregistrer</button>
            <button type="button" id="closeEditDialoguePopup">Annuler</button>
        </form>
    </dialog>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Open edit dialogue popup
            document.querySelectorAll('.modifierDialogueOuvrir').forEach(button => {
                button.addEventListener('click', function () {
                    const dialogueId = this.getAttribute('data-dialogue-id');
                    const dialogueContent = this.closest('.dialogues').querySelector('#dialogue').innerText;
                    document.getElementById('editDialogueId').value = dialogueId;
                    document.getElementById('editDialogueContent').value = dialogueContent;
                    document.getElementById('editDialoguePopup').showModal();
                });
            });

            // Close edit dialogue popup
            document.getElementById('closeEditDialoguePopup').addEventListener('click', function () {
                document.getElementById('editDialoguePopup').close();
            });
        });
    </script>

    <script>
        //supprimerDialogue
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function (event) {
                let target = event.target.closest('.supprimerDialogueOuvrir, .fermerSupprimerDialogue, .revenirSupprimerDialogue');

                if (!target) return;

                if (target.classList.contains('supprimerDialogueOuvrir')) {
                    var dialog = target.closest('form').querySelector('.dialogSupprimerDialogue');
                    dialog.showModal();
                } else if (target.classList.contains('fermerSupprimerDialogue') ||
                    target.classList.contains('revenirSupprimerDialogue')) {
                    target.closest('dialog').close();
                }
            });
        });

        document.addEventListener('DOMContentLoaded', function () {
            //supprimerQuestion
            var supprimerQuestionOuvrir = document.getElementById('supprimerQuestionOuvrir');
            var dialogSupprimerQuestion = document.getElementById('dialogSupprimerQuestion');
            var fermerSupprimerQuestion = document.getElementById('fermerSupprimerQuestion');
            var revenirSupprimerQuestion = document.getElementById('revenirSupprimerQuestion');

            if (dialogSupprimerQuestion && supprimerQuestionOuvrir && fermerSupprimerQuestion && revenirSupprimerQuestion) {
                supprimerQuestionOuvrir.addEventListener('click', function () {
                    dialogSupprimerQuestion.showModal();
                });

                fermerSupprimerQuestion.addEventListener('click', function () {
                    dialogueTextArea.value = '';
                    dialogSupprimerQuestion.close();
                });

                revenirSupprimerQuestion.addEventListener('click', function () {
                    dialogSupprimerQuestion.close();
                });
            }
        });     
    </script>
</article>