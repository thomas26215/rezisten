// Vérifiez si le mode dyslexique est activé dans le localStorage
const toggleButton = document.getElementById('toggleDyslexique');

function applyDyslexicMode() {
    const elements = document.querySelectorAll('body, h1, h2, h3, h4, h5, h6, p, a, button, input[type="button"], input[type="submit"], ul, ol, li, label, input, textarea, select, option, table, th, td, div, span');
    elements.forEach(element => {
        element.classList.add('dyslexique');
    });
    toggleButton.classList.remove("button-rouge")

    toggleButton.classList.add("button-vert")

}

function removeDyslexicMode() {
    const elements = document.querySelectorAll('body, h1, h2, h3, h4, h5, h6, p, a, button, input[type="button"], input[type="submit"], ul, ol, li, label, input, textarea, select, option, table, th, td, div, span');
    elements.forEach(element => {
        element.classList.remove('dyslexique');
    });
    toggleButton.classList.remove("button-vert")
    toggleButton.classList.add("button-rouge")

}

if (localStorage.getItem('dyslexique') === 'true') {
    applyDyslexicMode();
}

// Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
document.addEventListener('DOMContentLoaded', function() {
    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            if (document.body.classList.contains('dyslexique')) {
                removeDyslexicMode();
                localStorage.setItem('dyslexique', 'false');
            } else {
                applyDyslexicMode();
                localStorage.setItem('dyslexique', 'true');

            }
        });
    }
});