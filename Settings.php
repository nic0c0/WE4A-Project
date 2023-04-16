<?php include("./Parties/head.php") ?>
<?php include("./Parties/Classes.php")?>
<?php include("./Parties/header.php"); ?>
<?php include("./Parties/dbfunctions.php")?>
<body>
<?php

// Vérification si l'utilisateur est authentifié
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $authenticated = true;
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    // Connexion à la base de données
    $conn = new SQLconn();
    
    // Récupération des données utilisateur à partir de la base de données
    $user_data = $conn->getUserData($username, $password);
    $user_id = $user_data['user_id'];

    // Traitement des données soumises par le formulaire
    if (isset($_POST['save'])) {
        $user_email = $_POST['user_email'];
        $user_name = $_POST['user_name'];
        $user_surname = $_POST['user_surname'];
        $user_desc= $_POST['user_desc'];

    // Chargement de l'image de profil
    $user_pp = $user_data['user_pp'];
    if (isset($_FILES['new_pp']) && $_FILES['new_pp']['size'] != 0) {
        $new_pp = saveImageAsNew($user_id,true,0);
        if ($new_pp) {
            $user_pp = $new_pp;
        }
    }


        // Mise à jour des données utilisateur dans la base de données
        $conn->updateProfile($user_id, $user_email, $user_pp,$user_name, $user_surname,$user_desc);

        // header("Location: ./Settings.php");
        // exit();
    }

} else {
    $authenticated = false;
    header("Location: ./index.php");
    exit();
}

?>
    
<div class="center">
  <div class="settings">
  <h1>Paramètres</h1>
    <form method="post" class="set1" enctype="multipart/form-data" >
      <label for="user_email">Adresse email :</label>
      <input type="email" id="user_email" name="user_email" value="<?php echo !empty($user_data['user_email']) ? $user_data['user_email'] : ''; ?>" placeholder="<?php echo empty($user_data['user_email']) ? 'Non renseigné' : ''; ?>" required>
      
      <label for="user_pseudo">Pseudo :</label>
      <input type="text" id="user_pseudo" name="user_pseudo" value="<?php echo $user_data['user_pseudo']; ?>" disabled>
      
      <label for="user_name">Prénom :</label>
      <input type="text" id="user_name" name="user_name" value="<?php echo isset($user_data['user_name']) ? $user_data['user_name'] : ''; ?>"  placeholder="Entrez votre prénom">
      
      <label for="user_surname">Nom :</label>
      <input type="text" id="user_surname" name="user_surname" value="<?php echo isset($user_data['user_surname']) ? $user_data['user_surname'] : ''; ?>"  placeholder="Entrez votre nom de famille">
            
      <label for="user_desc">Descrition :</label>
      <input type="text" id="user_desc" name="user_desc" value="<?php echo isset($user_data['user_desc']) ? $user_data['user_desc'] : ''; ?>"  placeholder="Entrez votre Description">
            
      <fieldset>
        <legend>Profil</legend>
        <div class="img-upload">
            <label id="imgUpload">
                <input accept="image/*" type='file' id="imgInp" name="new_pp" />
            </label>
            <div class="img-container">
            <img id="blah" src="<?php echo (isset($user_data['user_pp']) && !empty($user_data['user_pp'])) ? $user_data['user_pp'] : './IMG/profilepic1.png'; ?>" alt="your image" />
            </div>
            <button class="btn button full" type="submit" name="save">Sauvegarder</button>
        </fieldset>
    
    </form>


        <form>
            <fieldset>
                <legend>Changer de Mot de passe</legend>
                <label for="password1">Mot de passe :
                    <input id="password1" type="password" placeholder="Password" required>
                </label>
                <label for="password2">Mot de passe :
                    <input id="password2" type="password" placeholder="Password" required>
                </label>
            </fieldset>
            <button type="submit">Modifier</button>
        </form>
    </div>
</div>


<?php include("./Parties/footer.php"); ?>


<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles(false);
      });
    </script>
</body>
</html>