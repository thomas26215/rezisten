<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title>Se connecter</title>
  <link rel="stylesheet" href="../design/style.css">
</head>
<body>
  <main>
    <form action="login.ctrl.php" method="post">
      <label>Adresse mail : </label>
      <input type="text" name="mail_adress">
      <label>Mot de passe : </label>
      <input type="password" name="password">
      <button type="submit" name="submit" value="login">Login</button>
      <button type="submit" name="submit" value="password">Forgotten password? </button>
      <button type="submit" name="submit" value="new">Create new Account</button>
    </form>
  </main>
</body>
    <script src="./js/dyslexique.js"></script>
</html>
