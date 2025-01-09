<article class="content">

    <h2 class="titre">Modifier un personnage</h2>

    <div class="articleContainer">
        <div class="personnage">
            <label for="personnage">Personnage à modifier : </label>
            <select name="personnage">
                <option value="A">Jean</option><!-- mettre un foreache -->
                <option value="B">a</option>
                <option value="-">b</option>
            </select>
        </div>
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
                <img id="photoSend" src="./design/image/upload.png" alt="">
                <span id="fileName">Pas de fichier ajoutée</span>
            </div>

            <div class="imageUser">
                <img id="img" src="#" alt="Image preview" style="display: none; max-width: 240px;">
            </div>
        </div>
    </div>

</article>