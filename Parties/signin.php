<div class="blurring">

</div>

<form class="login" action="./index.php" method="post">
  <fieldset>
  <legend>Connexion</legend>
   
      <label for="username">Nom d'utilisateur :</label>
      <input id="username" type="text" placeholder="Username" required name="username">
      <label for="password">Mot de passe :</label>
      <input id="password" type="password" placeholder="Password" required name="password">
  </fieldset>
    <button type="submit">Se connecter</button>

   <a href="./Signup.php"> <button type="button">Créer un compte</button> </a>
   <?php
        if(isset($_POST['username'])&& isset($_POST['password'])){
          include("./Parties/Classes.php");
          $CONNEXION=new SQLconn();
          $user =$_POST['username'];
          $password = $info['password'];
          
          $sql = "SELECT * FROM T_USER_PROFILE WHERE USER_PSEUDO='$user'";
          
          $result = mysqli_query($CONNEXION->getConn(), $sql);
  
          if (mysqli_num_rows($result) > 0) {
              // L'utilisateur et le mot de passe sont corrects
              echo "Bienvenue $user !";
              header('Location: ./index.php');
            } else {
              // L'utilisateur et/ou le mot de passe sont incorrects
              echo "Nom d'utilisateur ou mot de passe incorrect.";
          }
        }
        
   ?>
</form>

