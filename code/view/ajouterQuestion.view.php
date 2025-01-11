<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="./view/design/ajouterQuestion.css">
</head>
<article class="content">
    <div>
        <h2 class="titre"> Ajouter une question</h2>
    </div>
    <form action="">

        <!-- Question -->
        <section class="input-superpose">
            <label for="question">Entrez la question : </label>
            <textarea name="question" id="question"></textarea>
        </section>

        <!-- Réponse -->
        <section class="input-superpose">
            <label for="reponse">Entrez la réponse : </label>
            <textarea name="reponse" id="reponse"></textarea>
        </section>

        <!-- boutons -->
        <section>
            <button class=button-rouge>Supprimer</button>
            <button class=button-vert>Valider</button>
        </section>
    </form>
</article>