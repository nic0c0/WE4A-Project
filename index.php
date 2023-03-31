<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="./IMG/t3.ico">
    <!--<link rel="stylesheet" href="./CSS/style1.css">-->
    <title>MyNetwork</title>
  </head>
  <body>
  
 <!-- <?php include("./Parties/signin.php"); ?> -->

  <?php include("./Parties/header.php"); ?>
<div class="main">

    <div class="leftmain">
      <div class="left1">test</div>
    </div>
    <div> 
    <h1>Hello, world!</h1> 
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