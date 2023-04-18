<?php include("./Parties/Classes.php")?>

<?php
$cook = new Cookie();

if(!$cook->CheckIntegrity()){
    header("Location: ./Index.php?PBINTEG");
    $cook->clean();
}else{
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
        }
        header("Location: ./index.php");
        exit();
    case 'Settings.php':
        //on traite les infos pour les settings
        //si c'est un changement dans le profil
        if (isset($_POST['save'])) {
            $user_email = $_POST['user_email'];
            $user_name = $_POST['user_name'];
            $user_surname = $_POST['user_surname'];
            $user_desc= $_POST['user_desc'];
            $user_id = $_POST['user_id'];
            $path = $_POST['path'];
    
            // Chargement de l'image de profil
            $user_pp = $_POST['user_pp'];
            if (isset($_FILES['new_pp']) && $_FILES['new_pp']['size'] != 0) {
                $new_pp = saveImageAsNew($user_id,true,0);
                if ($new_pp) {
                    $user_pp = $new_pp;
                }
            }
    
    
            // Mise à jour des données utilisateur dans la base de données
            $conn->updateProfile($user_id, $user_email, $user_pp,$user_name, $user_surname,$user_desc);    

        }
        header("Location: $path");
        exit();
    default:
        header("Location: ./Settings.php?path=$path");
        exit();
}

}

?>
