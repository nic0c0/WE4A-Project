
<?php 
session_start();
include("../Parties/head.php") ?>

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

        $PASSWORD1 = md5($PASSWORD1);
        $test=true;
        include("../Parties/Classes.php");

        //$U = new user($USERNAME,$PASSWORD1);
      // $U->show();
      $info = ['user' => $USERNAME, 'password' => $PASSWORD1];
      $_SESSION['user']=$info;
      //setcookie("user",serialize($U),time()*60);

      header('Location: ../index.php');
        
        
    }else{
        
        echo "mauvais mots de passe";

    }

}

/*
if (isset($_COOKIE["user"])){
  $user = unserialize($_COOKIE["user"]);
  var_dump($_COOKIE["user"]);
}*/

?>
</form>

  <?php include("../Parties/header.php"); ?>
<div class="main">

    <div class="leftmain">
    </div>
    <div> 
    <h1>Hello, world!</h1> 
        <?php include("../Parties/signout.php"); ?>
        <?php include("../Parties/post.php"); ?>
        <?php include("../Parties/post.php"); ?></div>



</div>
<?php include("../Parties/footer.php"); ?>

</body>
</html>