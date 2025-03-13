<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/ajouterQuestion.css">
    <link rel="stylesheet" href="./view/design/popup.css">
</head>
<article class="content">
    <form action="index.php?ctrl=creation" method="get">
        <input type="hidden" name="ctrl" value="creation">
        <input type="hidden" name="article" value="ajouterQuestion">
        <input type="hidden" name="id" value="<?= $histoire->getId() ?>">

        <div class="flex-col texte">
            <span>Attention !</span>
            <p>Vous ne pouvez rajouter qu'une question dans votre histoire. Une deuxième question rajoutée remplacera la première.</p>
        </div>

        <!-- Question -->
        <section class="input-superpose">
            <label for="question">Entrez la question : </label>
            <textarea maxlength="200" name="question" id="questionInput" required></textarea>
        </section>

        <!-- Réponse -->
        <section class="input-superpose">
            <label for="reponse">Entrez la réponse : </label>
            <input type="number" name="reponse" id="reponseInput" required></input>
        </section>

        <!-- boutons -->
        <section class="buttons" class="effacer-enregistrer">
            <button type="button" class="button-rouge delete-button" id="effacerQuestionOuvrir"
                type="button">Effacer</button>
            <button class="button-vert" type="submit">Enregistrer</button>
        </section>

        <p><?= $message ?></p>
        <?php if (isset($errorMessage)) { ?>
            <p><?= $errorMessage ?></p>
        <?php } ?>

        <!-- Pop-up de confirmation de suppression -->
        <dialog class="dialog" id="effacerQuestionDialogue">
            <div class="containerDialog">
                <h2>Voulez vous effacer cette question ?</h2>
                <div>
                    <button type="button" id="fermerEffacerQuestion" class="button-rouge">
                        Effacer
                    </button>
                    <button type="button" id="revenirEffacerQuestion" class="button-vert">
                        Annuler
                    </button>
                </div>
            </div>
        </dialog>
          
    </form>
    <script src="./view/js/creation.js"></script>
</article>