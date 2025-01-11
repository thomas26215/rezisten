<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapitre</title>
    <link rel="stylesheet" href="./view/design/chapitre.css">
</head>

<body>
    <?php include_once './view/headerHistoire.view.php'; ?>

    <main class="flex-col">
        <div>
            <h1><?=$nomChap?></h1>
            <h2>Les Histoires</h2>
        </div>
      <?php
     
      ?>



        <a href="$Histoire1">
            <button class="button-gris" type="submit">$nomHistoire</button>
        </a>
        <a class="bloque">
            <button class="button-gris" type="submit">$nomHistoire <img class="img-button"
                    src="./view/design/image/cadenas.png" alt="(Bloqué)">
            </button>
            <div class="msgCreateur">Terminer l’histoire précédente</div>
        </a>
        <a href="$Histoire1">
            <button class="button-gris" type="submit">$nomHistoire</button>
        </a>
        <a class="bloque">
            <button class="button-gris" type="submit">$nomHistoire <img class="img-button"
                    src="./view/design/image/cadenas.png" alt="(Bloqué)">
            </button>
            <div class="msgCreateur">Terminer l’histoire précédente</div>
        </a>

    </main>
    <?php include_once './view/footer.view.php'; ?>

</body>
    <script src="./view/js/dyslexique.js"></script>

</html>