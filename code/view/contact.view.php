<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Rézisten</title>
        <meta name="author" content="Groupe 11" />
        <link rel="stylesheet" type="text/css" href="./design/contact.css">
    </head>
    <body>
        <h1>Nous contacter</h1>
        <form action="" method="post"> <!-- TO DO : conpléter le php (Thomas) -->
            <article>
                <section>
                    <label for="mail">Adresse mail :</label>
                    <input type="text" id="mail" name="mail" value="" required>
                </section>
                <section>
                    <label for="objet">Objet :</label>
                    <input type="text" id="objet" name="objet" value="" required>
                </section>
                <section>
                    <label for="contenue">Contenue de votre message :</label>
                    <input type="text" id="contenue" name="contenue" value="" required>
                </section>
            </article>
            <button>Envoyer</button>
        </form>
    </body>
    <?php include_once("footer.view.php"); ?>
</html>
