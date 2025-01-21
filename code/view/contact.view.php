<!DOCTYPE html>
<html lang="fr">
    <head>
        <link rel="icon" href="view/favicon.ico" type="image/x-icon">
    
        <meta charset="utf-8">
        <title>Rézisten</title>
        <meta name="author" content="Groupe 11" />
        <link rel="stylesheet" type="text/css" href="view/design/global.css">
        <link rel="stylesheet" type="text/css" href="view/design/contact.css">
    </head>
    <body> 
        <?php include_once("view/headerPageSpeciales.view.php")?>
        <main>
            <h1>Nous contacter</h1>
            <?php if (isset($message)): ?>
                <p><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <form action="?ctrl=contact" method="post">
                <article>
                    <section>
                        <label for="mail">Adresse mail :</label>
                        <input type="email" id="mail" name="mail" value="" required placeholder="jean@gmail.com">
                    </section>
                    <section>
                        <label for="objet">Objet :</label>
                        <input type="text" id="objet" name="objet" value="" required>
                    </section>
                </article>
                <section>
                    <label for="contenu">Contenu de votre message :</label>
                    <textarea name="contenu" id="contenu" required></textarea>
                </section>
                
                <div><button type="submit">Envoyer</button></div>
            </form>
        </main>
    </body>
    <script src="./js/dyslexique.js"></script>
    <?php include_once("view/footerPageSpeciales.view.php"); ?>
</html>

