<!DOCTYPE html>
<html lang="fr">
<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter le lieu</title>
    <link rel="stylesheet" href="./view/design/consulterLieu.css">
</head>
<body>
    <?php include_once './view/header.view.php'; ?>
    <main>
        <h1>Informations sur le lieu le lieu</h1>

        <h2><?=$place->getName()?></h2>

        <div class="infoContainer">
            <img src="<?=$imgLieu?>" alt="<?=$place->getName()?>">
            <div class="info">
                <div>
                    <h3>Type de lieu : </h2>
                    <p><?=$place->getPlaceType()?></p>
                </div>
                <div>
                    <h3>Localisation : </h2>
                    <p><?=$place->getCity()?></p>
                </div>
            </div>
        </div>

        <div class="description">
            <h3 >Description : </h2>
            <p><?=$place->getDescription()?></p>
        </div>
        <p>Voir sur Google Maps : <a href="https://www.google.fr/maps/place/<?=$place->getName()?>/">Cliquez ici</a></p>

        <?php include_once 'APImap.view.php'; ?>
    </main>
    <div id="map" style="height: 500px;"></div>

    <!-- Inclusion de la bibliothèque Leaflet -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Récupération des coordonnées à partir des variables PHP
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


    <?php include_once './view/footer.view.php'; ?>
</body>
    <script src="./view/js/dyslexique.js"></script>
</html>