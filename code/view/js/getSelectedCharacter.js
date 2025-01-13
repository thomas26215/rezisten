function getSelectedCharacter() {
    var select = document.getElementById("personnage");
    var selectedCharacterId = select.value;
    
    // Make an AJAX request to the controller
    fetch('index.php?action=getCharacter&id=' + selectedCharacterId)
    .then(response => response.json())
    .then(data => {
        // Update the view with the received data
            document.getElementById('characterFirstName').textContent = data.firstName;
            document.getElementById('characterImage').src = data.image;
            document.getElementById('characterImage').alt = data.firstName;
    })
    .catch(error => console.error('Error:', error));
}