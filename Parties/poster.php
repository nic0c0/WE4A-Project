<?php
    // Récupération des données utilisateur à partir de la base de données
    $user_data = $conn->getUserData($username);
    $user_id = $user_data['user_id'];   

    //Traitement des données soumises par le formulaire
    if(isset($_POST['save'])){
        $post_title = $_POST['post_title'];
        $post_text = $_POST['post_text'];
    
    $postid=$conn->getUserPostCount($user_id);
    //sauvegarde de l'image
    $post_img=saveImageAsNew($user_id,false,$postid);
    //Mise à jour de la base de données
    $conn->insertPost($user_id, $post_title, $post_text, $post_img);
    }
?>


<div class="poster">
    <div class="img-container">
        <img id="blah" src="./IMG/img.png" alt="your image" />
    </div>
    <form  method="post" enctype="multipart/form-data" > <!-- add le action -->
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

            <label for="post_text">Description:</label>
            <textarea id="post_text" name="post_text" rows="5" cols="40" required></textarea>
            <button name="save" type="submit" >Sauvegarder</button>

        </div>
    </form>
</div>


