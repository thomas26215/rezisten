<?php
include_once('./model/users.class.php');
?>


<head>
   <link rel="icon" href="./view/favicon.ico" type="image/x-icon">

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./view/design/headerHistoire.css">
</head>

<header>
   <a href="./index.php?ctrl=main" class="home">
      <img src="./view/design/image/home.png" alt="home">
      <p class="accueil-text">Accueil</p>
   </a>
   <a href="./index.php?ctrl=profil" class="flex-col">
      <img class="img-profile" src="./view/design/image/photoProfil.jpg" alt="user">
      <p class="nomUser"><?= (User::read((int) $_SESSION['user_id']))->getUsername() ?></p>
      <!-- affichage du pseudo du user -->
   </a>
</header>