<div class="poster">
    <div class="img-container">
        <img id="blah" src="./IMG/img.png" alt="your image" />
    </div>
        <form class="posterset">
            <fieldset>
            <legend>Mettre une Image</legend>
            <div class="img-upload">
                <label id="imgUpload">
                <input accept="image/*" type='file' id="imgInp" />
                </label>
            </div>
            <button class="btn button full" type="submit" disabled="">Sauvegarder</button>
            </fieldset>
        </form>

    <div class="desc">
    <form>
        <label for="titre">Titre:</label>
        <input type="text" id="titre" name="titre" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="5" cols="40" required></textarea>

        <label for="info">Info:</label>
        <input type="text" id="info" name="info" required>
    </form>
    </div>
</div> 

