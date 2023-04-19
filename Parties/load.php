<?php
include("../Parties/Classes.php");
//conexion à la base de données
$conn = new SQLconn();
//récupération du numéro du dernier post affiché
$postNumber = $_GET["firstPost"];

// Récupération des id des posts
$post_id_list = $conn->getPostsByDate();

//si on veut afficher les posts d'un utilisateur particulier
if(isset($_GET['moreInfo'])){
    $user_id=$_GET['moreInfo'];
    for($i=0;$i<count($post_id_list);$i++){
        $poster_user= $conn->getUserIdFromPostId($post_id_list[$i]);
        if($poster_user!==$user_id){//si le post n'est pas de l'utilisateur
            array_shift($post_id_list);
        }
    }
}
// Suppression des posts déjà affichés
for ($i = 0; $i < $postNumber; $i++) {
    array_shift($post_id_list);
}


// Récupération des données des 5 premiers posts
if (!empty($post_id_list)) {
    for ($i = 0; $i < 10; $i++) {
        if (isset($post_id_list[$i])) {
            $post_id = $post_id_list[$i];
            include "../Parties/post.php";
        } else {
            break;
        }
    }
}


//deconnexion de la base de données
$conn->closeDB();

?>
