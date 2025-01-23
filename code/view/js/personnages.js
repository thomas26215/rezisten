document.addEventListener('DOMContentLoaded', function () {
    var currentUrl = window.location.search;
    var supprimer = document.getElementById("supprimer");
    var modifier = document.getElementById("modifier");
    var ajouter = document.getElementById("ajouter");
    var consulter = document.getElementById("consulter");

    if (currentUrl.includes('article=supprimerPersonnage')) {
        supprimer.classList.remove("button-gris");
    } else if (currentUrl.includes('article=modifierPersonnage')) {
        modifier.classList.remove("button-gris");
    } else if (currentUrl.includes('article=ajouterPersonnage')) {
        ajouter.classList.remove("button-gris");
    } else if (currentUrl.includes('article=consulterPersonnage')) {
        consulter.classList.remove("button-gris");
    }

    /* Pop-up Quitter*/
    const openQuitter = document.getElementById("quitterOuvrir");
    const fermerQuitter = document.getElementById("fermerQuitter");
    const RevenirQuitter = document.getElementById("revenirQuitter");
    const idDialogue = document.getElementById("dialogQuitter");
    //

    /* Ouvir */
    openQuitter.addEventListener("click", () => {
        idDialogue.showModal();
    });
    /* ferme */
    fermerQuitter.addEventListener("click", () => {
        idDialogue.close();
    });
    /* Action + ferme */
    RevenirQuitter.addEventListener("click", () => {
        idDialogue.close();
    });


    // Supprimer personnage
    var supprimerOuvrir = document.getElementById('supprimerOuvrir');
    var dialogSupprimer = document.getElementById('dialogSupprimer');
    var fermerSupprimer = document.getElementById('fermerSupprimer');
    var revenirSupprimer = document.getElementById('revenirSupprimer');

    if (supprimerOuvrir && dialogSupprimer && fermerSupprimer && revenirSupprimer) {
        supprimerOuvrir.addEventListener('click', function () {
            dialogSupprimer.showModal();
        });

        fermerSupprimer.addEventListener('click', function () {
            dialogSupprimer.close();
        });

        revenirSupprimer.addEventListener('click', function () {
            dialogSupprimer.close();
        });
    }

    // Ajouter personnage
    var ajouterOuvrir = document.getElementById('ajouterOuvrir');
    var dialogAjouter = document.getElementById('dialogAjouter');
    var fermerAjouter = document.getElementById('fermerAjouter');
    var revenirAjouter = document.getElementById('revenirAjouter');

    if (ajouterOuvrir && dialogAjouter && fermerAjouter && revenirAjouter) {
        ajouterOuvrir.addEventListener('click', function () {
            dialogAjouter.showModal();
        });

        fermerAjouter.addEventListener('click', function () {
            dialogAjouter.close();
        });

        revenirAjouter.addEventListener('click', function () {
            dialogAjouter.close();
        });
    }

    // Modifier personnage
    var modifierOuvrir = document.getElementById('modifierOuvrir');
    var dialogModifier = document.getElementById('dialogModifier');
    var fermerModifier = document.getElementById('fermerModifier');
    var revenirModifier = document.getElementById('revenirModifier');

    if (modifierOuvrir && dialogModifier && fermerModifier && revenirModifier) {
        modifierOuvrir.addEventListener('click', function () {
            dialogModifier.showModal();
        });

        fermerModifier.addEventListener('click', function () {
            dialogModifier.close();
        });

        revenirModifier.addEventListener('click', function () {
            dialogModifier.close();
        });
    }
});