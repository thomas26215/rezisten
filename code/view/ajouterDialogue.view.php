<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/ajouterDialogue.css">
</head>
<article class="content"> 
    <form class="flex-col" action="creation" method="get">
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
            <textarea name="dialogue" id="dialogue" maxlength="400"></textarea>
        </section>

        <!-- boutons -->
        <section>
            <button class="button-rouge delete-button" type="reset">Supprimer</button>
            <button class="button-vert" type="submit">Valider</button>
        </section>

        <!-- Pop-up de confirmation de suppression -->
        <dialog id="delete-dialog">
            <div class="containerDialog">
                <h2>Voulez vous supprimer ce dialogue ?</h2>
                <div class="flex-row button-grp">
                    
                <form method="GET" action="index.php">
                    <button type ="submit" id="confirm-delete" class="button-vert">
                        Supprimer
                    </button>
                </form>
                    <button  id="cancel-delete" class="button-rouge">
                        Annuler
                    </button>
                </div>
            </div>
        </dialog>


        <script src="./view/js/dyslexique.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const deleteButtons = document.querySelectorAll('.delete-button');
                const deleteDialog = document.getElementById('delete-dialog');
                const confirmDeleteButton = document.getElementById('confirm-delete');
                const cancelDeleteButton = document.getElementById('cancel-delete');
                let storyIdToDelete = null;

                deleteButtons.forEach(button => {
                    button.addEventListener('click', function (event) {
                        event.preventDefault();
                        storyIdToDelete = this.getAttribute('data-story-id');
                        deleteDialog.showModal();
                    });
                });

                confirmDeleteButton.addEventListener('click', function () {
                    if (storyIdToDelete) {
                        window.location.href = `#`;
                    }
                });

                cancelDeleteButton.addEventListener('click', function () {
                    event.preventDefault(); // Empêche le comportement par défaut
                    deleteDialog.close();
                });
            });
        </script>
    </form>
</article>