const homeOuvrir = document.getElementById("homeOuvrir");
const fermerHome = document.getElementById("fermerHome");
const revenirHome = document.getElementById("revenirHome");
const idDialogue = document.getElementById("dialogHome");
//

/* Ouvir */
homeOuvrir.addEventListener("click", () => {
    idDialogue.showModal();
});
/* ferme */
fermerHome.addEventListener("click", () => {
    idDialogue.close();
});
/* Action + ferme */
revenirHome.addEventListener("click", () => {
    idDialogue.close();
});