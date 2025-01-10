const openQuitter = document.getElementById("dialogQuitter");
const openPublier = document.getElementById("dialogPublier");
const dialog = document.getElementById("dialog");
const closeButtonPublier = document.getElementById("fermerPublier");
const closeButtonRevenir = document.getElementById("fermerRevenir");

openQuitter.addEventListener("click", () => {
  dialog.showModal();
});

openPublier.addEventListener("click", () => {
  dialog.showModal();
});

closeButtonPublier.addEventListener("click", () => {
  dialog.close();
});

closeButtonRevenir.addEventListener("click", () => {
  dialog.close();
});
