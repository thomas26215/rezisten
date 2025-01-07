const fileInput = document.getElementById('photoUpload');
const photoSend = document.getElementById('photoSend');
const fileNameDisplay = document.getElementById('fileName');

photoSend.addEventListener('click', function() {
    fileInput.click();
});

fileInput.addEventListener('change', function() {
    if (this.files && this.files[0]) {
        fileNameDisplay.textContent = this.files[0].name;
    } else {
        fileNameDisplay.textContent = 'No file chosen';
    }
});
