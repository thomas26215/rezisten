const textElement = document.querySelector('.text');

// Récupérer le texte de l'élément et supprimer les sauts de ligne et espaces superflus
const originalText = textElement.textContent.replace(/\s+/g, ' ').trim();

// Vider l'élément
textElement.textContent = '';

// Mettre l'élément en display block (assurez-vous que l'élément est caché initialement)
textElement.style.display = 'block';

const speed = 30; // Vitesse d'apparition (en ms)
let index = 0;

function typeWriter() {
    if (index < originalText.length) {
        textElement.textContent += originalText.charAt(index);
        index++;
        setTimeout(typeWriter, speed);
    }
}

// Lancer l'effet
typeWriter();
