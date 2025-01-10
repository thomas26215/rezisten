<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./design/mainNonConnecte.css">
</head>

<body>
    <main class="flex-col">
        <div class="flex-row">
            <h1 class="title">Bienvenue sur :</h1>
            <img id="logo" src="./design/image/logo.png" alt="Logo Rézisten">
        </div>
        <h1>Vivez la résistance à la française !</h1>
        <div class="flex-row div-button">
            <a href="./login.view.php"><button>Se connecter</button></a>
            <a href="./createAccount.view.php"><button>Créer un compte</button></a>
        </div>
        <form action="mainNonConnecte.ctrl.php" method="post">
            <button type="submit" name="action" value="connect">Se connecter</button>
        </form>
    </main>
    <?php include_once 'footer.view.php'; ?>

</body>
    <script src="./js/dyslexique.js"></script>

</html>