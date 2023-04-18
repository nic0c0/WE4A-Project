<?php
include("./Parties/head.php");
include("./Parties/Classes.php");
include("./Parties/header.php");

$cook = new Cookie();

if(!$cook->CheckIntegrity()){
    header("Location: ./Index.php?PBINTEG");
    $cook->clean();
}else{
    $user_pseudo=$cook->getUsername();  
    $conn = new SQLconn();

    $user_id=$conn->getUserData($user_pseudo)['user_id'];


?>
<body>
    <div class="center">
        <p>
            <?php 
                $conn->displayFollowers($user_id);
                $conn->displayFollows($user_id);
            ?>
        </p>
    </div>
</body>



<?php
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