<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/ajouterDialogue.css">
</head>
<article class="content">
    <form id="dialogueForm" class="flex-col" action="index.php?ctrl=creation" method="get">
        <input type="hidden" name="ctrl" value="creation">
        <input type="hidden" name="article" value="ajouterDialogue">
        <input type="hidden" name="id" value="<?= $histoire->getId() ?>">

        <section>
            <label for="personnage">Personnage qui parle : </label>
            <select name="nom" class="select-perso">
                <?php foreach ($personnages as $perso): ?>
                    <option value="<?= $perso->getFirstName() ?>"><?= $perso->getFirstName() ?></option>
                <?php endforeach; ?>
            </select>
        </section>

        <!-- dialogue -->
        <section class="texteDialogue">
            <label for="dialogue">Entrez le texte du dialogue : </label>
            <textarea required name="dialogue" id="dialogueText" maxlength="400"></textarea>
        </section>

        <!-- boutons -->
        <section class="buttons">
            <button class="button-rouge" id="effacerDialogueOuvrir" type="button">Effacer</button>
            <button class="button-vert" type="submit">Enregistrer</button>
        </section>

        <p><?= $message ?></p>
        <?php if (isset($errorMessage)) { ?>
            <p><?= $errorMessage ?></p>
        <?php } ?>

        <!-- Pop-up de confirmation de suppression -->
        <dialog class="dialog" id="dialogEffacerDialogue">
            <div class="containerDialog">
                <h2>Voulez vous effacer ce dialogue ?</h2>
                <div>
                    <button type="button" id="fermerEffacerDialogue" class="button-rouge">
                        Effacer
                    </button>
                    <button type="button" class="button-vert" id="revenirEffacerDialogue">
                        Annuler
                    </button>
                </div>
            </div>
        </dialog>


        <script src="./view/js/creation.js"></script>
    </form>
</article>

</article>