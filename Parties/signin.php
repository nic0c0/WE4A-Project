<form action="./index.php" method="post">
  <fieldset>
  <legend>Connexion</legend>

    <div class="centerline">
      <label for="username">Nom d'utilisateur :</label>
      <input id="username" class="centercolumn" type="text" placeholder="Username" required>
      <br>
      <label for="password">Mot de passe :</label>
      <input id="password" class="centercolumn" type="password" placeholder="Password" required>
    </div>
  </fieldset>
  <div class="centercolumn">
    <button type="submit">Se connecter</button>
    <a href="Pages/Signup.php"> <button type="button">Créer un compte</button> </a>
  </div>
</form>