<head>
    <link rel="icon" href="./view/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="./view/design/ajouterDialogue.css">
</head>
<article class="content"> 
    <form action="creation" method="get">
        <input type="hidden" name="ctrl" value="creation">
        <input type="hidden" name="article" value="ajouterDialogue">
        <input type="hidden" name="id" value="<?= $histoire->getId() ?>">

        <section>
            <label for="personnage">Personnage qui parle : </label>
            <select name="nom">
                <?php foreach ($personnages as $perso) : ?>
                <option value="<?= $perso->getFirstName() ?>"><?= $perso->getFirstName()?></option>
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
            <button class="button-rouge" type="reset">Supprimer</button>
            <button class="button-vert" type="submit">Valider</button>
        </section>
    </form>
</article>