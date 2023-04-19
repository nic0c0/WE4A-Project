
<?php 
  include("./Parties/head.php");
  include("./Parties/Classes.php");

  //CheckIntegrity();
  
  ?>

  <body>
<?php
  $cook = new Cookie();
  if(!$cook->IssetCookie()){
            include("./Parties/signin.php");
    }else{
      CheckIntegrity();
      include("./Parties/header.php");
      
      $username = $cook->getUsername();//utile pour poster
      // Connexion à la base de données
      $conn = new SQLconn();
      ?>
        <div class="main">
      
          <div class="leftmain">
            <div class="left1">test</div>
          </div>
          <div> 
            <h1>Hello, world!</h1> 
              <?php include("./Parties/poster.php")?>

              <div id="myPosts">
  <script src="./scripts.js"></script>
  <?php
  if (true){
    $user_pseudo=$cook->getUsername();
    $user_date=$conn->getUserData($user_pseudo)['user_created'];
    //echo date("Y-m-d H:i:s"),"<br>", $user_date;
    $res = soustraire_dates(date("Y-m-d H:i:s"),$user_date);
    if($res==0){


    ?>
    <script>alert("Bienvenue sur ASIAN FOOD <?php echo $cook->getUsername() ?> !!!");</script>
  
  <?php
      }
  }
  ?>
<div id="allPosts">

<<<<<<< Updated upstream
<div id="allPosts">
=======
  
>>>>>>> Stashed changes
  <script>loadPostsOnScroll(0);</script>
</div>

      
      
        </div>
      <?php include("./Parties/footer.php");
    }


    


?>



<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles();
      });
    </script>
</body>
</html>