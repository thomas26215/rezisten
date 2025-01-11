<head>
        <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    
    <link rel="stylesheet" href="./view/design/ajouterDialogue.css">
</head>
<article class="content"> 
    <div>
        <h2 class="titre"> Ajouter un dialogue </h2>
    </div>
    <form action="creation" method="get">
        <!-- personnage 
        <section>
            <label for="personnage">Personnage qui parle : </label>
            <select name="nom">
                <option value="A">Pierre</option>
                <option value="B">Paul</option>
                <option value="-">Jaques</option>
            </select>
        </section>
        

        
        -->

        <section>
            <label for="personnage">Personnage qui parle : </label>
            <select name="nom">
                <?php foreach ($personnages as $perso) : ?>
                <option value="A"><?= $perso?></option>
                <?php endforeach; ?>
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
            <button class=button-vert >Valider</button>
        </section>
    </form>
</article>