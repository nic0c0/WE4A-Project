
<?php 
  session_start();
  include("./Parties/head.php");
  
  ?>

  <body>

 <?php 

    
    if(!isset($_SESSION['user'])){
    
      include("./Parties/signin.php");
     
    }else{
        include("./Parties/Classes.php");
        $info = $_SESSION['user'];
        
    }

    

     
     ?>

  <?php include("./Parties/header.php"); ?>
<div class="main">

    <div class="leftmain">
      <div class="left1">test</div>
    </div>
    <div> 
    <h1>Hello, world!</h1> 
    <?php var_dump($_SESSION['user']); ?>
        <?php include("./Parties/signout.php"); ?>
        <?php include("./Parties/post.php"); ?>
        <?php include("./Parties/post.php"); ?></div>



</div>
<?php include("./Parties/footer.php"); ?>


<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        header();
        applyStyles();
      });
    </script>
</body>
</html>