<?php include("./Parties/head.php") ?>
<?php include("./Parties/Classes.php")?>
<?php include("./Parties/header.php"); ?>
<body>
<?php

$cook = new Cookie();

if(!$cook->CheckIntegrity()){
    header("Location: ./Index.php?PBINTEG");
    $cook->clean();
}else{
    if(isset($_POST['mod'])||isset($_POST['del'])){
        $post_id=$_POST['post_id'];
        $state=isset($_POST['mod']) ? "mod" : "del";
        $conn = new SQLconn();
        $username=$cook->getUsername();//car on a deja check l'intégrité donc on est forcément l'uploader du post
        ?>


        <div class="center">
        <?php include("./Parties/poster.php"); ?>
        </div>
    
<?php include("./Parties/footer.php"); ?>


<script src="./scripts.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        applyStyles(false);
      });
    </script>
</body>
</html>
    <?php
    
    }
}
?>