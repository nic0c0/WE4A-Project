
<?php include("./Parties/head.php") ?>

  <body>
  
  <div class="blurring">

</div>


<form class="login" action="./Signup.php" method="post">
  <fieldset>
  <legend>Inscription</legend>
   
      <label for="username">Nom d'utilisateur :</label>
      <input id="username" type="text" placeholder="Username" name="username" required>
      <label for="password">Mot de passe :</label>
      <input id="password" type="password" placeholder="Password" name="password1" required>
      <input id="password" type="password" placeholder="Password" name="password2" required>
  </fieldset>
    <button type="submit">s'inscrire</button>

</form>

<?php 


if (isset($_POST["password1"]) && isset($_POST["password2"]) && isset($_POST["username"])){
    
    $USERNAME=$_POST["username"];
    $PASSWORD1=$_POST["password1"];
    $PASSWORD2=$_POST["password2"];

    if($PASSWORD1==$PASSWORD2){

        $test=true;
        include("../Parties/Classes.php");

        $U = new user($USERNAME,$PASSWORD1);
        $U->show();
        
        
    }else{
        
        echo "Les mots de passe ne sont pas les mêmes!";

    }

}
?>

  <?php include("./Parties/header.php"); ?>
<div class="main">

    <div class="leftmain">
    </div>
    <div> 
    <h1>Hello, world!</h1> 
        <?php include("./Parties/signout.php"); ?>
        <?php include("./Parties/post.php"); ?>
        <?php include("./Parties/post.php"); ?></div>



</div>
<?php include("./Parties/footer.php"); ?>

</body>
</html>