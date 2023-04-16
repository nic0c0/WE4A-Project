<?php include("./Parties/head.php") ?>
<?php include("./Parties/Classes.php")?>
<?php

// Vérification si l'utilisateur est authentifié
if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    $authenticated = true;
    $username = $_COOKIE['username'];
    $password = $_COOKIE['password'];

    // Connexion à la base de données
    $conn = new SQLconn();
    ?>
<?php include("./Parties/header.php"); ?>
<body>
  
    <div class="center">
        <?php include("./Parties/profile.php"); ?>
        <?php include("./Parties/post.php"); ?>
    </div>
<?php include("./Parties/footer.php"); ?>
<?php
} else {
    $authenticated = false;
    header("Location: ./index.php");
    exit();
}
?>

<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles(false);
      });
    </script>
    </body>
</html>