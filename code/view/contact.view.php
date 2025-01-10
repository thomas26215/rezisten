<!DOCTYPE html>
<html lang="fr">
    <head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
        <meta charset="utf-8">
        <title>Rézisten</title>
        <meta name="author" content="Groupe 11" />
        <link rel="stylesheet" type="text/css" href="./view/design/contact.css">
    </head>
    <body> 
        <?php include_once("./view/header.view.php")?>
        <main>
            <h1>Nous contacter</h1>
            <form action="" method="post"> <!-- TO DO : conpléter le php (Thomas) -->
                <article>
                    <section>
                        <label for="mail">Adresse mail :</label>
                        <input type="text" id="mail" name="mail" value="" required  placeholder="jean@gmail.com" >
                    </section>
                    <section>
                        <label for="objet">Objet :</label>
                        <input type="text" id="objet" name="objet" value="" required>
                    </section>
                </article>
                    <section>
                        <label for="contenu">Contenue de votre message :</label>
                        <textarea name="contenu" id="contenu"></textarea>
                    </section>
                
                <div><button>Envoyer</button></div>
            </form>
        </main>
    </body>
    <script src="./view/js/dyslexique.js"></script>
    <?php include_once("./view/footer.view.php"); ?>
</html>
