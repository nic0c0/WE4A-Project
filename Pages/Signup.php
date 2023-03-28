
<?php include("../Parties/head.php"); ?>
  <body>
    <?php include("../Parties/navbar.php"); ?>
    <h1>Hello, world!</h1>


  <?php include("../Parties/footer.php"); ?>


  <form action="./Signup.php" method="post">
  <fieldset>
  <legend>Inscription</legend>

    <div class="centerline">
      <label for="username">Nom d'utilisateur :</label>
      <input id="username" class="centercolumn" type="text" placeholder="Username" name="Username" required>
      <br>
      <label for="password">Tapez votre mot de passe :</label>
      <input id="password" class="centercolumn" type="password" placeholder="Password" name="password1" required>
      <br>
      <label for="password">Recomfirmer votre mot de passe:</label>
      <input id="password" class="centercolumn" type="password" placeholder="Password" name="password2" required>  
    </div>
  </fieldset>
  <div class="centercolumn">
    <button type="submit">Valider</button>

  </div>
</form>

<?php
  if (isset($_POST["Username"]) && isset($_POST["password1"]) && isset($_POST["password2"]) ){

    $USERNAME=$_POST["Username"];
    $PASSWORD1=$_POST["password1"];
    $PASSWORD2=$_POST["password2"];

    if ($PASSWORD1 != $PASSWORD2){
      echo "Le mot de passe n'est pas le même";
    }
?>

    <h2>
      CECI EST UN TEST <?php echo $USERNAME ?>
    </h2>

<?php
}
?>


<script src="../scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        setSiblingHeight();
      });
    </script>
</body>
</html>