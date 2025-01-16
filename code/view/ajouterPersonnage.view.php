<article class="content">

    <form method="post" action="index.php?ctrl=personnages&article=ajouterPersonnage&id=<?= $id ?>" class="articleContainer" enctype="multipart/form-data">
        <input type="hidden" name="ctrl" value="personnages">
        <input type="hidden" name="article" value="ajouterPersonnage">
        <input type="hidden" name="action" value="ajouterCharacter">

        <div class="noms">
            <div>
                <label for="prenom">Prénom</label>
                <input maxlength="15" type="text" id="prenom" name="prenom" placeholder="Pierre">
            </div>
           
        </div>

        <div class="image">
            <div class="imageChoisi">
                <p>Image</p>
                <input type="file" id="photoUpload" name="photoUpload" accept="image/*" style="display: none;">
                <img id="photoSend" src="./view/design/image/upload.png" alt="">
                <span id="fileName">Pas de fichier ajoutée</span>
            </div>

            <div class="imageUser">
                <img id="img" src="#" alt="Image preview" style="display: none; max-width: 240px;">
            </div>
        </div>

        <button type="submit">Ajouter personnage</button>
    </form>

</article>