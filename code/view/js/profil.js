const openDeconnecter = document.getElementById("openDeconnecter");
const fermerDeconnecter = document.getElementById("fermerDeconnecter");
const revenirDeconnecter = document.getElementById("revenirDeconnecter");
const dialogDeconnecter = document.getElementById("dialogDeconnecter");
//

/* Ouvir */
openDeconnecter.addEventListener("click", () => {
    dialogDeconnecter.showModal();
});
/* ferme */
fermerDeconnecter.addEventListener("click", () => {
    dialogDeconnecter.close();
});
/* Action + ferme */
revenirDeconnecter.addEventListener("click", () => {
    dialogDeconnecter.close();
});