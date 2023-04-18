<?php
    $conn = new SQLconn();

    $com_id=1;
    if(!empty($post_id)){
        $post_data=$conn->getPostData($post_id);
    
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
    
?>

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
        <form action="comment.php" method="get"> <!--get car les données ne sont pas sensibles-->
        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
        <input type="submit" value="VOIR LE POST">
        </form>
        

    </div>
    <div class="desc">
        <p><?php echo "$post_text"?></p>
        <p><?php echo "$post_time"?></p>
        <form action="./Profil.php" method="post">
            <?php 
                $user_id=$conn->getUserIdFromPostId($post_id);
                $user_pseudo=$conn->getUserPseudo($user_id);
            ?>
            
        <input type="hidden" name="user_pseudo" value="<?php echo $user_pseudo; ?>">
        <input type="submit" value="VOIR LE PROFIL">
        </form>
    </div>


    </div>
</div>
<?php   
        }else{
            echo "Aucun post trouvé";
        }
    }



?>