const openButton = document.getElementById("ouvrirDialog");
const dialog = document.getElementById("dialog");
const closeButtonPublier = document.getElementById("fermerPublier");
const closeButtonRevenir = document.getElementById("fermerRevenir");

openButton.addEventListener("click", () => {
  dialog.showModal();
});

closeButtonPublier.addEventListener("click", () => {
  dialog.close();
});

closeButtonRevenir.addEventListener("click", () => {
  dialog.close();
});
