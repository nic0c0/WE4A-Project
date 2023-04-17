
<?php 

include("./Parties/head.php") ?>

  <body>
  
  <div class="blurring">

</div>


<form class="login" action="./Signup.php" method="post">
  <fieldset>
  <legend>Inscription</legend>
   
      <label for="username">Nom d'utilisateur :</label>
      <input id="username" type="text" placeholder="Username" name="username" required>
      <label for="password1">Mot de passe :</label>
      <input id="password1" type="password" placeholder="Password" name="password1" required>
      <label for="password2">Confirmer :</label>

      <input id="password2" type="password" placeholder="Password" name="password2" required>
  </fieldset>
    <button type="submit">s'inscrire</button>

<?php 


if (isset($_POST["password1"]) && isset($_POST["password2"]) && isset($_POST["username"])){
    
  
    $USERNAME=htmlentities($_POST["username"]);
    $PASSWORD1=htmlentities($_POST["password1"]);
    $PASSWORD2=htmlentities($_POST["password2"]);

    if($PASSWORD1==$PASSWORD2){

        include("./Parties/Classes.php");

        $coon = new SQLconn();

        if(!$coon->AlreadyExist($USERNAME)){
          $coon->CreateAccount($USERNAME,$PASSWORD1);
          $cook = new Cookie();
          $cook->CreateLoginCookie($USERNAME,$PASSWORD1);
          header('Location: ./index.php');
        }
  

        
        
    }else{
        
        echo "mauvais mots de passe";

    }

}

?>
</form>
<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles();
      });
    </script>
</body>
</html>