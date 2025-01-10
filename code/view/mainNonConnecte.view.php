<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./view/design/mainNonConnecte.css">
</head>

<body>
    <main class="flex-col">
        <div class="flex-row">
            <h1 class="title">Bienvenue sur :</h1>
            <img id="logo" src="./view/design/image/logo.png" alt="Logo Rézisten">
        </div>
        <h1>Vivez la résistance à la française !</h1>
        <form action="index.php" method="get">
            <button type="submit" name="action" value="login">Se connecter</button>
            <button type="submit" name="action" value="createAccount">Créer un compte</button>
            <input type="hidden" name="ctrl" value="mainNonConnecte">
    </form>
    </main>
    <?php include_once './view/footer.view.php'; ?>

</body>
    <script src="./view/js/dyslexique.js"></script>

</html>