<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design/mainNonConnecte.css">
</head>
<body>
    <?php include_once 'headerHistoire.view.php'; ?>
    <main class="flex-col">
        <h1>Création d'histoire</h1>
        <section>
            <label for="objet">Titre :</label>
            <input type="text" id="objet" name="objet" value="" required placeholder="Sabotage">
        </section>
        
    </main>
    <?php include_once 'footer.view.php'; ?>
</body>

</html>