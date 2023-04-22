<div class="blurring"></div>

<form class="login" action="./index.php" method="post">
  <fieldset>
    <legend>Connexion</legend>
    <label for="username">Nom d'utilisateur :</label>
    <input id="username" type="text" placeholder="Username" required name="username">
    <label for="password">Mot de passe :</label>
    <input id="password" type="password" placeholder="Password" required name="password">
  </fieldset>
  <button type="submit" name="signin">Se connecter</button>
  <a href="./Signup.php"><button type="button">Créer un compte</button></a>

  <?php
  if (isset($_POST["signin"])) {

    $conn = new SQLconn();
    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($conn->CheckDB($username, $password)) {
      $conn->CloseDB();
      $cook = new Cookie();
      $cook->CreateLoginCookie($username, $password);
      header("Location: ./index.php");
    } else {
      echo "Mauvais identifiants!";
    }
  }
  ?>
</form>