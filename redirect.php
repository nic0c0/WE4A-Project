<?php include("./Parties/Classes.php")?>

<?php

$conn = new SQLconn();

$path = $_POST['path'];

switch ($path) {
    case 'comment.php':
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
    case 'poster.php': //path utilise basename(__FILE__) donc il va ressortir poster.php
        //on traite les infos quand on rajoute un post depuis l'index
        if(isset($_POST['save'])){
            //Récupération des données du form :
            $post_title = $_POST['post_title'];
            $post_text = $_POST['post_text'];
            $user_id = $_POST['user_id'];

            $postid=$conn->getUserPostCount($user_id);
            //sauvegarde de l'image
            $post_img=saveImageAsNew($user_id,false,$postid);
            //Mise à jour de la base de données
            $conn->insertPost($user_id, $post_title, $post_text, $post_img);
            header("Location: ./index.php");
        }
        exit();
    default:
        header("Location: ./Settings.php?path=$path");
        exit();
}


?>
