<!doctype html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./CSS/style1.css">
    <title>MyNetwork</title>
  </head>
  <body>
    <?php include("./Parties/navbar.php"); ?>
    <h1>Hello, world!</h1>

  <?php include("./Parties/signin.php"); ?>
  <?php include("./Parties/footer.php"); ?>
<?php include("./Parties/signout.php"); ?>


<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        setSiblingHeight();
      });
    </script>
</body>
</html>