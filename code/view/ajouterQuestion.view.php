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

        <!-- Question -->
        <section class="input-superpose">
            <label for="question">Entrez la question : </label>
            <textarea name="question" id="question" required></textarea>
        </section>

        <!-- Réponse -->
        <section class="input-superpose">
            <label for="reponse">Entrez la réponse : </label>
            <input type="number" name="reponse" id="reponse" required></input>
        </section>

        <!-- boutons -->
        <section>
            <button class="button-rouge delete-button" type="reset">Supprimer</button>
            <button class="button-vert" type="submit">Valider</button>
        </section>

        <!-- Pop-up de confirmation de suppression -->
        <dialog id="delete-dialog">
            <div class="containerDialog">
                <h2>Voulez vous supprimer cette question ?</h2>
                <div class="flex-row button-grp">
                    <button id="confirm-delete" class="button-vert">
                        Supprimer
                    </button>
                    <button id="cancel-delete" class="button-rouge">
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
