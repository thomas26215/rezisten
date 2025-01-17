const textElement = document.querySelector(".text");

// Récupérer le texte de l'élément et supprimer les sauts de ligne et espaces superflus
const originalText = textElement.textContent.replace(/\s+/g, " ").trim();

// Vider l'élément
textElement.textContent = "";

// Mettre l'élément en display block (assurez-vous que l'élément est caché initialement)
textElement.style.display = "block";

// Créer un curseur
const cursorElement = document.createElement("span");
cursorElement.textContent = "|";
cursorElement.style.display = "inline-block"; // Assure que le curseur reste visible
cursorElement.style.opacity = "1"; // Initialisation de l'opacité
textElement.appendChild(cursorElement);

const baseSpeed = 30; // Vitesse de base (en ms)
let index = 0;
let blinkInterval = null; // Variable pour gérer l'intervalle de clignotement

// Fonction pour activer le clignotement du curseur
function startBlinking() {
    if (!blinkInterval) {
        blinkInterval = setInterval(() => {
            cursorElement.style.opacity =
                cursorElement.style.opacity === "1" ? "0" : "1";
        }, 700);
    }
}

// Fonction pour désactiver le clignotement du curseur
function stopBlinking() {
    clearInterval(blinkInterval);
    blinkInterval = null;
    cursorElement.style.opacity = "1"; // Assure que le curseur reste visible pendant l'écriture
}

// Fonction pour obtenir une vitesse aléatoire
function getRandomSpeed(baseSpeed, variance) {
    return Math.max(10, baseSpeed + Math.random() * variance - variance / 2);
}

// Fonction pour déterminer le temps de pause après un caractère
function getPauseTime(char) {
    switch (char) {
        case ".":
        case "!":
        case "?":
            return 500; // Pause plus longue après ces caractères
        case ",":
        case ";":
        case ":":
            return 250; // Pause courte après ces caractères
        default:
            return 0; // Pas de pause par défaut
    }
}

// Fonction pour faire défiler le texte vers le bas
function scrollToBottom() {
    textElement.parentElement.scrollTop =
        textElement.parentElement.scrollHeight;
}

// Fonction pour l'effet de défilement du texte
function typeWriter() {
    stopBlinking(); // Désactiver le clignotement pendant l'écriture

    if (index < originalText.length) {
        textElement.insertBefore(
            document.createTextNode(originalText.charAt(index)),
            cursorElement,
        );
        index++;
        scrollToBottom();

        // Ajuster la vitesse en fonction du caractère actuel
        const char = originalText.charAt(index - 1);
        const speedAdjustment = getPauseTime(char) > 0 ? 100 : 20; // Plus lent après ponctuation

        setTimeout(
            () => {
                typeWriter();
            },
            getRandomSpeed(baseSpeed + speedAdjustment, 10),
        );
    } else {
        startBlinking(); // Réactiver le clignotement quand l'écriture est terminée
    }
}

// Lancer l'effet
typeWriter();
