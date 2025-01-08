const fileInput = document.getElementById('photoUpload');
const button = document.getElementById('photoSend');
const fileNameDisplay = document.getElementById('fileName');
const img = document.getElementById('img');

button.addEventListener('click', function() {
    fileInput.click();
});

fileInput.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        fileNameDisplay.textContent = this.files[0].name;
       
    } else {
        fileNameDisplay.textContent = 'Pas de fichier ajoutée';
    }
});
