<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
$imgPath = './public/img/';

//Connexion à la BDD
$db = pg_connect("host=192.168.14.118 port=5432 dbname=rezisten user=admin_rezisten password=20ReZist25");

$query_titre = 'SELECT titre FROM HISTOIRES WHERE id_histoire=1';
$resTitre = pg_query($db, $query_titre);
$titre = pg_fetch_assoc($resTitre);

$query_persos = 'SELECT nom,prenom,img FROM PERSONNAGES p, APPARITION a WHERE id_histoire=1 AND a.id_perso=p.id_perso';
$resPersos = pg_query($db, $query_persos);
$persos = pg_fetch_all($resPersos);

$query_dialogue = 'SELECT contenu FROM DIALOGUES WHERE id_histoire=1';
$resDial = pg_query($db, $query_dialogue);
$dialogue = pg_fetch_all($resDial);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeu</title>
    <link rel="stylesheet" href="jeu.css">
</head>

<body>
    <h1><?= $titre['titre'] ?></h1>
    <main>
        <section id="persos">
            <?php foreach ($persos as $personnage): ?>
                <img src="<?= $imgPath . $personnage['img'] ?>" alt="">
            <?php endforeach; ?>
        </section>
        <div id="dial">
            <h2>Jean</h2>
            <p><?= $dialogue[0]['contenu'] ?></p>

        </div>
    </main>



</body>

</html>