<?php include("./Parties/head.php") ?>
<?php include("./Parties/Classes.php")?>
<?php

$cook =new Cookie();
// Vérification si l'utilisateur est authentifié
if ($cook->IssetCookie()) {



    if(isset($_GET['user_pseudo'])){
        $user_pseudo=$_GET['user_pseudo'];
    }
    else{
        $user_pseudo=$cook->getUsername();
    }
    
    // Connexion à la base de données
    $conn = new SQLconn();
    ?>
<?php include("./Parties/header.php"); ?>
<body>
  
    <div class="center">
        <?php include("./Parties/card.php"); ?>
        <div class="myPosts">
<!-- Ajouter les posts persos => trier la liste dans
    load en fct des posts possedés puis les afficher ou refaire une méthode
 -->
        </div>
    </div>
<?php include("./Parties/footer.php"); ?>
<?php
} else {
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