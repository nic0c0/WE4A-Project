<?php include("./Parties/head.php") ?>
<?php include("./Parties/Classes.php")?>
<?php

// Vérification si l'utilisateur est authentifié
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $authenticated = true;
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    // Connexion à la base de données
    $conn = new SQLconn();
    ?>
<?php include("./Parties/header.php"); ?>
<body>
<?php
    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

    $com_id=1;
    $post_data = $conn->getPostData($user_id,$post_id);

    if($post_data!==false){//si le post existe
        $post_title = $post_data['post_title'];
        $post_text = $post_data['post_text'];
        $post_img = $post_data['post_img'];
        $post_time = $post_data['created_time'];

        $com_data=$conn->getComData($user_id,$post_id,$com_id);
        if($com_data!=false){//si le commentaire existe
            $com_text=$com_data['comment_text'];
            $com_time=$com_data['created_time'];
        }
        //sauvegarder le commentaire
        if (isset($_POST['com'])) {
            $com_text = $_POST['comment_text'];
            $conn->insertComment($conn->getUserData($username)['user_id'],$post_id,$com_text);
        }
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
        <?php echo (isset($com_text) ? $com_text . " le " . $com_time : ''); ?>
        </p>
        <p>
            Whouah
        </p>
        <form method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <label for="comment_text">Commentaire :</label><br>
        <textarea name="comment_text" id="comment_text" rows="3" cols="40"></textarea><br>
        <input type="submit" value="Sauvegarder" name="com">
</form>
    </div>
    <div class="desc">
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
    $authenticated = false;
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