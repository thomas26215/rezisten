
document.addEventListener('DOMContentLoaded', function () {

    // Update hidden field
    function updateHiddenField() {
        document.getElementById('id_lieu').value = document.getElementById('lieux').value;
    }
    updateHiddenField();
    document.getElementById('lieux').addEventListener('change', updateHiddenField);

    // Highlight current page button
    var currentUrl = window.location.search;
    var afficher = document.getElementById("afficherHistoire");
    var ajouterD = document.getElementById("ajouterDialogue");
    var ajouterQ = document.getElementById("ajouterQuestion");

    if (currentUrl.includes('article=afficherHistoire')) {
        afficher.classList.remove("button-gris");
    } else if (currentUrl.includes('article=ajouterDialogue')) {
        ajouterD.classList.remove("button-gris");
    } else if (currentUrl.includes('article=ajouterQuestion')) {
        ajouterQ.classList.remove("button-gris");
    }

    // Dialog handling
    function setupDialog(openBtn, dialog, closeBtn, cancelBtn) {
        if (openBtn && dialog && closeBtn && cancelBtn) {
            openBtn.addEventListener('click', function () {
                dialog.showModal();
            });
            closeBtn.addEventListener('click', function () {
                dialog.close();
            });
            cancelBtn.addEventListener('click', function () {
                dialog.close();
            });
        }
    }

    setupDialog(
        document.getElementById('quitterHistoireOuvrir'),
        document.getElementById('dialogQuitterHistoire'),
        document.getElementById('fermerQuitterHistoire'),
        document.getElementById('revenirQuitterHistoire')
    );

    setupDialog(
        document.getElementById('publierHistoireOuvrir'),
        document.getElementById('dialogPublierHistoire'),
        document.getElementById('fermerPublierHistoire'),
        document.getElementById('revenirPublierHistoire')
    );

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

    const dialogueForm = document.getElementById('dialogueForm');
    const dialogueTextArea1 = document.getElementById('dialogueText');

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
            dialogueTextArea1.value = '';
            dialogSupprimerDialogue.close();
        });

        revenirSupprimerDialogue.addEventListener('click', function () {
            dialogSupprimerDialogue.close();
        });
    }
    // Open edit question popup
    document.querySelectorAll('.modifierQuestionOuvrir').forEach(button => {
        button.addEventListener('click', function () {
            const questionId = this.getAttribute('data-question-id');
            const questionContent = this.closest('.quest').querySelector('label[for="personnage"]').innerText;
            const answerContent = this.closest('.quest').querySelector('#question').innerText;
            document.getElementById('editQuestionId').value = questionId;
            document.getElementById('editQuestionContent').value = questionContent;
            document.getElementById('editAnswerContent').value = answerContent;
            document.getElementById('editQuestionPopup').showModal();
        });
    });

    // Close edit question popup
    document.getElementById('closeEditQuestionPopup').addEventListener('click', function () {
        document.getElementById('editQuestionPopup').close();
    });
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
