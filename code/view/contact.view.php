<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Rézisten</title>
        <meta name="author" content="Groupe 11" />
    </head>
    <body>
        <h1>Nous contacter</h1>
        <form action="" method="post"> <!-- TO DO : conpléter le php (Thomas) -->
        <label for="mail">Adresse mail :</label>
        <input type="text" id="mail" name="mail" value="" required>
        <label for="objet">Objet :</label>
        <input type="text" id="objet" name="objet" value="" required>
        <label for="contenue">Contenue de votre message :</label>
        <input type="text" id="contenue" name="contenue" value="" required>
        </form>
    </body>
    <?php include_once("footer.view.php"); ?>
</html>
