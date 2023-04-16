
<?php 
  include("./Parties/head.php");
  include("./Parties/Classes.php");
  
  ?>

  <body>
<?php
  if(!(isset($_COOKIE['username']) && isset($_COOKIE['password']))){
            include("./Parties/signin.php");
    }else{
      include("./Parties/header.php");
      ?>
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