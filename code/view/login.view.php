<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
      <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

  <meta charset="utf-8">
  <title>Se connecter</title>
  <link rel="stylesheet" href="./view/design/login.css">
</head>

<body>
  <?php include_once './view/header.view.php'; ?>
  <main>
    <h1>Se connecter</h1>
    <form action="">
      <div class="infos">
        <div>
          <label for="mail">Adresse mail : </label>
          <input type="email" name="mail" id="mail" placeholder="jean@jaimail.com">
        </div>
        <div>
          <label for="password">Mot de passe : </label>
          <input type="password" name="password" id="password" placeholder="*******">
        </div>
      </div>
      <a href="./view/main.view.php">
        <button class="connecter">Se connecter</button>
      </a>
      <div class="buttons">
        <a href="./view/motdepasseoublie.view.php">
          <button class="button-gris button">Mot de passe oublié</button>
        </a>
        <a href="./view/createAccount.view.php">
          <button class="button-gris button">Créer un compte</button>
        </a>
      </div>
    </form>
    
  </main>
  <?php include_once './view/footer.view.php'; ?>
</body>
<script src="./view/js/dyslexique.js"></script>

</html>