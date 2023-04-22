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
        
        if($state=="mod"){
        ?>

      
        <div class="center">
        
        <?php 
        include("./Parties/poster.php");
        }else{
            include("./Parties/post.php");
            ?>
          <form action="./redirect.php" method="post">
            <input type="hidden" name="post_id" value="<?php echo $post_id ?>">
            <input type="hidden" name="path" value="<?php echo basename(__FILE__); ?>">
            <button name="delete" type="submit" >DETRUIRE LE POST</button>
          </form>

        <?php
        } ?>
        </div>
    
<?php include("./Parties/footer.php"); ?>

</body>
</html>
    <?php
    
    }
}
?>