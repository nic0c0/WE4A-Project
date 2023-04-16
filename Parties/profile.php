
<?php
    // Récupération des données utilisateur à partir de la base de données
    $user_data = $conn->getUserData($username, $password);
    $user_id = $user_data['user_id'];

    //Chargement de l'image de profil et du pseudo
    $user_pp = $user_data['user_pp'];
    $user_pseudo = $user_data['user_pseudo'];
    $user_desc = $user_data['user_desc'];
    
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
        <h4>0</h4>
        <p>Posts</p>
      </div>
      
      <div class="follower">
        <h4>0</h4>
        <p>Followers</p>
      </div>
      
      <div class="following">
        <h4>0</h4>
        <p>Following</p>
      </div>
    </div>

</div>