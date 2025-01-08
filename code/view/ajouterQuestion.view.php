<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
    <link rel="stylesheet" href="./design/ajouterQuestion.css">
</head>
<article class="content">
    <div>
        <h2 class="titre"> Ajouter une question</h2>
    </div>
    <form action="">
        <!-- personnage -->
        <section>
            <label for="personnage">Personnage qui parle : </label>
            <select name="nom">
                <option value="A">Pierre</option><!-- mettre un foreache -->
                <option value="B">Paul</option>
                <option value="-">Jaques</option>
            </select>
        </section>

        <!-- dialogue -->
        <section class="input-superpose">
            <label for="question">Entrez la question : </label>
            <textarea name="question" id="question"></textarea>
        </section>

        <!-- dialogue -->
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