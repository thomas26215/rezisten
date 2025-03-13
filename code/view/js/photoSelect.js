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
        const reader = new FileReader();
        reader.onload = function(e) {
            img.style.display = 'block';
            img.src = e.target.result;
        }
        reader.readAsDataURL(this.files[0]); 
    } else {
        fileNameDisplay.textContent = 'Pas de fichier ajoutée';
    }
});
