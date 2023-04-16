
<?php 
  session_start();
  include("./Parties/head.php");
  //include("./Parties/Classes.php");
  
  ?>

  <body>

 <?php 

    
    if(!isset($_SESSION['user'])){
    
      include("./Parties/signin.php");
     
    }else{
        include("./Parties/Classes.php");
        $CONNEXION=new SQLconn();
        $info = $_SESSION['user'];
        $user = $info['user'];
        $password = $info['password'];
        
        $sql = "SELECT * FROM T_USER_PROFILE WHERE USER_PSEUDO='$user'";
        
        $result = mysqli_query($CONNEXION->getConn(), $sql);

        if (mysqli_num_rows($result) > 0) {
            // L'utilisateur et le mot de passe sont corrects
            echo "Bienvenue $user !";
        } else {
            // L'utilisateur et/ou le mot de passe sont incorrects
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    }

    

     
     ?>

  <?php include("./Parties/header.php"); ?>
<div class="main">

    <div class="leftmain">
      <div class="left1">test</div>
    </div>
    <div> 
    <h1>Hello, world!</h1> 
    
        <?php include("./Parties/poster.php")?>
        <?php include("./Parties/post.php"); ?>
        <?php include("./Parties/post.php"); ?></div>



</div>
<?php include("./Parties/footer.php"); ?>


<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles();
      });
    </script>
</body>
</html>