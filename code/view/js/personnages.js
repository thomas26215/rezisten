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
});