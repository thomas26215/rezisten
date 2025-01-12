<!DOCTYPE html>
<html lang="fr">

<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Leaflet</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    
</head>

<body>
    <div id="map"></div>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Initialiser la carte
        var map = L.map('map').setView([<?php $COORDONNEEX ?>,<? $COORDONNEEY /*On peux tout mettre en 1 je pense demander a Quentin*/ ?>], 13);

        // Ajouter les tuiles de la carte (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Ajouter un marqueur pour les coordonnées spécifiées
        L.marker([<?php $COORDONNEEX ?>,<? $COORDONNEEY /*On peux tout mettre en 1 je pense demander a Quentin*/ ?>]).addTo(map)
            .bindPopup("L'emplacement du lieu")
            .openPopup();
    </script>
</body>
    <script src="./js/dyslexique.js"></script>
    <script>
        // Vérifiez si le mode dyslexique est activé dans le localStorage
        if (localStorage.getItem('dyslexique') === 'true') {
            document.body.classList.add('dyslexique');
        }

        // Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
        document.getElementById('toggleDyslexique').addEventListener('click', function() {
            document.body.classList.toggle('dyslexique');
            // Stockez la préférence dans le localStorage
            localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
        });
    </script>
    <script>
        // Vérifiez si le mode dyslexique est activé dans le localStorage
        if (localStorage.getItem('dyslexique') === 'true') {
            document.body.classList.add('dyslexique');
        }

        // Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
        document.getElementById('toggleDyslexique').addEventListener('click', function() {
            document.body.classList.toggle('dyslexique');
            // Stockez la préférence dans le localStorage
            localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
        });
    </script>
    <script>
        // Vérifiez si le mode dyslexique est activé dans le localStorage
        if (localStorage.getItem('dyslexique') === 'true') {
            document.body.classList.add('dyslexique');
        }

        // Ajoutez un écouteur d'événement au bouton pour basculer le mode dyslexique
        document.getElementById('toggleDyslexique').addEventListener('click', function() {
            document.body.classList.toggle('dyslexique');
            // Stockez la préférence dans le localStorage
            localStorage.setItem('dyslexique', document.body.classList.contains('dyslexique'));
        });
    </script>

</html>