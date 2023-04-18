<?php include("./Parties/head.php") ?>
<?php include("./Parties/Classes.php")?>
<?php

$cook = new Cookie();
// Vérification si l'utilisateur est authentifié
if ($cook->IssetCookie()) {

    // Connexion à la base de données
    $conn = new SQLconn();
    ?>
<?php include("./Parties/header.php"); ?>
<body>
<?php

    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $user_pseudo=$conn->getUserPseudo($conn->getUserIdFromPostId($post_id));
    }


    $com_id=1;
    $post_data = $conn->getPostData($post_id);

    if($post_data!==false){//si le post existe
        $post_title = $post_data['post_title'];
        $post_text = $post_data['post_text'];
        $post_img = $post_data['post_img'];
        $post_time = $post_data['created_time'];

        $com_data=$conn->getComData($com_id);
        if($com_data!=false){//si le commentaire existe
            $com_text=$com_data['comment_text'];
            $com_time=$com_data['created_time'];
        }
    //Nom de l'utilisateur actuel :
    $actual_user=$conn->getUserData($user_pseudo)['user_id'];

?>
    <div class="center">

<div class="post">
    <div class="left">
        <h1><?php echo "$post_title"?> </h1>
        <div class="img-container">
          <img src="<?php echo "$post_img"?>" alt="<?php echo "$post_title"?>">
        </div>
    </div>
    <div class="com"> 
        <p>
        <?php echo (isset($com_text) ? $com_text . " le " . (isset($com_time)? $com_time : '') : ''); ?>
        </p>
        <p>
            Whouah
        </p>
        <form method="post" action="redirect.php">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="hidden" name="commenter" value="<?php echo $actual_user ?>"><!--ici on récupère l'id de l'utilisateur qui commente puis on l'envoie -->
        <input type="hidden" name="path" value="<?php echo basename(__FILE__); ?>">

        <label for="comment_text">Commentaire :</label><br>
        <textarea name="comment_text" id="comment_text" rows="3" cols="40"></textarea><br>
        <input type="submit" value="Sauvegarder" name="com">
</form>
    </div>
    <div class="desc">
        <?php 
            $user_id=$conn->getUserIdFromPostId($post_id);
            $user_pseudo=$conn->getUserPseudo($user_id);
        ?>
        <form action="./Profil.php?pseudo=<?php echo $user_pseudo?> " method="post">
        <input type="submit" value="VOIR LE PROFIL">
        </form>
        <?php
            $num_likes = $conn->getNumLikes($post_id);
            $this_user_id=$conn->getUserData($cook->getUsername())['user_id'];
            ?>
            <form method='post' action="./redirect.php">
            <input type='hidden' name='post_id' value='<?php echo $post_id ?>'>
            <input type='hidden' name='user_id' value='<?php echo $this_user_id?>'>
            <input type="hidden" name="path" value="<?php echo basename(__FILE__); ?>">
            <button type='submit' name="like">Like</button>
            <p><?php echo $num_likes?></p>
            </form>
            <?php
        
        ?>

        <p><?php echo "$post_text"?></p>
        <p><?php echo "$post_time"?></p>

    </div>
</div>
</div>

<?php   
    }else{
        echo "Aucun post trouvé";
    }




?>
        
<?php include("./Parties/footer.php"); ?>
<?php
} else {
    header("Location: ./index.php");
    exit();
}
?>

<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles(false);
      });
    </script>
    </body>
</html>