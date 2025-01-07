<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapitre</title>
    <link rel="stylesheet" href="./design/chapitre.css">
</head>

<body>
    <?php include_once 'headerHistoire.view.php'; ?>

    <main class="flex-col">
        <div>
            <h1>$NomChapitre</h1>
            <h2>Les Histoires</h2>
        </div>

        <a href="$Histoire1">
            <button class="button-gris" type="submit">$nomHistoire</button>
        </a>
        <a class="bloque">
            <button class="button-gris" type="submit">$nomHistoire <img class="img-button"
                    src="./design/image/cadenas.png" alt="(Bloqué)">
            </button>
            <div class="msgCreateur">Terminer l’histoire précédente</div>
        </a>

    </main>
    <?php include_once 'footer.view.php'; ?>

</body>

</html>