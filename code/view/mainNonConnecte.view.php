<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./design/mainNonConnecte.css">
</head>

<body>
    <main class="flex-col">
        <div class="flex-row">
            <h1 class="title">Bienvenue sur :</h1>
            <img id="logo" src="./design/image/logo.png" alt="Logo Rézisten">
        </div>
        <h1>Vivez la résistance à la française !</h1>
        <div class="flex-row">
            <a href="./login.view.php"><button>Se connecter</button></a>
            <a href="./createAccount.view.php"><button>Créer un compte</button></a>
        </div>
    </main>
    <?php include_once 'footer.view.php'; ?>

</body>

</html>