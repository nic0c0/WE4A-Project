<?php
    $user_id=$conn->getUserData($username)['user_id'];
    $post_data = $conn->getPostData(3,25);
    if($post_data!=false){
        $post_title = $post_data['post_title'];
        $post_text = $post_data['post_text'];
        $post_img = $post_data['post_img'];
        $post_time = $post_data['created_time'];

        $com_data=$conn->getComData(3,25);
        if($com_data!=false){
            $com_text=$com_data['comment_text'];
            $com_time=$com_data['created_time'];
        }
    }
    else{
        echo "erreur postdata=false";
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
        <p>
            Whouah
        </p>
    </div>
    <div class="desc">
        <p><?php echo "$post_text"?></p>
        <p><?php echo "$post_time"?></p>

    </div>
</div>