<?php
$conn = new SQLconn();

$com_id = 1;
if (!empty($post_id)) {
    $post_data = $conn->getPostData($post_id);

    if ($post_data !== false) { //si le post existe

        $post_title = $post_data['post_title'];
        $post_text = $post_data['post_text'];
        $post_img = $post_data['post_img'];
        $post_time = $post_data['created_time'];
        ?>

        <div class="post">
            <div class="left">
                <h1>
                    <?php echo "$post_title" ?>
                </h1>
                <div class="img-container">
                    <img src="<?php echo "$post_img" ?>" alt="<?php echo "$post_title" ?>">
                </div>
            </div>
            <div class="com">
                <div id="comment-container">
                    <?php
                    $comNumber = 0;
                    $path = true;
                    file_exists("../Parties/loadcom.php") ? include("../Parties/loadcom.php") : include("./Parties/loadcom.php");
                    //on ne met pas le script pour charger les commentaires au scroll car on est dans la page principale
                    ?>
                </div>
                <form action="comment.php" method="get"> <!--get car les données ne sont pas sensibles-->
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <input type="submit" value="VOIR LE POST">
                </form>

            </div>
            <div class="desc">
                <div class="usertext">
                    <div class="text">
                        <?php echo "$post_text" ?>
                    </div>
                    <p class="date">
                        <?php echo "$post_time" ?>
                    </p>
                </div>
                <?php
                $user_id = $conn->getUserIdFromPostId($post_id);
                $user_pseudo = $conn->getUserPseudo($user_id);
                ?>
                <div class="like-and-user">

                    <form action="./Profil.php?user_pseudo=<?php echo $user_pseudo ?> " method="post">
                        <input type="submit" value="VOIR LE PROFIL">
                    </form>
                </div>
            </div>


        </div>
        </div>
    <?php
    } else {
        echo "Aucun post trouvé";
    }
}



?>