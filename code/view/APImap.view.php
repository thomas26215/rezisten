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
<script>
    // Récupérer les coordonnées transmises par le fichier principal
    var lat = <?php echo $latitude; ?>;
    var lon = <?php echo $longitude; ?>;

    // Initialisation de la carte centrée sur les coordonnées obtenues
    var map = L.map('map').setView([lat, lon], 13);

    // Ajouter les tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Ajouter un marqueur à la position (lat, lon) et ajouter un popup
    L.marker([lat, lon]).addTo(map)
        .bindPopup("Emplacement du lieu")
        .openPopup();
</script>

</body>
   
</html>