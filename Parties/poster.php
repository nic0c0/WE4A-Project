<?php
    $user_data = $conn->getUserData($username);
    if($user_data != false && is_array($user_data)){
        $user_id = $user_data['user_id'];   
        
    } else {
        echo "Erreur lors de la récupération des données utilisateur";
    }

    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];

    }

    isset($post_id)?$post_data=$conn->getPostData($post_id):'';

?>


<div class="poster">
    <div class="img-container">
    <img id="blah" src="<?php echo (isset($post_data['post_img']))? $post_data['post_img'] : './IMG/img.png'; ?>" alt="Votre image" />
    </div>
    <form  class="desc" action="./redirect.php"method="post" enctype="multipart/form-data" >
        <fieldset class="posterset">
            <legend>Mettre une Image</legend>
            <div class="img-upload">
                <label id="imgUpload">
                <input accept="image/*" type='file' id="imgInp" name="post_img"<?php echo(!isset($post_id)?'required':'') ; ?> />
                </label>
            </div>
        </fieldset>
        <div>
            <label for="post_title">Titre:</label>
            <input type="text" id="post_title" name="post_title" value="<?php echo (isset($post_data['post_title'])?$post_data['post_title']:'')?>" required>
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="path" value="<?php echo basename(__FILE__); ?>">
            <input type="hidden" name="request" value="<?php echo(isset($post_id)?$post_id:false) ; ?>">
            <label for="post_text">Description:</label>
            <textarea id="post_text" name="post_text" rows="5" cols="40" required><?php echo isset($post_data['post_text']) ? $post_data['post_text'] : ''; ?></textarea>
            <button name="save" type="submit" >Sauvegarder</button>

        </div>
    </form>
</div>


