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
        <h1>Les Chapitres</h1>
        <a href="$Chapitre1">
            <button class="button-gris" type="submit">Chapitre $numChapitre</button>
        </a>
        <a class="bloque" href="$Chapitre2">
            <button class="button-gris" type="submit">Chapitre $numChapitre <img class="img-button"
                    src="./design/image/cadenas.png" alt="(Bloqué)">
            </button>
            <div class="msgCreateur">Terminer le chapitre $numChapitre </div>
        </a>
        <a>
            <button class="button-gris" type="submit">Chapitres des créateurs</button>
        </a>
        <a>
            <button class="button-bleu" type="submit">Recommencer tout <img class="img-button"
                    src="./design/image/recommencer.png" alt="(Reload)"> </button>
        </a>
    </main>
    <?php include_once 'footer.view.php'; ?>

</body>

</html>