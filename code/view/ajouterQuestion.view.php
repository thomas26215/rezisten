<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/ajouterQuestion.css">
</head>
<article class="content">
    <div>
        <h2 class="titre"> Ajouter une question</h2>
    </div>
    <form action="creation" method="get">
        <input type="hidden" name="ctrl" value="creation">
        <input type="hidden" name="article" value="ajouterQuestion">
        <input type="hidden" name="id" value="<?= $histoire->getId() ?>">

        <!-- Question -->
        <section class="input-superpose">
            <label for="question">Entrez la question : </label>
            <textarea name="question" id="question"></textarea>
        </section>

        <!-- Réponse -->
        <section class="input-superpose">
            <label for="reponse">Entrez la réponse : </label>
            <input type="number" name="reponse" id="reponse"></input>
        </section>

        <!-- boutons -->
        <section>
            <button class="button-rouge" type="reset">Supprimer</button>
            <button class="button-vert" type="submit">Valider</button>
        </section>
    </form>
</article>