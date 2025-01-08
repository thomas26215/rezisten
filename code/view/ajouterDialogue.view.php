<head>
    <link rel="icon" href="favicon.ico" type="image/x-icon">    
    <link rel="stylesheet" href="./design/ajouterDialogue.css">
</head>
<article class="content">
    <div>
        <h2 class="titre"> Ajouter un dialogue </h2>
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
        <section>
            <label for="dialogue">Entrez le texte du dialogue : </label>
            <textarea name="dialogue" id="dialogue"></textarea>
        </section>

        <!-- boutons -->
        <section>
            <button class=button-rouge>Supprimer</button>
            <button class=button-vert>Valider</button>
        </section>
    </form>
</article>