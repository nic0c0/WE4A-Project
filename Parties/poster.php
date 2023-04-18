<?php
    $user_data = $conn->getUserData($username);
    if($user_data != false && is_array($user_data)){
        $user_id = $user_data['user_id'];   

        //Traitement des données soumises par le formulaire
        
    } else {
        echo "Erreur lors de la récupération des données utilisateur";
    }

?>


<div class="poster">
    <div class="img-container">
        <img id="blah" src="./IMG/img.png" alt="your image" />
    </div>
    <form  action="./redirect.php"method="post" enctype="multipart/form-data" > <!-- add le action -->
        <fieldset class="posterset">
            <legend>Mettre une Image</legend>
            <div class="img-upload">
                <label id="imgUpload">
                    <input accept="image/*" type='file' id="imgInp" name="post_img" />
                </label>
            </div>
        </fieldset>
        <div class="desc">
            <label for="post_title">Titre:</label>
            <input type="text" id="post_title" name="post_title" required>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="path" value="<?php echo basename(__FILE__); ?>">
            <label for="post_text">Description:</label>
            <textarea id="post_text" name="post_text" rows="5" cols="40" required></textarea>
            <button name="save" type="submit" >Sauvegarder</button>

        </div>
    </form>
</div>


