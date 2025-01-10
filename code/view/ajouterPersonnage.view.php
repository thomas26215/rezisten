<article class="content">

    <h2 class="titre">Ajouter un personnage</h2>

    <div class="articleContainer">
        <div class="noms">
            <div>
                <label for="prenom">Prénom</label>
                <input maxlength="15" type="text" placeholder="Pierre">
            </div>
            <div>
                <label for="nom">Nom</label>
                <input maxlength="25" type="text" placeholder="Dupont">
            </div>
        </div>

        <div class="image">
            <div class="imageChoisi">
                <p>Image</p>
                <input type="file" id="photoUpload" name="photo" accept="image/*" style="display: none;">
                <img id="photoSend" src="./view/design/image/upload.png" alt="">
                <span id="fileName">Pas de fichier ajoutée</span>
            </div>

            <div class="imageUser">
                <img id="img" src="#" alt="Image preview" style="display: none; max-width: 240px;">
            </div>
        </div>
    </div>

</article>