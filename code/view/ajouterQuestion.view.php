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
            <textarea name="question" id="questionInput" required></textarea>
        </section>

        <!-- Réponse -->
        <section class="input-superpose">
            <label for="reponse">Entrez la réponse : </label>
            <input type="number" name="reponse" id="reponseInput" required></input>
        </section>

        <!-- boutons -->
        <section>
            <button type="button" class="button-rouge delete-button"  id="effacerQuestionOuvrir" type="button">Effacer</button>
            <button class="button-vert" type="submit">Enregistrer</button>
        </section>

        <!-- Pop-up de confirmation de suppression -->
        <dialog class="dialog" id="effacerQuestionDialogue">
            <div class="containerDialog">
                <h2>Voulez vous effacer cette question ?</h2>
                <div>
                    <button type="button" id="fermerEffacerQuestion" class="button-vert">
                        Effacer
                    </button>
                    <button type="button" id="revenirEffacerQuestion" class="button-rouge">
                        Annuler
                    </button>
                </div>
            </div>
        </dialog>


        <script src="./view/js/dyslexique.js"></script>
        <script>

            document.addEventListener('DOMContentLoaded', function () {
                var questionTextArea = document.getElementById("questionInput");
                var reponseTextArea = document.getElementById("reponseInput");

                //supprimerQuestion
                var effacerQuestionOuvrir = document.getElementById('effacerQuestionOuvrir');
                var effacerQuestionDialogue = document.getElementById('effacerQuestionDialogue');
                var fermerEffacerQuestion = document.getElementById('fermerEffacerQuestion');
                var revenirEffacerQuestion = document.getElementById('revenirEffacerQuestion');

                if (effacerQuestionOuvrir && effacerQuestionDialogue && fermerEffacerQuestion && revenirEffacerQuestion) {
                    effacerQuestionOuvrir.addEventListener('click', function () {
                        effacerQuestionDialogue.showModal();
                    });

                    fermerEffacerQuestion.addEventListener('click', function () {
                        questionTextArea.value = '';
                        reponseTextArea.value = '';
                        effacerQuestionDialogue.close();
                    });

                    revenirEffacerQuestion.addEventListener('click', function () {
                        effacerQuestionDialogue.close();
                    });
                }
            });  
        </script>
    </form>
</article>
