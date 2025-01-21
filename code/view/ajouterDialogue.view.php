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
            <select name="nom">
                <?php foreach ($personnages as $perso) : ?>
                <option value="<?= $perso->getFirstName() ?>"><?= $perso->getFirstName()?></option>
                <?php endforeach; ?>
            </select>
        </section>

        <!-- dialogue -->
        <section class="flex-col">
            <label for="dialogue">Entrez le texte du dialogue : </label>
            <textarea required name="dialogue" id="dialogueText" maxlength="400"></textarea>
        </section>

        <!-- boutons -->
        <section>
        <button class="button-rouge" id="effacerDialogueOuvrir" type="button">Effacer</button>
        <button class="button-vert" type="submit" >Enregistrer</button>
        </section>

        <!-- Pop-up de confirmation de suppression -->
        <dialog class="dialog" id="dialogEffacerDialogue">
            <div class="containerDialog">
                <h2>Voulez vous effacer ce dialogue ?</h2>
                <div>
                    <button type="button" id="fermerEffacerDialogue" class="button-vert">
                        Effacer
                    </button>
                    <button type="button" class="button-rouge" id="revenirEffacerDialogue">
                        Annuler
                    </button>
                </div>
            </div>
        </dialog>


        <script src="./view/js/dyslexique.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dialogueTextArea = document.getElementById('dialogueText');

                //supprimerDialogue
                var effacerDialogueOuvrir = document.getElementById('effacerDialogueOuvrir');
                var dialogEffacerDialogue = document.getElementById('dialogEffacerDialogue');
                var fermerEffacerDialogue = document.getElementById('fermerEffacerDialogue');
                var revenirEffacerDialogue = document.getElementById('revenirEffacerDialogue');

                if (dialogEffacerDialogue && effacerDialogueOuvrir && fermerEffacerDialogue && revenirEffacerDialogue) {
                    effacerDialogueOuvrir.addEventListener('click', function () {
                        dialogEffacerDialogue.showModal();
                    });

                    fermerEffacerDialogue.addEventListener('click', function () {
                        dialogueTextArea.value = '';
                        dialogEffacerDialogue.close();
                    });

                    revenirEffacerDialogue.addEventListener('click', function () {
                        dialogEffacerDialogue.close();
                    });
                }
                });      
        </script>
    </form>
</article>


        <script src="./view/js/dyslexique.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const dialogueForm = document.getElementById('dialogueForm');
                const dialogueTextArea = document.getElementById('dialogueText');

                //supprimerDialogue
                var supprimerDialogueOuvrir = document.getElementById('supprimerDialogueOuvrir');
                var dialogSupprimerDialogue = document.getElementById('dialogSupprimerDialogue');
                var fermerSupprimerDialogue = document.getElementById('fermerSupprimerDialogue');
                var revenirSupprimerDialogue = document.getElementById('revenirSupprimerDialogue');

                if (supprimerDialogueOuvrir && dialogSupprimerDialogue && fermerSupprimerDialogue && revenirSupprimerDialogue) {
                    supprimerDialogueOuvrir.addEventListener('click', function () {
                        dialogSupprimerDialogue.showModal();
                    });

                    fermerSupprimerDialogue.addEventListener('click', function () {
                        dialogueTextArea.value = '';
                        dialogSupprimerDialogue.close();
                    });

                    revenirSupprimerDialogue.addEventListener('click', function () {
                        dialogSupprimerDialogue.close();
                    });
                }
                });      
        </script>
</article>