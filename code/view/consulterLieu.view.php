<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter le lieu</title>
    <link rel="stylesheet" href="design/consulterLieu.css">
</head>
<body>
    <?php include_once 'header.view.php'; ?>
    <main>
        <h1>Consulter le lieu</h1>

        <h2>Mémorial national Prison de Montluc</h2>

        <div class="infoContainer">
            <img src="design/image/memorial.jpeg" alt="mémorial national prison de montluc">
            <div class="info">
                <div>
                    <h3>Type de lieu : </h2>
                    <p>Cimetiere</p>
                </div>
                <div>
                    <h3>Localisation : </h2>
                    <p>Lyon (Rhône)</p>
                </div>
            </div>
        </div>

        <div class="description">
            <h3 >Description : </h2>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima praesentium optio pariatur, non provident et illum asperiores! Autem consectetur beatae earum perferendis! Qui iusto minus corrupti voluptates earum deserunt illum.</p>
        </div>
        <?php include_once 'APImap.view.php'; ?>
    </main>
    <?php include_once 'footer.view.php'; ?>
</body>
</html>