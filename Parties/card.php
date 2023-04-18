
<?php
    // Récupération des données utilisateur à partir de la base de données
    $user_data = $conn->getUserData($user_pseudo);
    $user_id = $user_data['user_id'];

    //Chargement de l'image de profil et du pseudo
    $user_pp = $user_data['user_pp'];
    $user_pseudo = $user_data['user_pseudo'];
    $user_desc = $user_data['user_desc'];
    
    $conn = new SQLconn();

?>

<div class="card">
    <div class="profilePic">
    <img src="<?php echo (isset($user_pp) && !empty($user_pp)) ? $user_pp : './IMG/profilepic1.png'; ?>" alt="Image de profil">
    </div>
    <div class="username">
      <h2><?php echo "$user_pseudo"?></h2>
      <p><?php echo "$user_desc"?></p>
    </div>
    
    <div class="details">
      <div class="posted">
        <h4>
        <?php      
            $conn->CountPost($user_id);
          ?>
        </h4>
        <p>Posts</p>
      </div>
      
      <div class="Follow">
        <h4>
          <?php
            $conn->CountFollowers($user_id);
          ?>
        </h4>
        <?php 
        if(strtolower($user_pseudo)==strtolower($cook->getUsername())){
          ?>
          <p>Followers</p>
          <form action="./Relation.php">
            <!-- value apparrait dans l'url en sortie : à regler  -->
          <input type="submit" name="follow" value="Voir la liste">
          </form>
          <?php
        }else{
          $this_user_id=$conn->getUserData($cook->getUsername())['user_id'];
          if($conn->checkFollow($this_user_id,$user_id)){
            $f="UnFollow";            
          }else{
            $f="Follow";
          }
          ?>
          <form action="redirect.php" method="post">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <input type="hidden" name="this_user_id" value="<?php echo $this_user_id; ?>">
            <input type="hidden" name="path" value="<?php echo basename(__FILE__); ?>">
            <input type="submit" name="follow" value="<?php echo $f; ?>">
          </form>
          <?php
        }
        ?>
      </div>
      
      <div class="Follower">
        <h4>
        <?php      
            $conn->CountFollows($user_id);
          ?>
        </h4>
        <p>Follower</p>
      </div>
    </div>

</div>