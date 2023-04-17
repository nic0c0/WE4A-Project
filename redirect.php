<?php include("./Parties/Classes.php")?>

<?php

$conn = new SQLconn();

$path = $_POST['path'];

switch ($path) {
    case './comment.php':
        //on traite les infos pour le commentaire
        if (isset($_POST['com'])) {
            //Récupération des données du form : 
            $post_id = $_POST['post_id'];
            $user_id = $_POST['user_id'];
            $commenter = $_POST['commenter'];//commentateur
            $com_text = $_POST['comment_text'];
            var_dump($post_id);
            $conn->insertComment($commenter,$post_id,$com_text);
        }
        header("Location: $path?post_id=$post_id");
        exit();
    case 'post':
        exit();
    default:
        exit();
}


?>
